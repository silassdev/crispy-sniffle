<div>
  {{-- Modal --}}
  <div x-data="{ open: @entangle('open') }" x-show="open" x-cloak class="fixed inset-0 z-50 flex items-start justify-center pt-20">
    <div class="absolute inset-0 bg-black/40" @click="$wire.close()"></div>

    <div class="relative z-10 w-full max-w-3xl bg-white rounded shadow-lg overflow-hidden">
      <div class="flex items-center justify-between p-4 border-b">
        <div>
          <h3 class="font-semibold">Manage comments{{ $post ? ' — '.$post->title : '' }}</h3>
          <div class="text-xs text-gray-500">{{ $post?->comments_count ?? 0 }} total</div>
        </div>
        <div>
          <button @click="$wire.close()" class="px-3 py-1 rounded border">Close</button>
        </div>
      </div>

      <div class="p-4 space-y-4 max-h-[70vh] overflow-auto">
        @if($comments->count())
          @foreach($comments as $c)
            <div class="bg-gray-50 p-3 rounded">
              <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded bg-gray-200 flex items-center justify-center text-sm font-medium">
                  {{ strtoupper(substr($c->user->name ?? 'U',0,1)) }}
                </div>
                <div class="flex-1">
                  <div class="flex items-center justify-between">
                    <div>
                      <div class="font-semibold">{{ $c->user->name ?? 'Unknown' }}</div>
                      <div class="text-xs text-gray-500">{{ $c->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="text-xs space-x-2">
                      @if($c->approved)
                        <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded">Approved</span>
                      @else
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded">Pending</span>
                      @endif
                    </div>
                  </div>

                  <div class="mt-2 text-gray-700">{!! nl2br(e($c->body)) !!}</div>

                  <div class="mt-3 flex items-center gap-2 text-sm">
                    @if(! $c->approved)
                      <button wire:click="approveComment({{ $c->id }})" class="px-2 py-1 bg-emerald-600 text-white rounded">Approve</button>
                    @else
                      <button wire:click="rejectComment({{ $c->id }})" class="px-2 py-1 bg-yellow-600 text-white rounded">Reject</button>
                    @endif

                    <button wire:click="deleteComment({{ $c->id }})" class="px-2 py-1 bg-red-600 text-white rounded">Delete</button>

                    @if(isset($c->user))
                      @if(isset($c->user->banned) && $c->user->banned)
                        <button wire:click="unbanUser({{ $c->user->id }})" class="px-2 py-1 border rounded">Unban user</button>
                      @else
                        <button wire:click="banUser({{ $c->user->id }})" class="px-2 py-1 border rounded">Ban user</button>
                      @endif
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endforeach

          <div class="mt-3">
            {{ $comments->links() }}
          </div>
        @else
          <div class="text-center text-gray-500">No comments found</div>
        @endif
      </div>
    </div>
  </div>
</div>
