<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b border-gray-100">
                    <h3 class="text-2xl font-bold mb-2">Welcome to the Alumni Portal, {{ Auth::user()->name }}!</h3>
                    @if(Auth::user()->isAlumni() && !Auth::user()->is_verified)
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625l6.28-10.875zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Your account is under review. You'll have full access once an administrator verifies your alumni status.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <p class="text-gray-600">Connect with your peers, share opportunities, and build your professional network.</p>
                </div>
                
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if(Auth::user()->isAdmin())
                        <!-- Admin Special Cards -->
                        <a href="{{ route('admin.results.index') }}" class="group block p-6 bg-purple-50 rounded-lg border border-purple-100 hover:shadow-md transition">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-white rounded-full text-purple-600 shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                                </div>
                                <div><h4 class="text-lg font-bold text-gray-900">Exam Results</h4><p class="text-sm text-gray-600">Manage academic results.</p></div>
                            </div>
                        </a>
                        <a href="{{ route('admin.files.index') }}" class="group block p-6 bg-emerald-50 rounded-lg border border-emerald-100 hover:shadow-md transition">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-white rounded-full text-emerald-600 shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.375m1.875-10.375h-7.5c-1.036 0-1.875.84-1.875 1.875v13.5c0 1.036.84 1.875 1.875 1.875h11.25c1.036 0 1.875-.84 1.875-1.875v-10.125c0-1.036-.84-1.875-1.875-1.875h-4.875l-2.25-2.25z" /></svg>
                                </div>
                                <div><h4 class="text-lg font-bold text-gray-900">File Tracking</h4><p class="text-sm text-gray-600">Monitor doc movement.</p></div>
                            </div>
                        </a>
                    @endif

                    @if(Auth::user()->isStudent())
                        <a href="{{ route('student.services') }}" class="group block p-6 bg-blue-50 rounded-lg border border-blue-100 hover:shadow-md transition">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-white rounded-full text-blue-600 shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.174L10.74 8.16m0 0L16.5 10.015m-5.76-1.855v4.542l4.26 1.42M10.74 8.16L4.26 10.174m0 0L3 13.5h15.48l-1.22-3.326zM10.74 8.16L16.5 10.015M16.5 10.015L18 13.5M10.74 12.702l4.26 1.42m0 0L16.5 17.25M15 12.702v4.548" /></svg>
                                </div>
                                <div><h4 class="text-lg font-bold text-gray-900">My Results & Files</h4><p class="text-sm text-gray-600">Check grades & status.</p></div>
                            </div>
                        </a>
                    @endif

                    @if(Auth::user()->isAlumni())
                        <a href="{{ route('mentorship.index') }}" class="group block p-6 bg-amber-50 rounded-lg border border-amber-100 hover:shadow-md transition">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-white rounded-full text-amber-600 shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg>
                                </div>
                                <div><h4 class="text-lg font-bold text-gray-900">Mentorship</h4><p class="text-sm text-gray-600">Guide the students.</p></div>
                            </div>
                        </a>
                    @endif

                    <a href="{{ route('alumni.index') }}" class="group block p-6 bg-slate-50 rounded-lg border border-slate-100 hover:shadow-md transition">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-white rounded-full text-slate-600 shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                            </div>
                            <div><h4 class="text-lg font-bold text-gray-900">Directory</h4><p class="text-sm text-gray-600">Connect with others.</p></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
