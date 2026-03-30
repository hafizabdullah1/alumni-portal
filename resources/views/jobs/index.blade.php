<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Job & Internship Portal') }}
            </h2>
            @if(Auth::user()->isAlumni() && Auth::user()->is_verified)
                <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Post a Job') }}
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search & Filter Bar -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('jobs.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-grow">
                            <x-text-input name="search" type="text" class="w-full" placeholder="Search by title, company, or location..." :value="request('search')" />
                        </div>
                        <x-primary-button>
                            {{ __('Search') }}
                        </x-primary-button>
                        @if(request('search'))
                            <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition ease-in-out duration-150">
                                {{ __('Clear') }}
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="space-y-4">
                @forelse ($jobs as $job)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200 border border-gray-100">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div class="flex-grow">
                                    <div class="flex items-center space-x-2">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $job->title }}</h3>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $job->type === 'internship' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }} capitalize">
                                            {{ $job->type }}
                                        </span>
                                    </div>
                                    <p class="text-lg font-medium text-indigo-600">{{ $job->company }}</p>
                                    
                                    <div class="mt-2 flex flex-wrap gap-x-6 gap-y-2 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                            </svg>
                                            {{ $job->location ?? 'Remote / Not specified' }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $job->created_at->diffForHumans() }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                            </svg>
                                            Posted by {{ $job->user->name }}
                                        </div>
                                    </div>

                                    <div class="mt-4 text-gray-700 line-clamp-2">
                                        {{ $job->description }}
                                    </div>
                                </div>
                                
                                <div class="flex flex-col items-end space-y-2 ml-4">
                                    @if($job->apply_url)
                                        <a href="{{ $job->apply_url }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition duration-150">
                                            Apply Now
                                        </a>
                                    @endif

                                    @if(Auth::user()->isAdmin() || Auth::user()->id === $job->user_id)
                                        <form action="{{ route('jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                                Delete Post
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12 text-center text-gray-500 border border-dashed border-gray-300">
                        No job postings found matching your criteria.
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
