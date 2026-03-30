<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alumni Directory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($alumni as $user)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 hover:shadow-md transition-shadow duration-200">
                        <div class="p-6">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-lg">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-lg font-bold text-gray-900 truncate">
                                        {{ $user->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
                                        {{ $user->alumniProfile?->job_title ?? 'Alumnus' }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mt-4 space-y-2">
                                @if($user->alumniProfile?->company)
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6.75h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h18v18H3V3z" />
                                        </svg>
                                        {{ $user->alumniProfile->company }}
                                    </div>
                                @endif

                                @if($user->alumniProfile?->graduation_year)
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.174L10.74 8.16m0 0L16.5 10.015m-5.76-1.855v4.542l4.26 1.42M10.74 8.16L4.26 10.174m0 0L3 13.5h15.48l-1.22-3.326zM10.74 8.16L16.5 10.015M16.5 10.015L18 13.5M10.74 12.702l4.26 1.42m0 0L16.5 17.25M15 12.702v4.548" />
                                        </svg>
                                        Class of {{ $user->alumniProfile->graduation_year }}
                                    </div>
                                @endif

                                @if($user->alumniProfile?->location)
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        {{ $user->alumniProfile->location }}
                                    </div>
                                @endif
                            </div>

                            <div class="mt-6 space-y-2">
                                <a href="mailto:{{ $user->email }}" class="block w-full text-center bg-indigo-50 text-indigo-700 py-2 rounded-md text-sm font-semibold hover:bg-indigo-100 transition duration-150">
                                    Send Email
                                </a>

                                @if(Auth::user()->isStudent())
                                    <form action="{{ route('alumni.mentor.request', $user) }}" method="POST" class="mt-2 space-y-2 border-t pt-2">
                                        @csrf
                                        <div class="text-[10px] text-gray-500 font-bold uppercase mb-1">Request Mentorship</div>
                                        <textarea name="message" class="w-full text-xs rounded border-gray-300" placeholder="Hello! I'm looking for mentoring in..." required></textarea>
                                        <x-primary-button class="w-full !py-1 text-[10px]">Request Mentorship</x-primary-button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-gray-500">
                        No verified alumni found in the directory yet.
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $alumni->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
