<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New File Tracking Entry') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.files.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    
                    <div>
                        <x-input-label for="user_id" :value="__('Select Student/User *')" />
                        <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">-- Choose User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }}) - {{ $user->role }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="file_no" :value="__('File Number *')" />
                            <x-text-input id="file_no" name="file_no" type="text" class="mt-1 block w-full" required placeholder="e.g., DEG-2026-001" />
                        </div>
                        <div>
                            <x-input-label for="title" :value="__('File Title *')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required placeholder="e.g., Degree Issuance" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="current_deparment" :value="__('Initial Department *')" />
                        <x-text-input id="current_deparment" name="current_deparment" type="text" class="mt-1 block w-full" required placeholder="e.g., Registrar Office" />
                    </div>

                    <div>
                        <x-input-label for="status" :value="__('Initial Status *')" />
                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="dispatched">Dispatched</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label for="remarks" :value="__('Remarks (Optional)')" />
                        <textarea name="remarks" id="remarks" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3"></textarea>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <x-primary-button>{{ __('Create Entry') }}</x-primary-button>
                        <a href="{{ route('admin.files.index') }}" class="text-sm text-gray-600 underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
