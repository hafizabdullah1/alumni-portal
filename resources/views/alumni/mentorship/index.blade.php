<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentorship Opportunities') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h3 class="text-xl font-bold mb-6">Received Mentorship Requests</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($requests as $request)
                        <div class="p-6 border rounded-2xl bg-gray-50 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-sm font-bold text-indigo-600">From: {{ $request->student->name }}</span>
                                    <span class="px-3 py-1 text-xs rounded-full {{ $request->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($request->status == 'accepted' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </div>
                                <p class="text-gray-700 italic border-l-4 border-indigo-200 pl-4 mb-6">"{{ $request->message ?? 'No message provided.' }}"</p>
                            </div>

                            @if($request->status == 'pending')
                                <div class="flex gap-4">
                                    <form action="{{ route('mentorship.update', $request) }}" method="POST" class="flex-1">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="w-full py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-sm transition">
                                            Accept Request
                                        </button>
                                    </form>
                                    <form action="{{ route('mentorship.update', $request) }}" method="POST" class="flex-1">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="declined">
                                        <button type="submit" class="w-full py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-sm transition">
                                            Decline
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-gray-500 italic">No mentorship requests received yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
