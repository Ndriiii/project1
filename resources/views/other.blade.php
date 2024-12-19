<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Braniacs Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="main.js"></script>
</head>
<body>
    <nav>
        @include ('nav_other')
    </nav>
    
    <h2 class="flex items-center justify-center text-5xl font-bold tracking-tight text-gray-900 mt-28">Other Items</h2>
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-12 lg:max-w-7xl lg:px-8">        
        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @forelse($otherProducts as $otherProducts)
                @if($otherProducts->Diskon == 0)
                <div class="bg-gray-50 rounded-md overflow-hidden flex flex-col h-full">
                    <div class="relative group">
                        <div class="w-full overflow-hidden">
                            <img src="{{ asset('storage/' . $otherProducts->Foto_Produk) }}" alt="{{ $otherProducts->Nama_Produk }}" class="h-full w-full object-cover object-top hover:scale-110 transition-all" />
                        </div>
                    </div>
                    <div class="p-6 flex flex-col justify-between flex-grow">
                        <h3 class="text-sm text-gray-700">
                            {{ $otherProducts->Nama_Produk }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $otherProducts->Tipe_Produk }}</p>
                        <p class="text-sm font-medium text-gray-900">Rp {{ number_format($otherProducts->Harga_Produk) }}</p>
                        <form action="{{ route('cart.add', $otherProducts->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="w-full px-5 py-2.5 bg-blue-600 hover:bg-blue-700 hover:scale-105 font-bold text-white rounded-lg">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="bg-gray-50 rounded-md overflow-hidden flex flex-col h-full">
                    <div class="relative group">
                        <div class="absolute top-4 left-4 bg-red-600 text-white text-xs font-semibold py-1 px-3 transform rounded-full z-10">
                            {{ $otherProducts->Diskon }}% OFF
                        </div>
                        <div class="w-full overflow-hidden relative">
                            <img src="{{ asset('storage/' . $otherProducts->Foto_Produk) }}" alt="{{ $otherProducts->Nama_Produk }}" class="h-full w-full object-cover object-top hover:scale-110 transition-all" />
                        </div>
                    </div>
                    <div class="p-6 flex flex-col justify-between flex-grow">
                        <div class="mb-4">
                            <h3 class="text-sm text-gray-700">
                                <p>{{ $otherProducts->Nama_Produk }}</p>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $otherProducts->Tipe_Produk }}</p>
                            <p class="text-sm font-medium text-gray-900 line-through">Rp {{ number_format($otherProducts->Harga_Produk) }}</p>
                            <p class="text-sm font-medium text-red-600">Rp {{ number_format($otherProducts->Harga_Diskon) }}</p>
                        </div>
                        <form action="{{ route('cart.add', $otherProducts->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full px-5 py-2.5 bg-blue-600 hover:bg-blue-700 hover:scale-105 font-bold text-white rounded-lg">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            @empty
            <p class="text-gray-500">No others products available.</p>
            @endforelse
        </div>
    </div>
</body>
</html>