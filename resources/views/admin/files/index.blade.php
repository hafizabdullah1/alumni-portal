<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('File Tracking System') }}
            </h2>
            <a href="{{ route('admin.files.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold uppercase tracking-widest rounded-lg shadow-sm transition duration-150 ease-in-out">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                {{ __('New File Entry') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title & Details</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target Audience</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploaded On</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($files as $file)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $file->title }}</div>
                                    @if($file->description)
                                        <div class="text-xs text-gray-500 mt-1 truncate max-w-xs">{{ $file->description }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($file->is_global)
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 uppercase">
                                            All Students (Global)
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-900 font-medium">{{ optional($file->user)->name }}</span>
                                        <div class="text-xs text-gray-500">{{ optional($file->user)->email }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $file->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('admin.files.update', $file) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this file?');">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="delete" value="1">
                                        <x-danger-button class="!py-1 !px-2 text-xs">Delete</x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $files->links() }}</div>
        </div>
    </div>
</x-app-layout>
