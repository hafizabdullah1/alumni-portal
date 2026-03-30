<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Professional & Academic Information (Alumnus)') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your career and graduation details to stay connected with the network.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Graduation Year -->
            <div>
                <x-input-label for="graduation_year" :value="__('Graduation Year')" />
                <x-text-input id="graduation_year" name="graduation_year" type="text" class="mt-1 block w-full" :value="old('graduation_year', $user->alumniProfile?->graduation_year)" placeholder="e.g., 2020" />
                <x-input-error class="mt-2" :messages="$errors->get('graduation_year')" />
            </div>

            <!-- Department -->
            <div>
                <x-input-label for="department" :value="__('Department')" />
                <x-text-input id="department" name="department" type="text" class="mt-1 block w-full" :value="old('department', $user->alumniProfile?->department)" placeholder="e.g., Computer Science" />
                <x-input-error class="mt-2" :messages="$errors->get('department')" />
            </div>

            <!-- Job Title -->
            <div>
                <x-input-label for="job_title" :value="__('Current Job Title')" />
                <x-text-input id="job_title" name="job_title" type="text" class="mt-1 block w-full" :value="old('job_title', $user->alumniProfile?->job_title)" placeholder="e.g., Software Engineer" />
                <x-input-error class="mt-2" :messages="$errors->get('job_title')" />
            </div>

            <!-- Company -->
            <div>
                <x-input-label for="company" :value="__('Company')" />
                <x-text-input id="company" name="company" type="text" class="mt-1 block w-full" :value="old('company', $user->alumniProfile?->company)" placeholder="e.g., Tech Solutions Inc." />
                <x-input-error class="mt-2" :messages="$errors->get('company')" />
            </div>

            <!-- Location -->
            <div>
                <x-input-label for="location" :value="__('Location')" />
                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $user->alumniProfile?->location)" placeholder="e.g., Islamabad, Pakistan" />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>

            <!-- LinkedIn URL -->
            <div>
                <x-input-label for="linkedin_url" :value="__('LinkedIn Profile URL')" />
                <x-text-input id="linkedin_url" name="linkedin_url" type="text" class="mt-1 block w-full" :value="old('linkedin_url', $user->alumniProfile?->linkedin_url)" placeholder="https://linkedin.com/in/username" />
                <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
            </div>
        </div>

        <!-- Bio -->
        <div>
            <x-input-label for="bio" :value="__('Short Bio')" />
            <textarea id="bio" name="bio" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" placeholder="Tell us about yourself...">{{ old('bio', $user->alumniProfile?->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save Changes') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
