<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Examination Result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.results.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    
                    <div>
                        <x-input-label for="user_id" :value="__('Select Student *')" />
                        <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">-- Choose Student --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="semester" :value="__('Semester *')" />
                            <x-text-input id="semester" name="semester" type="text" class="mt-1 block w-full" required placeholder="e.g., 6th Semester" />
                        </div>
                        <div>
                            <x-input-label for="subject" :value="__('Subject *')" />
                            <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" required placeholder="e.g., Software Engineering" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="grade" :value="__('Grade *')" />
                            <x-text-input id="grade" name="grade" type="text" class="mt-1 block w-full" required placeholder="e.g., A, B+, C" />
                        </div>
                        <div>
                            <x-input-label for="gpa" :value="__('GPA (Optional)')" />
                            <x-text-input id="gpa" name="gpa" type="text" class="mt-1 block w-full" placeholder="e.g., 3.65" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <x-primary-button>{{ __('Upload Result') }}</x-primary-button>
                        <a href="{{ route('admin.results.index') }}" class="text-sm text-gray-600 underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
