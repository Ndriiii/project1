
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="main.js"></script>
  <title>Braniacs Store</title>
</head>
<body>
    <nav>
        @include('nav_main')
    </nav>

<div id="animated-carousel" class="relative w-full mt-28">
    <!-- Carousel Wrapper -->
    <div class="relative overflow-hidden rounded-lg w-2/4 mx-auto">
        <!-- Slides -->
        <div class="flex transition-transform duration-700 ease-in-out" id="carousel-track">
            <div class="flex-shrink-0 w-full">
                <img src="/img/carousel1.jpg" class="w-full h-full object-cover" alt="Slide 1">
            </div>
            <div class="flex-shrink-0 w-full">
                <img src="/img/carousel2.jpg" class="w-full h-full object-cover" alt="Slide 2">
            </div>
            <div class="flex-shrink-0 w-full">
                <img src="/img/carousel3.jpg" class="w-full h-full object-cover" alt="Slide 3">
            </div>
        </div>
    </div>

    <!-- Indicators -->
    <div class="absolute z-30 flex space-x-3 bottom-5 left-1/2 -translate-x-1/2">
        <button class="w-3 h-3 rounded-full bg-gray-400" data-slide-to="0"></button>
        <button class="w-3 h-3 rounded-full bg-gray-400" data-slide-to="1"></button>
        <button class="w-3 h-3 rounded-full bg-gray-400" data-slide-to="2"></button>
    </div>

    <!-- Navigation Controls -->
    <button type="button" class="absolute top-0 left-80 z-30 flex items-center justify-center h-full px-4 focus:outline-none" id="prev-btn">
        <span class="inline-flex items-center justify-center w-10 h-10 bg-gray-800/30 rounded-full group-hover:bg-gray-800">
            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </span>
    </button>
    <button type="button" class="absolute top-0 right-80 z-30 flex items-center justify-center h-full px-4 focus:outline-none" id="next-btn">
        <span class="inline-flex items-center justify-center w-10 h-10 bg-gray-800/30 rounded-full group-hover:bg-gray-800">
            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </span>
    </button>
