<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

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
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Products</h1>

    <div class="mb-4">
        <form method="GET" action="{{ route('products.index') }}">
            <div class="flex space-x-4">
                <input
                    type="text"
                    name="seller_name"
                    placeholder="Filter by seller name"
                    class="border p-2 w-full"
                    value="{{ request('seller_name') }}"
                />
                <input
                    type="text"
                    name="product_name"
                    placeholder="Filter by product name"
                    class="border p-2 w-full"
                    value="{{ request('product_name') }}"
                />
                <button type="submit" class="bg-blue-500 text-white p-2">Filter</button>
            </div>
        </form>
    </div>

    @auth
        @if(auth()->user()->type === 'seller') <!-- Show create button only for sellers -->
        <div class="mb-4">
            <a href="{{ route('products.create') }}" class="bg-green-500 text-white p-2">Create Product</a>
        </div>
        @endif
    @endauth

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr>
                <th class="border px-4 py-2">Product Name</th>
                <th class="border px-4 py-2">Seller</th>
                <th class="border px-4 py-2">Price</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Image</th>
                <th class="border px-4 py-2">Offer</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="border px-4 py-2 font-bold">{{ $product->name }}</td>
                    <td class="border px-4 py-2">{{ $product->seller->name }}</td>
                    <td class="border px-4 py-2">${{ $product->price }}</td>
                    <td class="border px-4 py-2">{{ $product->description }}</td>
                    <td class="border px-4 py-2">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-20 h-auto" />
                        @else
                            <p>No image available.</p>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        <form method="POST" action="{{ route('offers.store') }}" class="mt-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div>
                                <label for="offer_price" class="sr-only">Your Offer Price:</label>
                                <input type="number" name="offer_price" required step="0.01" min="0" class="border p-1 w-full" placeholder="Your Offer Price">
                            </div>
                            <button type="submit" class="bg-blue-500 text-white p-2 mt-2">Submit Offer</button>
                        </form>
                    </td>
                    </td>
                    @auth
                        @if(auth()->user()->id === $product->seller_id)
                        <td class="border px-4 py-2">
                            <a href="{{ route('products.show', $product->id) }}" class="bg-blue-500 text-white p-2 ">View Offers</a>
                        </td>
                        @endif
                    @endauth
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
