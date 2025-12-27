{{-- replace the previous sidebar block with: --}}
<aside class="col-span-12 lg:col-span-4">
  @livewire('student.chapter-sidebar', ['courseId' => $course->id, 'currentOrder' => $order], key('sidebar-'.$course->id.'-'.$order))
</aside>
