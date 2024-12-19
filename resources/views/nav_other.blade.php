<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="main.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Braniacs Store</title>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    @guest
    <nav class="bg-white dark:bg-gray-800 antialiased z-50 fixed top-0 left-0 w-full">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center ml-[-30px] space-x-2">
                    <div class="shrink-0">
                        <a href="{{ route('main') }}" title="" class="">
                            <img class="block w-auto h-8 dark:hidden" src="/img/Logo.png" alt=""> 
                            <img class="hidden w-auto h-8 dark:block" src="/img/Logo.png" alt="">                   
                            <span class = "text-md font-semibold text-gray-900 dark:text-white">Brainiacs </span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-8">
                    <ul class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
                        <li>
                            <a href="{{ route('main') }}" title="" class="flex text-xl font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500 hover:text-blue-500">
                                Home
                            </a>
                        </li>
                        <li class="shrink-0">
                            <a href="{{route('aboutus')}}" title="" class="flex text-xl font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500 hover:text-blue-500">
                            About Us
                            </a>
                        </li>
                        <li class="shrink-0">
                            <a href="#Limited-Offer" title="" class="flex text-xl font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500 hover:text-blue-500">
                                Offers
                            </a>
                        </li>
                        <li class="relative shrink-0">
                            <button id="categoryDropdownButton" data-dropdown-toggle="categoryDropdownMenu" type="button" class="flex text-xl font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500 hover:text-blue-500">
                                Category
                                <svg class="w-4 h-4 ms-1 mt-1 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                                </svg>
                            </button>
                            <!-- Dropdown Menu -->
                            <div id="categoryDropdownMenu" class="hidden z-10 absolute left-0 top-full mt-2 w-48 divide-y divide-gray-100 rounded-lg bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
                                <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                                    <li><a href="{{route('clothing')}}" title="" class="dropdown-link block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Clothing</a></li>
                                    <li><a href="{{route('gaming')}}" title="" class="dropdown-link block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Gaming</a></li>
                                    <li><a href="{{route('other')}}" title="" class="dropdown-link block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Others</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
    
                <div class="flex items-center lg:space-x-2 relative">
                <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white hover:text-blue-500">
                    <span class="sr-only">
                        Cart
                    </span>
                    <svg class="w-5 h-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                    </svg> 
                    <span class="hidden sm:flex">My Cart</span>
                    <svg class="hidden sm:flex w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                    </svg>             
                    <span id="cartCount">{{ count(session()->get('cart', [])) }}</span>
                </button>
            
                <!-- Cart Dropdown Menu -->
                <div id="myCartDropdown1" class="hidden z-10 mx-auto max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 shadow-lg dark:bg-gray-800 absolute left-0 top-full mt-2 w-full text-gray-50">
                    <!-- Check if cart is empty -->
                    @if(session('cart') && count(session('cart')) > 0)
                        <!-- Cart Items -->
                        <div id="cartItems" class="space-y-4">
                            @foreach(session('cart') as $item)
                                <div class="flex justify-between items-center space-x-2 py-2">
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-10 h-10 rounded-md">
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold">{{ $item['name'] }}</p>
                                        <p class="text-xs text-gray-500">Quantity: {{ $item['quantity'] }}</p>
                                        <p class="text-sm font-medium text-gray-800">${{ number_format($item['price'], 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="border-t border-gray-200 dark:border-gray-700">
                                <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">View Cart</a>
                                <a href="" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Proceed to Checkout</a>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-300">Your cart is empty right now.</p>
                    @endif
                </div>
                
                    <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white hover:text-blue-500 ">
                        <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>              
                        Account
                        <svg class="w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                        </svg> 
                    </button>
                    
                
                    <!-- User Dropdown Menu -->
                    <div id="userDropdown1" class="hidden z-10 divide-y divide-gray-100 rounded-lg bg-white shadow dark:divide-gray-600 dark:bg-gray-700 absolute left-0 top-full mt-2 w-full">
                        <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                            <li>
                                <button type="button" id="registerButton" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Register
                                </button>
                            </li>
                            <li>
                                <button type="button" id="loginButton" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Log in
                                </button>
                            </li>                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    

    <div id="login-popup" tabindex="-1" class="bg-black/50 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 h-full items-center justify-center hidden">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center popup-close">
                    <svg aria-hidden="true" class="w-5 h-5" fill="#c6c7c7" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close popup</span>
                </button>
   
                <div class="p-5">
                    <h3 class="text-2xl mb-0.5 font-medium"></h3>
                    <p class="mb-4 text-sm font-normal text-gray-800"></p>
   
                    <div class="text-center">
                        <p class="mb-3 text-2xl font-semibold leading-5 text-slate-900">Login to your account</p>
                        <p class="mt-2 text-sm leading-4 text-slate-600">You must be logged in to perform this action.</p>
                    </div>
   
                    <form class="w-full my-5" action="{{ route('login') }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="login">
                        <label for="email" class="sr-only">Email address</label>
                        <input name="email" type="email" autocomplete="email" required class="block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm outline-none placeholder:text-gray-400 focus:ring-2 focus:ring-black focus:ring-offset-1" placeholder="Email Address" value="{{ old('email') }}"/>
                        
                        <label for="password" class="sr-only">Password</label>
                        <input name="password" type="password" required class="mt-2 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm outline-none placeholder:text-gray-400 focus:ring-2 focus:ring-black focus:ring-offset-1" placeholder="Password" value=""/>
                        
                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-lg bg-black my-5 p-2 py-3 text-sm font-medium text-white outline-none focus:ring-2 focus:ring-black focus:ring-offset-1 disabled:bg-white dark:bg-gray-800">
                            Log in
                        </button>
                    </form>

                    @if(session('error'))
                    <div class="text-red-500 text-sm mt-2">
                        {{ session('error') }}
                    </div>
                    @endif
   
                    <div class="mt-6 text-center text-sm text-slate-600">
                        Don't have an account?
                        <button type="button" id="RegisterButtonInside" class="font-medium text-[#4285f4]">
                            Sign up
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
   


    <div id="register-popup" tabindex="-1"
    class="bg-black/50 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 h-full items-center justify-center hidden">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center popup-close">
                    <svg aria-hidden="true" class="w-5 h-5" fill="#c6c7c7" viewBox="0 0 20 20"xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" cliprule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close popup</span>
                </button>

                <div class="p-5">
                    <h3 class="text-2xl mb-0.5 font-medium"></h3>
                    <p class="mb-4 text-sm font-normal text-gray-800"></p>

                    <div class="text-center">
                        <p class="mb-3 text-2xl font-semibold leading-5 text-slate-900"> Registering an account</p>
                        <p class="mt-2 text-sm leading-4 text-slate-600"> You must be registered before logging in. </p>
                    </div>
                    <form class="w-full my-5" method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="action" value="register">
                        <label for="username" class="sr-only">Username</label>
                            <input name="username" type="text" autocomplete="username" required="" class="block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm outline-none placeholder:text-gray-400 focus:ring-2 focus:ring-black focus:ring-offset-1" placeholder="Username" value=""/>
                        <label for="email" class="sr-only">Email address</label>
                            <input name="email" type="email" autocomplete="email" required="" class="mt-2 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm outline-none placeholder:text-gray-400 focus:ring-2 focus:ring-black focus:ring-offset-1" placeholder="Email Address" value=""/>
                        <label for="password" class="sr-only">Password</label>
                            <input name="password" type="Password" autocomplete="current-password" required="" class="mt-2 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm outline-none placeholder:text-gray-400 focus:ring-2 focus:ring-black focus:ring-offset-1" placeholder="Password" value=""/>
                        <label for="password" class="sr-only">Confirm password</label>
                            <input name="password_confirmation" type="password" autocomplete="current-password" required="" class="mt-2 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm outline-none placeholder:text-gray-400 focus:ring-2 focus:ring-black focus:ring-offset-1" placeholder="Confirm Password" value=""/>
                        <label for="phone" class="sr-only">Phone number</label>
                            <input name="phone" type="text" required class="mt-2 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm outline-none placeholder:text-gray-400 focus:ring-2 focus:ring-black focus:ring-offset-1" placeholder="Phone Number" value=""/>
                        
                        <button type="submit"
                            class="inline-flex w-full items-center justify-center rounded-lg bg-black my-5 p-2 py-3 text-sm font-medium text-white outline-none focus:ring-2 focus:ring-black focus:ring-offset-1 disabled:bg-white dark:bg-gray-800">
                            Register
                        </button>
                    </form>

                    <div class="mt-6 text-center text-sm text-slate-600">
                        Already got an account?
                        <button type="button" id="loginButtonInside" class="font-medium text-[#4285f4]">
                            Log in
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endguest
    @auth
    <nav class="bg-white dark:bg-gray-800 antialiased z-50 fixed top-0 left-0 w-full">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center ml-[-30px] space-x-2">
                    <div class="shrink-0">
                        <a href="{{ route('main') }}" title="" class="">
                            <img class="block w-auto h-8 dark:hidden" src="/img/Logo.png" alt=""> 
                            <img class="hidden w-auto h-8 dark:block" src="/img/Logo.png" alt="">                   
                            <span class = "text-md font-semibold text-gray-900 dark:text-white">Brainiacs </span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-8">
                    <ul class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
                        <li>
                            <a href="{{ route('main') }}" title="" class="flex text-xl font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500 hover:text-blue-500">
                                Home
                            </a>
                        </li>
                        <li class="shrink-0">
                            <a href="{{route('aboutus')}}" title="" class="flex text-xl font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500 hover:text-blue-500">
                            About Us
                            </a>
                        </li>
                        <li class="shrink-0">
                            <a href="{{route('offers')}}" title="" class="flex text-xl font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500 hover:text-blue-500">
                                Offers
                            </a>
                        </li>
                        <li class="relative shrink-0">
                            <button id="categoryDropdownButton" data-dropdown-toggle="categoryDropdownMenu" type="button" class="flex text-xl font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500 hover:text-blue-500">
                                Category
                                <svg class="w-4 h-4 ms-1 mt-1 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                                </svg>
                            </button>
                            <!-- Dropdown Menu -->
                            <div id="categoryDropdownMenu" class="hidden z-10 absolute left-0 top-full mt-2 w-48 divide-y divide-gray-100 rounded-lg bg-white shadow dark:divide-gray-600 dark:bg-gray-700">
                                <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                                    <li><a href="{{route('clothing')}}" title="" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Clothing</a></li>
                                    <li><a href="{{route('gaming')}}" title="" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Gaming</a></li>
                                    <li><a href="{{route('other')}}" title="" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Others</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div class="flex items-center lg:space-x-2 relative">
                    <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white hover:text-blue-500">
                        <span class="sr-only">
                            Cart
                        </span>
                        <svg class="w-5 h-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                        </svg> 
                        <span class="hidden sm:flex">My Cart</span>
                        <svg class="hidden sm:flex w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                        </svg>             
                        <span id="cartCount">{{ count(session()->get('cart', [])) }}</span>
                    </button>
                
                    <!-- Cart Dropdown Menu -->
                    <div id="myCartDropdown1" class="hidden z-10 mx-auto max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 shadow-lg dark:bg-gray-800 absolute left-0 top-full mt-2 w-full text-gray-50">
                        <!-- Check if cart is empty -->
                        @if(session('cart') && count(session('cart')) > 0)
                            <!-- Cart Items -->
                            <div id="cartItems" class="space-y-4">
                                @foreach(session('cart') as $item)
                                <div class="flex justify-between items-center space-x-2 py-2">
                                    <img src="{{ asset('storage/' . $item['image']) }}" class="w-10 h-10 rounded-md">
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold">{{ $item['name'] }}</p>
                                        <p class="text-xs text-gray-500">Quantity: {{ $item['quantity'] }}</p>
                                        <p class="text-sm font-medium text-gray-800">${{ number_format($item['price'], 2) }}</p>
                                    </div>
                                </div>
                                @endforeach

                                <div class="border-t border-gray-200 dark:border-gray-700">
                                    <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">View Cart</a>
                                    <a href="" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Proceed to Checkout</a>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-300">Your cart is empty right now.</p>
                        @endif
                    </div>
                
                    <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white hover:text-blue-500">
                        <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>              
                        Account
                        <svg class="w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                        </svg> 
                        
                    </button>
                    
                
                    <!-- User Dropdown Menu -->
                    <div id="userDropdown1" class="hidden z-10 divide-y divide-gray-100 rounded-lg bg-white shadow dark:divide-gray-600 dark:bg-gray-700 absolute left-0 top-full mt-2 w-full">
                        <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                            <li><a href="{{ route('profile') }}" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> My Account </a></li>
                            <li><a href="{{route('logout')}}" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> Log out </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @endauth
<script>
    //category dropdown

    // Get the dropdown button and the dropdown menu
    const categoryDropdownButton = document.getElementById('categoryDropdownButton');
    const categoryDropdownMenu = document.getElementById('categoryDropdownMenu');

    // Toggle the dropdown when the button is clicked
    categoryDropdownButton.addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent the click event from propagating to the window (prevents closing immediately)
        // Toggle the 'hidden' class to show or hide the dropdown menu
        categoryDropdownMenu.classList.toggle('hidden');
    });

    // Close the dropdown when clicking outside of it
    window.addEventListener('click', function(event) {
        if (!categoryDropdownButton.contains(event.target) && !categoryDropdownMenu.contains(event.target)) {
            // Close the dropdown if the click is outside the button or dropdown menu
            categoryDropdownMenu.classList.add('hidden');
        }
    });

        document.querySelectorAll('dropdown-link').forEach(link=> {
            link.addEventListener('click', function() {
            const dropdown = document.getElementById('categoryDropdownMenu');
            if(dropdown) {
                dropdown.classList.add('hidden');
            }
        })
    })

    //category dropdown end
    //user dropdown
    document.addEventListener('DOMContentLoaded', function () {
    const userDropdownButton = document.getElementById('userDropdownButton1');
    const userDropdownMenu = document.getElementById('userDropdown1');

    if (userDropdownButton && userDropdownMenu) {
        userDropdownButton.addEventListener('click', function () {
            console.log('Button clicked'); // Debugging message
            userDropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (event) {
            if (!userDropdownMenu.contains(event.target) && !userDropdownButton.contains(event.target)) {
                userDropdownMenu.classList.add('hidden');
            }
        });
    } else {
        console.error('Dropdown button or menu not found!');
    }
});
//userdropdown end

//cartdropdown start

// Get the dropdown button and the dropdown menu
const dropdownButton = document.getElementById('myCartDropdownButton1');
    const dropdownMenu = document.getElementById('myCartDropdown1');

    // Toggle the dropdown when the button is clicked
    dropdownButton.addEventListener('click', function() {
        // Toggle the 'hidden' class to show or hide the dropdown menu
        dropdownMenu.classList.toggle('hidden');
    });

    // Close the dropdown when clicking outside of it
    window.addEventListener('click', function(event) {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            // Close the dropdown if the click is outside the button or dropdown menu
            dropdownMenu.classList.add('hidden');
        }
    });
//cartdropdown end

//login register

 // Get the modals
 const loginPopup = document.getElementById("login-popup");
  const registerPopup = document.getElementById("register-popup");

  // Get the buttons for Register and Login
  const registerButton = document.getElementById("registerButton");
  const loginButton = document.getElementById("loginButton");
  const loginButtonInside = document.getElementById("loginButtonInside");
  const RegisterButtonInside = document.getElementById("RegisterButtonInside");
  // Get the close buttons inside the modals
  const closeButtons = document.querySelectorAll(".popup-close");

  // Function to open a modal
  function openModal(modal) {
    modal.classList.remove("hidden");
    modal.classList.add("flex");
  }

  @if(session('error'))
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById('login-popup');
            openModal(modal);
        });
    @endif
  // Function to close a modal
  function closeModal(modal) {
    modal.classList.remove("flex");
    modal.classList.add("hidden");
  }

  // Open login modal and close register modal
  loginButton.addEventListener("click", () => {
    closeModal(registerPopup); // Close register modal if open
    openModal(loginPopup);     // Open login modal
  });

  loginButtonInside.addEventListener("click", () => {
    closeModal(registerPopup); // Close register modal if open
    openModal(loginPopup);     // Open login modal
  });

  // Open register modal and close login modal
  registerButton.addEventListener("click", () => {
    closeModal(loginPopup);   // Close login modal if open
    openModal(registerPopup); // Open register modal
  });

  RegisterButtonInside.addEventListener("click", () => {
    closeModal(loginPopup);   // Close login modal if open
    openModal(registerPopup); // Open register modal
  });


  // Close modals when the close button is clicked
  closeButtons.forEach(button => {
    button.addEventListener("click", () => {
      closeModal(loginPopup);
      closeModal(registerPopup);
    });
  });

  // Close modals when clicking outside of the modal
  window.addEventListener("click", (e) => {
    if (e.target === loginPopup) {
      closeModal(loginPopup);
    }
    if (e.target === registerPopup) {
      closeModal(registerPopup);
    }
  });

  
//login register end 

//cart
function updateCart(id, quantity) {
    fetch('/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ id, quantity }),
    })
    .then(response => response.json())
    .then(data => {
        alert(data.success);
        console.log(data.cart);
        location.reload(); // Reload to see updates
    })
    .catch(error => console.error('Error:', error));
}

function removeFromCart(id) {
    fetch('/cart/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ id }),
    })
    .then(response => response.json())
    .then(data => {
        alert(data.success);
        console.log(data.cart);
        location.reload(); // Reload to see updates
    })
    .catch(error => console.error('Error:', error));
}


//cart end

</script>
    
</body>
</html>