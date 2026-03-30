<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-indigo-600 overflow-hidden shadow-sm sm:rounded-lg text-white">
                    <div class="p-6">
                        <p class="text-xs font-bold uppercase tracking-widest opacity-75">{{ __('Total Alumni') }}</p>
                        <p class="text-3xl font-black">{{ $totalAlumni }}</p>
                    </div>
                </div>
                <div class="bg-amber-500 overflow-hidden shadow-sm sm:rounded-lg text-white">
                    <div class="p-6">
                        <p class="text-xs font-bold uppercase tracking-widest opacity-75">{{ __('Pending Approvals') }}</p>
                        <p class="text-3xl font-black">{{ $pendingAlumni }}</p>
                    </div>
                </div>
                <div class="bg-emerald-600 overflow-hidden shadow-sm sm:rounded-lg text-white">
                    <div class="p-6">
                        <p class="text-xs font-bold uppercase tracking-widest opacity-75">{{ __('Total Students') }}</p>
                        <p class="text-3xl font-black">{{ $totalStudents }}</p>
                    </div>
                </div>
            </div>

            <!-- Admin Actions Block -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <a href="{{ route('admin.files.index') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all flex items-center space-x-4">
                    <div class="p-4 bg-emerald-50 text-emerald-600 rounded-xl group-hover:scale-110 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.375m1.875-10.375h-7.5c-1.036 0-1.875.84-1.875 1.875v13.5c0 1.036.84 1.875 1.875 1.875h11.25c1.036 0 1.875-.84 1.875-1.875v-10.125c0-1.036-.84-1.875-1.875-1.875h-4.875l-2.25-2.25z" /></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">File Tracking</h4>
                        <p class="text-xs text-gray-500">Manage file movement</p>
                    </div>
                </a>

                <a href="{{ route('admin.results.index') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all flex items-center space-x-4">
                    <div class="p-4 bg-purple-50 text-purple-600 rounded-xl group-hover:scale-110 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Exam Results</h4>
                        <p class="text-xs text-gray-500">Upload academic results</p>
                    </div>
                </a>

                <a href="{{ route('admin.news.create') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all flex items-center space-x-4">
                    <div class="p-4 bg-blue-50 text-blue-600 rounded-xl group-hover:scale-110 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" /></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Post News</h4>
                        <p class="text-xs text-gray-500">Announce events & news</p>
                    </div>
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">{{ __('Pending Alumni Verification') }}</h3>

                    @if (session('status'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('status') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered At</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pendingUsers as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('admin.users.verify', $user) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded-md transition duration-150 ease-in-out">
                                                    Verify
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No pending verifications found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
