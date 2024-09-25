<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Offers</title>
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

        <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>
        <p>Seller: {{ $product->seller->name }}</p>
        <p>Price: ${{ $product->price }}</p>
        <p>Description: {{ $product->description }}</p>

        <h2 class="text-xl mt-4">Offers:</h2>

        @if($product->offers->isEmpty())
            <p>No offers yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="border px-4 py-2">User</th>
                        <th class="border px-4 py-2">Offer Price</th>
                        <th class="border px-4 py-2">Submitted On</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($product->offers as $offer)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="border px-4 py-2">{{ $offer->user->name }}</td>
                            <td class="border px-4 py-2">${{ $offer->offer_price }}</td>
                            <td class="border px-4 py-2">{{ $offer->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</body>
</html>