</div>
  
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-0 lg:max-w-7xl lg:px-8">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 pointer-events-none" id="Limited-Offer">Limited Offer</h2>
            <h2 class="text-blue-600 font-semibold hover:text-yellow-800"><a href="{{ route('offers') }}">See more... </a></h2>
        </div>
        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @forelse($discountedProducts as $discountedProducts)
            <!-- Product 1 -->
            <div class="bg-gray-50 rounded-md overflow-hidden flex flex-col h-full">
                <div class="relative group">
                    <!-- Discount Tag -->
                    <div class="absolute top-4 left-4 bg-red-600 text-white text-xs font-semibold py-1 px-3 transform rounded-full z-10">
                        {{$discountedProducts->Diskon}}% OFF
                    </div>
    
                    <!-- Product Image -->
                    <div class="w-full overflow-hidden relative">
                        <img src="{{ asset('storage/' . $discountedProducts->Foto_Produk) }}" alt="{{ $discountedProducts->Nama_Produk }}" class="h-full w-full object-cover object-top hover:scale-110 transition-all"/>
                    </div>
                </div>
                <!-- Product Info -->
                <div class="p-6 flex flex-col justify-between flex-grow">
                    <div class="mb-6">
                        <h3 class="text-sm text-gray-700">
                            <p>
                                {{$discountedProducts->Nama_Produk}}
                            </p>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">{{$discountedProducts->Tipe_Produk}}</p>
    
                        <!-- Price with Discount -->
                        <p class="text-sm font-medium text-gray-900 line-through">Rp {{number_format($discountedProducts->Harga_Produk)}}</p> <!-- Original Price -->
                        <p class="text-sm font-medium text-red-600">Rp {{number_format($discountedProducts->Harga_Produk * (1 - ($discountedProducts->Diskon/100)))}}</p> <!-- Discounted Price (30% off) -->
    
                    </div>
                    <form action="{{ route('cart.add', $discountedProducts->id) }}" method="POST" class="mt-16">
                        @csrf
                        <button type="submit" class="w-full px-5 py-2.5 bg-blue-600 hover:bg-blue-700 hover:scale-105 font-bold text-white rounded-lg">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <p class="text-gray-500">No discounted products available.</p>
            @endforelse
        </div>
    </div>
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-15 lg:max-w-7xl lg:px-8 pointer-event-none">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 pointer-events-none" id="clothing">Clothing</h2>
            <h2 class="text-blue-600 font-semibold hover:text-yellow-800">
                <a href="{{ route('clothing') }}">See more...</a>
            </h2>
        </div>
        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @forelse($clothingProducts as $clothingProducts)
            @if($clothingProducts->Diskon == 0)
            <div class="bg-gray-50 rounded-md overflow-hidden flex flex-col h-full">
                <div class="relative group">
                    <div class="w-full overflow-hidden">
                        <img src="{{ asset('storage/' . $clothingProducts->Foto_Produk) }}" alt="{{ $clothingProducts->Nama_Produk }}" class="h-full w-full object-cover object-top hover:scale-110 transition-all" />
                    </div>
                </div>
                <div class="p-6 flex flex-col justify-between flex-grow">
                    <h3 class="text-sm text-gray-700">
                        {{ $clothingProducts->Nama_Produk }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $clothingProducts->Tipe_Produk }}</p>
                    <p class="text-sm font-medium text-gray-900">Rp {{ number_format($clothingProducts->Harga_Produk) }}</p>
                    <form action="{{ route('cart.add', $clothingProducts->id) }}" method="POST" class="mt-4">
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
                    <!-- Discount Tag -->
                    <div class="absolute top-4 left-4 bg-red-600 text-white text-xs font-semibold py-1 px-3 transform rounded-full z-10">
                        {{ $clothingProducts->Diskon }}% OFF
                    </div>
                    <div class="w-full overflow-hidden relative">
                        <img src="{{ asset('storage/' . $clothingProducts->Foto_Produk) }}" alt="{{ $clothingProducts->Nama_Produk }}" class="h-full w-full object-cover object-top hover:scale-110 transition-all" />
                    </div>
                </div>
                <div class="p-6 flex flex-col justify-between flex-grow">
                    <div class="mb-4">
                        <h3 class="text-sm text-gray-700">
                            <p>{{ $clothingProducts->Nama_Produk }}</p>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $clothingProducts->Tipe_Produk }}</p>
                        <!-- Price with Discount -->
                        <p class="text-sm font-medium text-gray-900 line-through">Rp {{ number_format($clothingProducts->Harga_Produk) }}</p>
                        <p class="text-sm font-medium text-red-600">Rp {{ number_format($clothingProducts->Harga_Diskon) }}</p>
                    </div>
                    <form action="{{ route('cart.add', $clothingProducts->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-5 py-2.5 bg-blue-600 hover:bg-blue-700 hover:scale-105 font-bold text-white rounded-lg">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
            
            @endif
            @empty
            <p class="text-gray-500">No clothing products available.</p>
            @endforelse
        </div>
    </div>

    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-15 lg:max-w-7xl lg:px-8 pointer-event-none">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 pointer-events-none" id="gaming">Gaming</h2>
            <h2 class="text-blue-600 font-semibold hover:text-yellow-800">
                <a href="{{ route('gaming') }}">See more...</a>
            </h2>
        </div>
        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @forelse($gamingProducts as $gamingProducts)
            @if($gamingProducts->Diskon == 0)
            <div class="bg-gray-50 rounded-md overflow-hidden flex flex-col h-full">
                <div class="relative group">
                    <div class="w-full overflow-hidden">
                        <img src="{{ asset('storage/' . $gamingProducts->Foto_Produk) }}" alt="{{ $gamingProducts->Nama_Produk }}" class="h-full w-full object-cover object-top hover:scale-110 transition-all" />
                    </div>
                </div>
                <div class="p-6 flex flex-col justify-between flex-grow">
                    <h3 class="text-sm text-gray-700">
                        {{ $gamingProducts->Nama_Produk }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $gamingProducts->Tipe_Produk }}</p>
                    <p class="text-sm font-medium text-gray-900">Rp {{ number_format($gamingProducts->Harga_Produk) }}</p>
                    <form action="{{ route('cart.add', $gamingProducts->id) }}" method="POST" class="mt-4">
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
                    <!-- Discount Tag -->
                    <div class="absolute top-4 left-4 bg-red-600 text-white text-xs font-semibold py-1 px-3 transform rounded-full z-10">
                        {{ $gamingProducts->Diskon }}% OFF
                    </div>
                    <div class="w-full overflow-hidden relative">
                        <img src="{{ asset('storage/' . $gamingProducts->Foto_Produk) }}" alt="{{ $gamingProducts->Nama_Produk }}" class="h-full w-full object-cover object-top hover:scale-110 transition-all" />
                    </div>
                </div>
                <div class="p-6 flex flex-col justify-between flex-grow">
                    <div class="mb-4">
                        <h3 class="text-sm text-gray-700">
                            <p>{{ $gamingProducts->Nama_Produk }}</p>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $gamingProducts->Tipe_Produk }}</p>
                        <!-- Price with Discount -->
                        <p class="text-sm font-medium text-gray-900 line-through">Rp {{ number_format($gamingProducts->Harga_Produk) }}</p>
                        <p class="text-sm font-medium text-red-600">Rp {{ number_format($gamingProducts->Harga_Diskon) }}</p>
                    </div>
                    <form action="{{ route('cart.add', $gamingProducts->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-5 py-2.5 bg-blue-600 hover:bg-blue-700 hover:scale-105 font-bold text-white rounded-lg">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
            
            @endif
            @empty
            <p class="text-gray-500">No gaming products available.</p>
            @endforelse
        </div>
    </div>

    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-15 lg:max-w-7xl lg:px-8 pointer-event-none">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 pointer-events-none" id="other">Other</h2>
            <h2 class="text-blue-600 font-semibold hover:text-yellow-800">
                <a href="{{ route('other') }}">See more...</a>
            </h2>
        </div>
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
                    <!-- Discount Tag -->
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
                        <!-- Price with Discount -->
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
            <p class="text-gray-500">No Other products available.</p>
            @endforelse
        </div>
    </div>
    <script>
    fetch(`/cart/add/${productId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({}) // Send additional data if necessary
    });
    </script>

</body>