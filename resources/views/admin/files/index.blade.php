<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('File Tracking System') }}
            </h2>
            <a href="{{ route('admin.files.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title/Applicant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Department</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Update</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($files as $file)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $file->file_no }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $file->title }}</div>
                                    <div class="text-xs text-gray-500">{{ $file->user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $file->current_deparment }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 uppercase">
                                        {{ $file->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('admin.files.update', $file) }}" method="POST" class="flex items-center space-x-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="text" name="current_deparment" value="{{ $file->current_deparment }}" class="text-xs rounded border-gray-300 w-24">
                                        <select name="status" class="text-xs rounded border-gray-300">
                                            <option value="pending" {{ $file->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $file->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="dispatched" {{ $file->status == 'dispatched' ? 'selected' : '' }}>Dispatched</option>
                                        </select>
                                        <x-primary-button class="!py-1 !px-2 text-[10px]">OK</x-primary-button>
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
