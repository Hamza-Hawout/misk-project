<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900">
<!-- Navbar -->
<nav class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div>
            <a href="{{ route('products.index') }}" class="text-lg font-bold text-blue-600">MyShop</a>
        </div>
        <div class="flex space-x-4">
            <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-500">Products</a>
            @auth
                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-500">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-blue-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-500">Register</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container mx-auto py-12">
    <h1 class="text-2xl font-bold mb-6">Create Product</h1>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 dark:text-gray-200">Name:</label>
            <input type="text" name="name" required maxlength="200" class="border border-gray-300 rounded-md p-2 w-full">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 dark:text-gray-200">Description:</label>
            <textarea name="description" required minlength="50" class="border border-gray-300 rounded-md p-2 w-full"></textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 dark:text-gray-200">Price:</label>
            <input type="number" name="price" required class="border border-gray-300 rounded-md p-2 w-full">
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 dark:text-gray-200">Image:</label>
            <input type="file" name="image" required class="border border-gray-300 rounded-md p-2 w-full">
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Create Product</button>
    </form>
</div>

</body>
</html>
