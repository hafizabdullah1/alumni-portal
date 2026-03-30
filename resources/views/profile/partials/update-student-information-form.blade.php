<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Academic Information (Student)') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Ensure your enrollment and semester details are correct.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Enrollment No -->
            <div>
                <x-input-label for="enrollment_no" :value="__('Enrollment No')" />
                <x-text-input id="enrollment_no" name="enrollment_no" type="text" class="mt-1 block w-full" :value="old('enrollment_no', $user->studentProfile?->enrollment_no)" placeholder="e.g., F19-BSCS-001" />
                <x-input-error class="mt-2" :messages="$errors->get('enrollment_no')" />
            </div>

            <!-- Department -->
            <div>
                <x-input-label for="department" :value="__('Department')" />
                <x-text-input id="department" name="department" type="text" class="mt-1 block w-full" :value="old('department', $user->studentProfile?->department)" placeholder="e.g., Computer Science" />
                <x-input-error class="mt-2" :messages="$errors->get('department')" />
            </div>

            <!-- Current Semester -->
            <div>
                <x-input-label for="current_semester" :value="__('Current Semester')" />
                <x-text-input id="current_semester" name="current_semester" type="text" class="mt-1 block w-full" :value="old('current_semester', $user->studentProfile?->current_semester)" placeholder="e.g., 6th" />
                <x-input-error class="mt-2" :messages="$errors->get('current_semester')" />
            </div>

            <!-- Phone No -->
            <div>
                <x-input-label for="phone_no" :value="__('Phone No (Optional)')" />
                <x-text-input id="phone_no" name="phone_no" type="text" class="mt-1 block w-full" :value="old('phone_no', $user->studentProfile?->phone_no)" placeholder="e.g., +92 3XX XXXXXXX" />
                <x-input-error class="mt-2" :messages="$errors->get('phone_no')" />
            </div>
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
