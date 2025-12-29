<div class="bg-white rounded-2xl shadow-xl p-8 md:p-10 border border-gray-100" id="feedback-form-container">
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-gray-900">Send us your feedback</h3>
        <p class="text-gray-500 mt-2">We read every message and take your suggestions seriously.</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input wire:model="name" type="text" id="name" 
                       class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition duration-200 bg-gray-50 focus:bg-white"
                       placeholder="John Doe">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input wire:model="email" type="email" id="email" 
                       class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition duration-200 bg-gray-50 focus:bg-white"
                       placeholder="john@example.com">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Country -->
            <div class="space-y-2">
                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                <input wire:model="country" type="text" id="country" 
                       class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition duration-200 bg-gray-50 focus:bg-white"
                       placeholder="United States">
                @error('country') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Type -->
            <div class="space-y-2">
                <label for="type" class="block text-sm font-medium text-gray-700">Feedback Type</label>
                <select wire:model="type" id="type" 
                        class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition duration-200 bg-gray-50 focus:bg-white">
                    <option value="Course Feedback">Course Feedback</option>
                    <option value="Platform Suggestions">Platform Suggestions</option>
                    <option value="Bug Report">Bug Report</option>
                    <option value="Feature Request">Feature Request</option>
                    <option value="General Comments">General Comments</option>
                </select>
                @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Message -->
        <div class="space-y-2">
            <label for="message" class="block text-sm font-medium text-gray-700">Your Message</label>
            <textarea wire:model="message" id="message" rows="4" 
                      class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition duration-200 bg-gray-50 focus:bg-white"
                      placeholder="Tell us what you think..."></textarea>
            @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full inline-flex items-center justify-center px-8 py-4 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 shadow-lg shadow-indigo-200 disabled:opacity-50 disabled:cursor-not-allowed">
            <span wire:loading.remove>Submit Feedback</span>
            <span wire:loading class="flex items-center gap-2">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Sending...
            </span>
        </button>
    </form>
</div>
