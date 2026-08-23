<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workspace App</title>
    <!-- Tailwind CSS CDN for instant styling -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    <!-- Top Navigation Bar -->
    <nav class="bg-white shadow-md px-6 py-4 mb-8">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-900">
                🚀 {{ $workspace->slug ?? 'My Workspace' }}
            </h1>
            @isset($workspace)
            <a href="{{ route('posts.create', $workspace) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                + New Post
            </a>
            @endisset
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-6">
        @yield('content')
    </main>

</body>
</html>