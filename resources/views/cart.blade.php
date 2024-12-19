<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Cart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <Style>
    /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav>
        @include('nav_other')
    </nav>
    
    <section class="bg-white py-8 antialiased md:py-16 min-h-screen border-4 dark:border-gray-700 rounded-lg mt-28 mx-5 ">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold dark:text-gray-800 sm:text-4xl">Your Cart</h2>
            @if(count($cart) > 0)
                <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                    <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                        <div class="space-y-6">
                            @foreach ($cart as $item)
                                @if (isset($item['id']))
                                    <div class="rounded-lg border-4 border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                        <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                            <!-- Product Image -->
                                            <img class="h-20 w-20" src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" />
                                                
                                            <!-- Quantity Controls -->
                                            <div class="flex items-center justify-between md:order-3 md:justify-end">
                                                <div class="flex items-center">
                                                    <input id="quantity-{{ $item['id'] }}" type="text" class="w-10 text-center text-sm" value="{{ $item['quantity'] }}" readonly />
                                                    
                                                </div>
                                                <div class="text-end">
                                                    @if (isset($item['diskon']) && $item['diskon'] > 0)  <!-- Check if there's a discount -->
                                                        <!-- Discounted Price -->
                                                        <p class="text-base font-bold text-gray-900 dark:text-white ml-10">
                                                            Rp {{ number_format(($item['price'] - ($item['price'] * $item['diskon'] / 100)) * $item['quantity']) }}
                                                        </p>
                                                        <!-- Original Price (with strikethrough) -->
                                                        <p class="text-sm font-medium text-gray-500 line-through">Rp {{ number_format($item['price'] * $item['quantity']) }}</p>
                                                    @else
                                                        <!-- No Discount Price -->
                                                        <p class="text-base font-bold text-gray-900 dark:text-white ml-10">Rp {{ number_format($item['price'] * $item['quantity']) }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <!-- Product Info -->
                                            <div class="w-full min-w-0 flex-1 space-y-4">
                                                <p class="text-base font-medium text-white">{{ $item['name'] }}</p>
                                            </div>
                                            
                                            <!-- Delete Button -->
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE') <!-- Spoofing the DELETE method -->
                                                <button type="submit" onclick="return confirm('Are you sure you want to remove this item?')" class="text-red-300 border p-2 rounded bg-red-600 mr-4">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <p>Invalid item in cart (missing id).</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full py-10">
                        <div class="space-y-4 rounded-lg border-4 border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>
                            
                            @php
                                $total = 0;
                                foreach($cart as $item) {
                                    if (isset($item['diskon']) && $item['diskon'] > 0) {
                                        $total += ($item['price'] - ($item['price'] * $item['diskon'] / 100)) * $item['quantity'];
                                    } else {
                                        $total += $item['price'] * $item['quantity'];
                                    }
                                }
                            @endphp
    
                            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white">Rp {{ number_format($total) }}</dd>
                            </dl>
                            
                            <button id = "confirmPurchaseButton" type="button" class="w-full px-5 py-2.5 bg-blue-600 hover:bg-blue-700 font-bold text-white rounded-lg">Confirm Purchase</button>
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                                <a href="{{route('main')}}" class="text-sm font-medium text-blue-500">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-center text-gray-500">Your cart is empty.</p>
            @endif
        </div>
    </section>

    <!-- Purchase Confirmation Modal -->
    <div id="purchaseModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <div id="modalMessage">
                <p>Your purchase has been completed successfully!</p>
            </div>
        </div>
    </div>

    <!-- Login Prompt Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeLoginModal">&times;</span>
            <div id="modalMessage">
                <p class = "my-5">Please log in to complete your purchase.</p>
            </div>
        </div>
    </div>
    

    

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Increase quantity
        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.addEventListener('click', function () {
                const itemId = this.getAttribute('data-id');
                updateQuantity(itemId, 'increase');
            });
        });

        // Decrease quantity
        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.addEventListener('click', function () {
                const itemId = this.getAttribute('data-id');
                updateQuantity(itemId, 'decrease');
            });
        });
    });

    // Function to update quantity
    function updateQuantity(itemId, action) {
        const quantityInput = document.getElementById('quantity-' + itemId);
        let quantity = parseInt(quantityInput.value);

        // Increase or decrease the quantity
        if (action === 'increase') {
            quantity++;
        } else if (action === 'decrease' && quantity > 1) {
            quantity--;
        }

        // Update the quantity in the cart (send a request to your backend)
        axios.post('/cart/update', {
            id: itemId,
            quantity: quantity,
            _token: '{{ csrf_token() }}' // Ensure CSRF token is included
        })
        .then(response => {
            // Update the quantity in the input field
            quantityInput.value = quantity;

            // Update the price displayed for the item
            const priceElement = document.querySelector(`.price[data-id="${itemId}"]`);
            if (priceElement) {
                priceElement.textContent = `Rp ${response.data.updatedPrice}`;
            }

            // Update the total price
            const totalElement = document.getElementById('cart-total');
            if (totalElement) {
                totalElement.textContent = `Rp ${response.data.updatedTotal}`;
            }
        })
        .catch(error => {
            console.error('Error updating quantity:', error);
        });
    }


    document.getElementById('confirmPurchaseButton').addEventListener('click', function () {
        // Check if the user is logged in
        const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
        
        if (isLoggedIn) {
            // Send request to clear the cart
            axios.post('/cart/clear', {
                _token: '{{ csrf_token() }}'
            })
            .then(response => {
                // Show purchase completed modal
                document.getElementById('purchaseModal').style.display = 'block';

                // Remove all items from the main cart UI
                const cartContainer = document.querySelector('.space-y-6');
                if (cartContainer) {
                    cartContainer.innerHTML = '<p class="text-center text-gray-500">Your cart is empty.</p>';
                }

                // Remove Order Summary
                const orderSummaryContainer = document.querySelector('.mx-auto.mt-6.max-w-4xl.flex-1.space-y-6');
                if (orderSummaryContainer) {
                    orderSummaryContainer.style.display = 'none'; // Hide the container
                }

                // Clear items from the dropdown menu
                const cartDropdownItems = document.getElementById('cartItems');
                if (cartDropdownItems) {
                    cartDropdownItems.innerHTML = '<p class="text-gray-500 dark:text-gray-300">Your cart is empty right now.</p>';
                }

                // Update cart count in the dropdown
                const cartCount = document.getElementById('cartCount');
                if (cartCount) {
                    cartCount.textContent = '0';
                }
            })
            .catch(error => {
                console.error('Error clearing cart:', error);
            });
        } else {
            // Show login prompt modal
            document.getElementById('loginModal').style.display = 'block';
        }
    });

    // Close modals when clicking on the close button
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('purchaseModal').style.display = 'none';
    });

    document.getElementById('closeLoginModal').addEventListener('click', function() {
        document.getElementById('loginModal').style.display = 'none';
    });

    // Close modals when clicking outside of them
    window.onclick = function(event) {
        if (event.target == document.getElementById('purchaseModal')) {
            document.getElementById('purchaseModal').style.display = 'none';
        }
        if (event.target == document.getElementById('loginModal')) {
            document.getElementById('loginModal').style.display = 'none';
        }
    };


</script>

</body>
</html>
