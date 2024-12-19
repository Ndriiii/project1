<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function display()
{
    $product = Product::all();
    $clothingProducts = Product::where('Kategori_Produk', 'Clothing')->get();
    $gamingProducts = Product::where('Kategori_Produk', 'Gaming')->get();
    $otherProducts = Product::whereNotIn('Kategori_Produk', ['Clothing', 'Gaming'])->get();

    return view('/admin/admin', compact('clothingProducts', 'gamingProducts', 'otherProducts', 'product'));
}


    public function store(Request $request)
    {
    // Validate the incoming data
        $request->validate([
            'Nama_Produk' => 'required|string|max:255',
            'Harga_Produk' => 'required|numeric',
            'Tipe_Produk' => 'required|string|max:255',
            'Kategori_Produk' => 'required|string|max:255',
            'Foto_Produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Make Foto_Produk optional
            'Detail_Produk' => 'required|string',  // Ensure Detail_Produk is required and validated as a string
            'Diskon' => 'numeric|between:0,100',
        ]);

        // Initialize the $data array
        $data = [
            'Nama_Produk' => $request->Nama_Produk,
            'Harga_Produk' => $request->Harga_Produk,
            'Tipe_Produk' => $request->Tipe_Produk,
            'Kategori_Produk' => $request->Kategori_Produk,
            'Detail_Produk' => $request->Detail_Produk,
            'Diskon' => $request->Diskon,
            'Harga_Diskon'=> $request->Harga_Produk * (1 - ($request->Diskon/100)),
        ];

        // Handle the file upload if a file is provided
        if ($request->hasFile('Foto_Produk')) {
            $photoPath = $request->file('Foto_Produk')->store('products', 'public');
            $data['Foto_Produk'] = $photoPath;
        }

        // Create the product record
        $product = Product::create($data);

        if (!$product) {
            return redirect()->back()->with('errors', 'Product failed to add');
        }

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'Nama_Produk' => 'required|string|max:255',
            'Harga_Produk' => 'required|numeric',
            'Tipe_Produk' => 'nullable|string|max:255',
            'Kategori_Produk' => 'nullable|string|max:255',
            'Foto_Produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Diskon'=> 'numeric|between:0,100',
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update product fields
        $product->Nama_Produk = $request->Nama_Produk;
        $product->Harga_Produk = $request->Harga_Produk;
        $product->Tipe_Produk = $request->Tipe_Produk;
        $product->Kategori_Produk = $request->Kategori_Produk;
        $product->Diskon = $request->Diskon;
        $product->Harga_Diskon = $request->Harga_Produk * (1 - ($request->Diskon/100));

        // Handle file upload if a new image is provided
        if ($request->hasFile('Foto_Produk')) {
            $file = $request->file('Foto_Produk');
            $filePath = $file->store('products', 'public'); // This will store the image in 'storage/app/public/products'
            $product->Foto_Produk = $filePath;
        }

        // Save the updated product
        $product->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Optional: Delete the product's image from storage
        if ($product->Foto_Produk) {
            Storage::delete($product->Foto_Produk);
        }

        // Delete the product
        $product->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

}
