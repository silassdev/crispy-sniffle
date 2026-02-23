<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Social Links') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Add your social media profiles to help people connect with you.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="github_url" :value="__('GitHub URL')" />
                <x-text-input id="github_url" name="github_url" type="url" class="mt-1 block w-full" :value="old('github_url', $user->github_url)" placeholder="https://github.com/username" />
                <x-input-error class="mt-2" :messages="$errors->get('github_url')" />
            </div>

            <div>
                <x-input-label for="linkedin_url" :value="__('LinkedIn URL')" />
                <x-text-input id="linkedin_url" name="linkedin_url" type="url" class="mt-1 block w-full" :value="old('linkedin_url', $user->linkedin_url)" placeholder="https://linkedin.com/in/username" />
                <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
            </div>

            <div>
                <x-input-label for="twitter_url" :value="__('Twitter / X URL')" />
                <x-text-input id="twitter_url" name="twitter_url" type="url" class="mt-1 block w-full" :value="old('twitter_url', $user->twitter_url)" placeholder="https://twitter.com/username" />
                <x-input-error class="mt-2" :messages="$errors->get('twitter_url')" />
            </div>

            <div>
                <x-input-label for="website_url" :value="__('Personal Website')" />
                <x-text-input id="website_url" name="website_url" type="url" class="mt-1 block w-full" :value="old('website_url', $user->website_url)" placeholder="https://yourwebsite.com" />
                <x-input-error class="mt-2" :messages="$errors->get('website_url')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save Social Links') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
