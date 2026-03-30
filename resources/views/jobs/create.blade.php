<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post a New Job/Internship') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('jobs.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Job Title -->
                            <div>
                                <x-input-label for="title" :value="__('Job Title *')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus placeholder="e.g. Junior Web Developer" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <!-- Company -->
                            <div>
                                <x-input-label for="company" :value="__('Company Name *')" />
                                <x-text-input id="company" name="company" type="text" class="mt-1 block w-full" :value="old('company')" required placeholder="e.g. Google" />
                                <x-input-error class="mt-2" :messages="$errors->get('company')" />
                            </div>

                            <!-- Location -->
                            <div>
                                <x-input-label for="location" :value="__('Location')" />
                                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location')" placeholder="e.g. Islamabad, Pakistan / Remote" />
                                <x-input-error class="mt-2" :messages="$errors->get('location')" />
                            </div>

                            <!-- Job Type -->
                            <div>
                                <x-input-label for="type" :value="__('Job Type *')" />
                                <select id="type" name="type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="full-time" {{ old('type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                    <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                                    <option value="internship" {{ old('type') == 'internship' ? 'selected' : '' }}>Internship</option>
                                    <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Job Description *')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required placeholder="Describe the job role and responsibilities...">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <!-- Requirements -->
                        <div>
                            <x-input-label for="requirements" :value="__('Requirements / Qualifications')" />
                            <textarea id="requirements" name="requirements" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="List key requirements or skills needed...">{{ old('requirements') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('requirements')" />
                        </div>

                        <!-- Apply URL -->
                        <div>
                            <x-input-label for="apply_url" :value="__('Apply URL (External Link)')" />
                            <x-text-input id="apply_url" name="apply_url" type="url" class="mt-1 block w-full" :value="old('apply_url')" placeholder="https://example.com/apply" />
                            <x-input-error class="mt-2" :messages="$errors->get('apply_url')" />
                            <p class="text-xs text-gray-500 mt-1">If specified, users will be redirected to this link to apply.</p>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Post Job') }}</x-primary-button>
                            <a href="{{ route('jobs.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
