<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));   
    }

    public function add(Request $request, $id)
{
    // Assuming you have a Product model
    $product = Product::findOrFail($id);

    // Get the current cart from the session
    $cart = session()->get('cart', []);

    // If the product is already in the cart, increase the quantity
    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        // Add new product to the cart
        $cart[$id] = [
            'id' => $product->id,
            'name' => $product->Nama_Produk,
            'price' => $product->Harga_Produk,
            'image' => $product->Foto_Produk,
            'type' => $product->Tipe_Produk,
            'diskon'=> $product->Diskon,
            'quantity' => 1
        ];
    }

    // Save cart back to the session
    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Product added to cart!');
}


public function updateCart(Request $request)
{
    $cart = session()->get('cart', []);
    $itemId = $request->id;
    $quantity = $request->quantity;

    // Check if quantity is valid
    if ($quantity < 1) {
        return response()->json(['error' => 'Invalid quantity'], 400);
    }

    if (isset($cart[$itemId])) {
        // Update the quantity in the cart
        $cart[$itemId]['quantity'] = $quantity;
        session()->put('cart', $cart);

        // Recalculate item price with discount if applicable
        $itemPrice = $cart[$itemId]['price'];
        $itemDiscount = $cart[$itemId]['diskon'] ?? 0;
        $updatedSubtotal = ($itemPrice - ($itemPrice * $itemDiscount / 100)) * $quantity;

        // Recalculate total price for the cart
        $updatedTotal = 0;
        foreach ($cart as $item) {
            $itemPrice = $item['price'];
            $itemDiscount = $item['diskon'] ?? 0;
            $updatedTotal += ($itemPrice - ($itemPrice * $itemDiscount / 100)) * $item['quantity'];
        }

        return response()->json([
            'updatedPrice' => number_format($updatedSubtotal),
            'updatedTotal' => number_format($updatedTotal),
        ]);
    }

    return response()->json(['error' => 'Item not found'], 404);
}

public function clear(Request $request)
{
    session()->forget('cart'); // Assuming the cart is stored in the session
    return response()->json(['message' => 'Cart cleared successfully']);
}


    public function removeFromCart($id)
    {
        // Retrieve the cart from session
        $cart = session()->get('cart', []);

        // Check if the item exists in the cart
        if (!isset($cart[$id])) {
            return redirect()->route('cart.index')->with('error', 'Item not found');
        }

        // Remove the item from the cart
        unset($cart[$id]);

        // Re-index the array after removal
        $cart = array_values($cart);

        // Save the updated cart back to the session
        session()->put('cart', $cart);

        // Return back to the cart page with a success message
        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }
}
