@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <!-- Back Navigation -->
    <div class="mb-6">
        <a href="{{ route('posts.index', $workspace) }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1 transition-colors">
            &larr; Back to all posts
        </a>
    </div>

    <!-- Post Content Card -->
    <div class="bg-white p-8 rounded-xl shadow-sm">
        <div class="border-b border-gray-100 pb-6 mb-6">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $post->title }}</h2>
            <p class="text-sm text-gray-500">
                Posted on {{ $post->created_at->format('F j, Y') }}
            </p>
        </div>
        
        <!-- The text-gray-700 and leading-relaxed classes make long paragraphs much easier to read -->
        <div class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $post->body }}</div>
    </div>
    
</div>
@endsection