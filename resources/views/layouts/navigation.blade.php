<nav class="...">
  <a href="{{ route('home') }}">Home</a>

  @auth
    @if(auth()->user()->isAdmin())
      <a href="{{ route('admin.dashboard') }}">Admin</a>
    @endif

    @if(auth()->user()->isTrainer())
      <a href="{{ route('trainer.dashboard') }}">Trainer</a>
    @endif

    <livewire:actions.logout /> {{-- Livewire logout button --}}
  @else
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>
  @endauth
</nav>
