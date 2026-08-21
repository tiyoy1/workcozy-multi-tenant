@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Title</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Created</th>
                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($posts as $post)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 font-medium text-gray-900">{{ $post->title }}</td>
                <td class="px-6 py-4 text-gray-500 text-sm">{{ $post->created_at->diffForHumans() }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    
                    <!-- View -->
                    <a href="{{ route('posts.show', [$workspace, $post]) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">View</a>
                    
                    <!-- Edit -->
                    <a href="{{ route('posts.edit', [$workspace, $post]) }}" class="text-amber-600 hover:text-amber-900 text-sm font-medium">Edit</a>
                    
                    <!-- Delete Form -->
                    <form action="{{ route('posts.destroy', [$workspace, $post]) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Delete</button>
                    </form>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @if($posts->isEmpty())
        <div class="p-8 text-center text-gray-500">No posts found. Create one above!</div>
    @endif
</div>
@endsection