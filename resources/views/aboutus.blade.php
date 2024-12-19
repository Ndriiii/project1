<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="main.js"></script>
    <style>
        .grid > div {
          flex: 1;
          min-width: 200px; /* Ensures minimum consistent size */
          max-width: 250px; /* Optional maximum size for alignment */
          height: auto;     /* Adjusts height to maintain aspect ratio */
        }
    </style>
</head>
<body>
    <section class = "bg-white dark:bg-gray-900">
       <a href ="{{ route('main')}}" class ="absolute top-10 left-10  text-3xl text-white hover:text-blue-500 hover:underline flex"><img src="{{asset('img/arrowleftwhitenobg.png')}}" class="w-8 h-8 mt-1 mr-2">Return to main page</a>
        <div class="shrink-0 mr-10 absolute right-10 top-10">
            <img class="block w-auto h-8 dark:hidden" src="/img/Logo.png" alt=""> 
            <img class="hidden w-auto h-8 dark:block" src="/img/Logo.png" alt="">                   
            <span class = "text-md font-semibold text-gray-900 dark:text-white">Brainiacs </span>
        </div>
        </div>
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6">
            <div class="mx-auto mb-8 max-w-screen-sm lg:mb-16">
                <h2 class="mb-4 mt-7 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Our team</h2>
                <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Meet our team for this project!!</p>
            </div> 
            <div class="grid gap-8 lg:gap-16 sm:grid-cols-2 md:grid-cols-3 justify-items-center">
                <div class="text-center text-gray-500 dark:text-gray-400">
                    <div class = "relative mx-auto mb-4 rounded-full w-36 h-36 overflow-hidden">
                        <img src="/img/Andri.jpg" alt="Andri">
                    </div>
                    <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <a href="#">Andri Jlis</a>
                    </h3>
                    <p>2431180</p>
                </div>
                <div class="text-center text-gray-500 dark:text-gray-400">
                    <div class = "relative mx-auto mb-4 rounded-full w-36 h-36 overflow-hidden">
                        <img src="/img/Leon.jpg" alt="Bonnie Avatar">
                    </div>
                    <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <a href="#">Leon</a>
                    </h3>
                    <p>2431161</p>
                </div>
                <div class="text-center text-gray-500 dark:text-gray-400">
                    <div class = "relative mx-auto mb-4 rounded-full w-36 h-36 overflow-hidden">
                        <img src="/img/Pirman.jpg" alt="Bonnie Avatar">
                    </div>
                    <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <a href="#">Pirman</a>
                    </h3>
                    <p>2431215</p>
                </div>
            </div>
            <div class="grid gap-8 lg:gap-16 md:grid-cols-2 justify-items-end">
                <div class="text-center text-gray-500 dark:text-gray-400 mr-20">
                    <div class = "relative mx-auto mb-4 rounded-full w-36 h-36 overflow-hidden">
                        <img src="/img/Gilbert.jpg" alt="Bonnie Avatar">
                    </div>
                    <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <a href="#">Gilbert Timoti</a>
                    </h3>
                    <p>2431167</p>
                </div>
                <div class="text-center text-gray-500 dark:text-gray-400 justify-self-start ml-20">
                    <div class = "relative mx-auto mb-4 rounded-full w-36 h-36 overflow-hidden">
                        <img src="/img/Gina.jpg" alt="Bonnie Avatar">
                    </div>
                    <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <a href="">Gina Rodo Ester Limbong</a>
                    </h3>
                    <p>2431164</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>