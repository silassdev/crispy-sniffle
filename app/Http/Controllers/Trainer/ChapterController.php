<?php
namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Chapter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ChapterController extends Controller
{
    public function index(Course $course)
    {
        $chapters = $course->chapters()->get();
        return view('trainer.chapters.index', compact('course','chapters'));
    }

    public function store(Request $request, Course $course)
    {

        $payload = $request->validate([
            'chapters' => 'required|array|min:1',
            'chapters.*.title' => 'required|string|max:255',
            'chapters.*.description' => 'nullable|string',
            'chapters.*.content' => 'nullable|string',
            'chapters.*.pdf' => 'nullable|file|mimes:pdf|max:10240',
            'chapters.*.video' => 'nullable|file|mimes:mp4,mpeg,mov,avi|max:102400',
        ]);

        $existingCount = $course->chapters()->count();
        $incoming = count($payload['chapters']);
        if ($existingCount + $incoming > 20) {
            return back()->withErrors(['chapters' => 'Course cannot have more than 20 chapters.']);
        }

        DB::beginTransaction();
        try {
            $order = $existingCount;
            foreach ($payload['chapters'] as $index => $ch) {
                $order++;
                $chapter = Chapter::create([
                    'course_id' => $course->id,
                    'title' => $ch['title'],
                    'slug' => Str::slug($ch['title']).'-'.$order,
                    'description' => $ch['description'] ?? null,
                    'content' => $ch['content'] ?? null,
                    'order' => $order,
                ]);

                // Handle PDF upload
                if ($request->hasFile("chapters.{$index}.pdf")) {
                    $chapter->addMediaFromRequest("chapters.{$index}.pdf")
                        ->toMediaCollection('pdf');
                }

                // Handle Video upload
                if ($request->hasFile("chapters.{$index}.video")) {
                    $chapter->addMediaFromRequest("chapters.{$index}.video")
                        ->toMediaCollection('video');
                }
            }
            DB::commit();
            return redirect()->route('trainer.chapters.index', $course)->with('success','Chapters created');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('create chapters error: '.$e->getMessage());
            return back()->withErrors(['server'=>'Unable to create chapters']);
        }
    }

    public function update(Request $request, Course $course, Chapter $chapter)
    {

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        $chapter->update([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']).'-'.$chapter->order,
            'description' => $data['description'] ?? null,
            'content' => $data['content'] ?? null,
        ]);

        return back()->with('success','Chapter updated');
    }

    public function destroy(Course $course, Chapter $chapter)
    {
        $chapter->delete();

        // re-order remaining chapters to keep contiguous orders
        $i = 0;
        foreach ($course->chapters()->orderBy('order')->get() as $c) {
            $i++; $c->update(['order'=>$i]);
        }

        return back()->with('success','Chapter deleted');
    }
}
