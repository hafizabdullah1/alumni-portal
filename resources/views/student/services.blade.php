<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Services (Exam Results & File Status)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Exam Results Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-4 border-indigo-500">
                <h3 class="text-lg font-bold mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                    Examination Results
                </h3>
                @forelse($results as $result)
                    <div class="mb-4 p-4 bg-gray-50 rounded-lg border flex justify-between items-center">
                        <div>
                            <div class="text-xs uppercase text-gray-500">Semester: {{ $result->semester }}</div>
                            <div class="font-bold text-gray-900">{{ $result->subject }}</div>
                        </div>
                        <div class="text-2xl font-black text-indigo-600">{{ $result->grade }}</div>
                    </div>
                @empty
                    <p class="text-gray-500 py-4">No results uploaded yet.</p>
                @endforelse
            </div>

            <!-- File Tracking Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-4 border-green-500">
                <h3 class="text-lg font-bold mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.375m1.875-10.375h-7.5c-1.036 0-1.875.84-1.875 1.875v13.5c0 1.036.84 1.875 1.875 1.875h11.25c1.036 0 1.875-.84 1.875-1.875v-10.125c0-1.036-.84-1.875-1.875-1.875h-4.875l-2.25-2.25z" /></svg>
                    File Tracking Status
                </h3>
                @forelse($files as $file)
                    <div class="mb-4 p-4 bg-gray-50 rounded-lg border">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <div class="text-xs font-bold text-gray-900">#{{ $file->file_no }}</div>
                                <div class="text-sm font-medium">{{ $file->title }}</div>
                            </div>
                            <span class="px-2 py-1 text-[10px] rounded-full bg-blue-100 text-blue-700 font-bold uppercase">{{ $file->status }}</span>
                        </div>
                        <div class="text-xs text-gray-600 italic">Current Location: {{ $file->current_deparment }}</div>
                        @if($file->remarks)
                            <div class="mt-2 text-xs text-gray-500 border-t pt-2">{{ $file->remarks }}</div>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 py-4">No files currently being tracked.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
