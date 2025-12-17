<div class="space-y-4">
  {{-- new comment --}}
  <div class="bg-white p-4 rounded shadow-sm">
    <form wire:submit.prevent="add">
      <textarea wire:model.defer="body" rows="3" class="w-full border rounded px-3 py-2" placeholder="{{ $replyTo ? 'Write your reply...' : 'Write a comment...' }}"></textarea>
      @error('body') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror

      <div class="flex items-center gap-3 mt-3">
        @if($replyTo)
          <button type="button" wire:click="cancelReply" class="px-3 py-1 border rounded">Cancel Reply</button>
        @endif

        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Post</button>
      </div>
    </form>
  </div>

  {{-- comments list --}}
  <div class="space-y-4">
    @foreach($comments as $comment)
      <div class="bg-white p-4 rounded shadow-sm">
        <div class="flex items-start gap-3">
          <div class="w-10 h-10 rounded bg-gray-100 flex items-center justify-center text-sm font-bold">{{ strtoupper(substr($comment->user->name ?? 'U',0,1)) }}</div>
          <div class="flex-1">
            <div class="flex items-center justify-between">
              <div>
                <div class="font-semibold">{{ $comment->user->name }}</div>
                <div class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
              </div>

              <div class="text-sm">
                <button wire:click="startReply({{ $comment->id }})" class="text-indigo-600">Reply</button>
              </div>
            </div>

            <div class="mt-2 text-gray-700">{!! nl2br(e($comment->body)) !!}</div>

            {{-- replies --}}
            @if($comment->children->count())
              <div class="mt-3 space-y-3 pl-6 border-l">
                @foreach($comment->children as $child)
                  <div>
                    <div class="flex items-start gap-3">
                      <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-xs font-medium">{{ strtoupper(substr($child->user->name ?? 'U',0,1)) }}</div>
                      <div>
                        <div class="text-sm font-semibold">{{ $child->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $child->created_at->diffForHumans() }}</div>
                        <div class="mt-1 text-gray-700">{!! nl2br(e($child->body)) !!}</div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div>
    {{ $comments->links() }}
  </div>
</div>
