<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('University News & Events') }}
            </h2>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Post Update') }}
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- News & Events Feed -->
            <div class="space-y-8">
                @forelse ($newsEvents as $item)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 flex flex-col md:flex-row transition-all duration-200">
                        <div class="md:w-1/4 h-48 md:h-auto overflow-hidden bg-gray-200 flex-shrink-0">
                            @php
                                $img = $item->image_url;
                                if($img && !str_starts_with($img, 'http')) $img = asset('storage/' . $img);
                            @endphp
                            <img src="{{ $img }}" alt="{{ $item->title }}" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/600x400?text=News+Image'">
                        </div>

                        <div class="p-6 flex-grow">
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->type === 'event' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }} uppercase tracking-wider">
                                    {{ $item->type }}
                                </span>
                                <span class="text-xs text-gray-500 italic">
                                    {{ $item->created_at->format('M d, Y') }}
                                </span>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $item->title }}</h3>

                            @if($item->type === 'event' && $item->event_date)
                                <div class="mb-4 flex items-center text-sm font-semibold text-indigo-600">
                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                    Event Date: {{ $item->event_date->format('F d, Y @ h:i A') }}
                                </div>
                            @endif

                            <div class="text-gray-700 leading-relaxed mb-6">
                                {{ $item->content }}
                            </div>

                            <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-50 text-sm">
                                <span class="text-gray-500">Posted by {{ $item->user->name }}</span>
                                
                                @if(Auth::user()->isAdmin())
                                    <form action="{{ route('admin.news.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                                            Delete Post
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12 text-center text-gray-500 border border-dashed border-gray-300">
                        No news or events posted yet.
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $newsEvents->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
