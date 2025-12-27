<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    // Show admin course detail with paginated chapters and students.
    public function show(Request $request, Course $course)
    {
        $this->authorize('view', $course);

        $course->load(['trainer','chapters'=>function($q){ $q->orderBy('order'); }, 'chapters.completions']);
        $chapters = $course->chapters()->orderBy('order')->paginate(10, ['*'], 'chapters_page');
        // students via pivot table course_user 
        $students = \DB::table('course_user')
            ->join('users','course_user.user_id','users.id')
            ->where('course_user.course_id', $course->id)
            ->select('users.id','users.name','users.email','course_user.created_at as enrolled_at')
            ->orderByDesc('course_user.created_at')
            ->paginate(10, ['*'], 'students_page');

        // counts
        $chapterCount = $course->chapters()->count();
        $studentCount = \DB::table('course_user')->where('course_id', $course->id)->count();

        return view('admin.courses.show', compact('course','chapters','students','chapterCount','studentCount'));
    }

    //Export full course overview as CSV (course metadata + chapters + students).
    
    public function exportCsv(Course $course)
    {
        $this->authorize('view', $course);

        $filename = 'course-'.$course->id.'-overview-'.now()->format('Ymd-His').'.csv';

        $response = new StreamedResponse(function() use ($course) {
            $handle = fopen('php://output','w');

            // Course header
            fputcsv($handle, ['Course Overview']);
            fputcsv($handle, ['ID', 'Title', 'Slug', 'Trainer', 'Created At']);
            fputcsv($handle, [$course->id, $course->title, $course->slug ?? '', optional($course->trainer)->name ?? '', $course->created_at]);

            fputcsv($handle, []);
            fputcsv($handle, ['Chapters']);
            fputcsv($handle, ['Order','Title','Slug','Description','Created At']);
            foreach ($course->chapters()->orderBy('order')->get() as $ch) {
                fputcsv($handle, [$ch->order, $ch->title, $ch->slug ?? '', str_replace(["\r","\n"], [' ',' '], $ch->description ?? ''), $ch->created_at]);
            }

            fputcsv($handle, []);
            fputcsv($handle, ['Students']);
            fputcsv($handle, ['ID','Name','Email','Enrolled At']);
            $students = \DB::table('course_user')->where('course_id',$course->id)->join('users','course_user.user_id','users.id')->select('users.id','users.name','users.email','course_user.created_at')->get();
            foreach ($students as $s) {
                fputcsv($handle, [$s->id, $s->name, $s->email, $s->created_at]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type','text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition','attachment; filename="'.$filename.'"');

        return $response;
    }

    //Export students only as CSV.
    
    public function exportStudentsCsv(Course $course)
    {
        $this->authorize('view', $course);

        $filename = 'course-'.$course->id.'-students-'.now()->format('Ymd-His').'.csv';

        $response = new StreamedResponse(function() use ($course) {
            $handle = fopen('php://output','w');
            fputcsv($handle, ['ID','Name','Email','Enrolled At']);
            $students = \DB::table('course_user')->where('course_id',$course->id)->join('users','course_user.user_id','users.id')->select('users.id','users.name','users.email','course_user.created_at')->orderByDesc('course_user.created_at')->get();
            foreach ($students as $s) {
                fputcsv($handle, [$s->id, $s->name, $s->email, $s->created_at]);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type','text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition','attachment; filename="'.$filename.'"');

        return $response;
    }

    /**
     * Export all chapters as a single PDF.
     */
    public function exportChaptersPdf(Course $course)
    {
        $this->authorize('view', $course);

        $chapters = $course->chapters()->orderBy('order')->get();

        $view = view('admin.courses.pdf.chapters', compact('course','chapters'))->render();

        $pdf = PDF::loadHTML($view)->setPaper('a4','portrait');

        $filename = 'course-'.$course->id.'-chapters-'.now()->format('Ymd-His').'.pdf';

        return $pdf->download($filename);
    }
}
