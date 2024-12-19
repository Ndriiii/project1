<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="main.js"></script>
</head>
<body>
    <nav class="bg-white dark:bg-gray-800 antialiased relative z-50">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 py-4 flex justify-between item-center">
        <a href="{{route('main')}}" title="Go Back" class="flex ml-[-30px] text-xl font-medium dark:text-gray-50 hover:text-blue-700 hover:underline transition-transform origin-scale mt-[10px]"><img src="{{asset('img/arrowleftwhitenobg.png')}}" class="w-8 h-8 mr-1"> Back </a>
        <div class="shrink-0">
            <a href="{{ route('aboutus') }}" title="" class="">
                <img class="block w-auto h-8 dark:hidden" src="/img/Logo.png" alt=""> 
                <img class="hidden w-auto h-8 dark:block" src="/img/Logo.png" alt="">                   
                <span class = "text-md font-semibold text-gray-900 dark:text-white">Brainiacs </span>
            </a>
        </div>
        </div>
    </nav>

    <div class="max-w-lg mx-auto mt-6">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
    
        <!-- Error Message -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    

    <div class="max-w-lg mx-auto mt-10 bg-gray-100 p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-center mb-6">Your Profile</h1>
        <form action="{{route('profile.update')}}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
    
            <!-- Name Field (Read-only) -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-200 focus:outline-none focus:ring-0" value="{{ auth()->user()->name }}" readonly/>
            </div>
    
            <!-- Email Field -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ auth()->user()->email }}" required/>
            </div>
    
            <!-- Phone Field -->
            <div class="space-y-2">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" id="phone" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ auth()->user()->phone }}" required/>
            </div>
    
            <!-- Address Field -->
            <div class="space-y-2">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" id="address" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ auth()->user()->address}}" required/>
            </div>
    
            <!-- Password Fields -->
            <div class="space-y-2">
                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter current password" required/>
            </div>
    
            <div class="space-y-2">
                <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" name="new_password" id="new_password" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter new password" required/>
            </div>
    
            <div class="space-y-2">
                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Confirm new password" required/>
            </div>
    
            <button type="submit" class="w-full py-3 text-white bg-blue-600 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-transform duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-500">
                Update Profile
            </button>
        </form>
    </div>
    
        

             
    
</body>
</html>