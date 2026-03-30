<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post News or Event Update') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900 border-b border-gray-100">
                    <p class="text-sm text-gray-600">Share important news, upcoming reunions, or university updates with the network.</p>
                </div>
                
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.news.store') }}" class="space-y-6">
                        @csrf

                        <!-- Article Title -->
                        <div>
                            <x-input-label for="title" :value="__('Article Title *')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus placeholder="e.g. Annual Alumni Reunion 2026" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Type Selection -->
                            <div>
                                <x-input-label for="type" :value="__('Article Type *')" />
                                <select id="type" name="type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" x-data @change="$dispatch('type-changed', $event.target.value)">
                                    <option value="news" {{ old('type') == 'news' ? 'selected' : '' }}>News Update</option>
                                    <option value="event" {{ old('type') == 'event' ? 'selected' : '' }}>Upcoming Event</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>

                            <!-- Image URL -->
                            <div>
                                <x-input-label for="image_url" :value="__('Cover Image URL (Optional)')" />
                                <x-text-input id="image_url" name="image_url" type="url" class="mt-1 block w-full" :value="old('image_url')" placeholder="https://example.com/image.jpg" />
                                <x-input-error class="mt-2" :messages="$errors->get('image_url')" />
                            </div>
                        </div>

                        <!-- Event Date (Conditional) -->
                        <div x-data="{ isEvent: {{ old('type') == 'event' ? 'true' : 'false' }} }" 
                             x-on:type-changed.window="isEvent = ($event.detail === 'event')"
                             x-show="isEvent"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             class="bg-indigo-50 p-4 rounded-md border border-indigo-100">
                            <x-input-label for="event_date" :value="__('Event Date & Time *')" />
                            <x-text-input id="event_date" name="event_date" type="datetime-local" class="mt-1 block w-full" :value="old('event_date')" />
                            <x-input-error class="mt-2" :messages="$errors->get('event_date')" />
                            <p class="text-xs text-indigo-600 mt-1">If specified, this will be highlighted as an upcoming event.</p>
                        </div>

                        <!-- Content -->
                        <div>
                            <x-input-label for="content" :value="__('Content *')" />
                            <textarea id="content" name="content" rows="6" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required placeholder="Write the main article or event details here...">{{ old('content') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                            <x-primary-button>{{ __('Publish Content') }}</x-primary-button>
                            <a href="{{ route('news.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
