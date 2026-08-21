@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm">
    <h2 class="text-2xl font-bold mb-6 text-gray-900">Edit Post</h2>

    <form action="{{ route('posts.update', [$workspace, $post]) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Title Input -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" value="{{ $post->title }}" required class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2 border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
        </div>

        <!-- Body Input -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
            <textarea name="body" rows="5" required class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2 border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ $post->body }}</textarea>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
            <a href="{{ route('posts.index', $workspace) }}" class="text-gray-500 hover:text-gray-800 font-medium">Cancel</a>
            <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">Update Post</button>
        </div>
    </form>
</div>
@endsection