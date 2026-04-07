<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New File Tracking Entry') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    
                    <div>
                        <x-input-label for="user_id" :value="__('Target Audience / Student *')" />
                        <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">-- Choose Target --</option>
                            <option value="global" class="font-bold text-indigo-600">All Students (Global File)</option>
                            <optgroup label="Specific Students">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }}) - {{ $user->role }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="title" :value="__('File Title *')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required placeholder="e.g., Final Transcript" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="document" :value="__('Upload Document (Max 10MB) *')" />
                            <input id="document" name="document" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required accept=".pdf,.doc,.docx,.jpg,.png,.zip" />
                            <x-input-error :messages="$errors->get('document')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description (Optional)')" />
                        <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" placeholder="Add any details about this file..."></textarea>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <x-primary-button>{{ __('Upload File') }}</x-primary-button>
                        <a href="{{ route('admin.files.index') }}" class="text-sm text-gray-600 underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
