<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="main.js"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="#" class="text-2xl font-bold text-gray-800">Welcome, Admin</a>
                <ul class="flex space-x-4">
                    <li><a href="{{route('logout')}}" class="text-gray-600 hover:text-blue-500">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    @if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg">
        <p class="font-semibold">{{ session('success') }}</p>
    </div>
@endif
@if ($errors->any())
<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
    <ul>
        @foreach ($errors->all() as $error)
            <li class="font-semibold">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif




    <div class="min-h-screen flex flex-col items-center p-6">
        <h1 class="text-2xl font-bold mb-6">Product Management</h1>

        <!-- Add Product Button -->
        <button 
            id="addProductBtn" 
            class="px-6 py-2 mb-4 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring focus:ring-green-300">
            Add Product
        </button>

        <!-- Product Table -->
        <div class="w-full max-w-6xl overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Nama Produk</th>
                        <th class="px-4 py-2 text-left">Harga</th>
                        <th class="px-4 py-2 text-left">Tipe</th>
                        <th class="px-4 py-2 text-left">Kategori</th>
                        <th class="px-4 py-2 text-left">Diskon</th>
                        <th class="px-4 py-2 text-left">Foto</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    <!-- Sample Product Rows -->
                    @foreach($product as $product)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{$product->id}}</td>
                        <td class="px-4 py-2">{{$product->Nama_Produk}}</td>
                        <td class="px-4 py-2">Rp {{number_format($product->Harga_Produk)}}</td>
                        <td class="px-4 py-2">{{$product->Tipe_Produk}}</td>
                        <td class="px-4 py-2">{{$product->Kategori_Produk}}</td>
                        <td class="px-4 py-2">{{$product->Diskon}}%</td>
                        <td class="px-4 py-2"><img src="{{ asset('storage/' . $product->Foto_Produk) }}" class="w-16 h-16 object-cover"></td>
                        <td class="px-4 py-2 flex justify-center">
                            <button class="px-2 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600" onclick="openModal('editProductModal{{$product->id}}')">Edit</button>
                            <form action="{{ route('admin.delete-product', $product->id) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-4 px-2 py-1 bg-red-600 text-white rounded-md hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                            
                        </td>
                    </tr>
                    <div id="editProductModal{{$product->id}}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                        <div class="bg-white rounded-lg shadow-lg w-1/3">
                            <div class="border-b px-4 py-2 flex justify-between items-center">
                                <h2 class="text-lg font-semibold">Edit Product</h2>
                                <button onclick="closeModal('editProductModal{{$product->id}}')" class="text-gray-500 hover:text-gray-800">&times;</button>
                            </div>
                            <div class="p-4">
                                <form action="{{ route('admin.update-product', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                    
                                    <div class="mb-4">
                                        <label for="Nama_Produk{{$product->id}}" class="block text-sm font-medium">Nama Produk</label>
                                        <input type="text" name="Nama_Produk" id="Nama_Produk{{$product->id}}" value="{{$product->Nama_Produk}}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                    </div>
                    
                                    <div class="mb-4">
                                        <label for="Harga_Produk{{$product->id}}" class="block text-sm font-medium">Harga Produk</label>
                                        <input type="text" name="Harga_Produk" id="Harga_Produk{{$product->id}}" value="{{$product->Harga_Produk}}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                    </div>
                    
                                    <div class="mb-4">
                                        <label for="Tipe_Produk{{$product->id}}" class="block text-sm font-medium">Tipe Produk</label>
                                        <input type="text" name="Tipe_Produk" id="Tipe_Produk{{$product->id}}" value="{{$product->Tipe_Produk}}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                                    </div>
                    
                                    <div class="mb-4">
                                        <label for="Kategori_Produk{{$product->id}}" class="block text-sm font-medium">Kategori Produk</label>
                                        <select name="Kategori_Produk" id="Kategori_Produk{{$product->id}}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                                            <option value="Clothing" {{ $product->Kategori_Produk == 'Clothing' ? 'selected' : '' }}>Clothing</option>
                                            <option value="Gaming" {{ $product->Kategori_Produk == 'Gaming' ? 'selected' : '' }}>Gaming</option>
                                            <option value="Others" {{ $product->Kategori_Produk == 'Others' ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                    
                                    <div class="mb-4">
                                        <label for="Foto_Produk{{$product->id}}" class="block text-sm font-medium">Product Image</label>
                                        <input type="file" name="Foto_Produk" id="Foto_Produk{{$product->id}}" class="mt-1 block w-full text-sm">
                                    </div>

                                    <div class="mb-4">
                                        <label for="Diskon{{$product->id}}" class="block text-sm font-medium">Diskon</label>
                                        <input type="text" name="Diskon" id="Diskon{{$product->id}}" value="{{$product->Diskon}}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                                    </div>
                    
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" onclick="closeModal('editProductModal{{$product->id}}')" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Cancel</button>
                                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div 
    id="addProductModal" 
    class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center z-50 flex">
    <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-md p-6 relative">
        <!-- Close Button -->
        <button 
            id="closeModalBtn" 
            class="absolute top-4 right-4 text-gray-600 hover:text-gray-900">
            ✖
        </button>
        <!-- Modal Content -->
        <h2 class="text-lg font-bold mb-4">Add New Product</h2>
        <form id="addProductForm" action="{{route('admin.add-product')}}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="Nama_Produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input 
                    type="text" 
                    id="Nama_Produk" 
                    name="Nama_Produk" 
                    class="block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                    required>
            </div>
            <div>
                <label for="Harga_Produk" class="block text-sm font-medium text-gray-700">Harga Produk</label>
                <input 
                    type="text" 
                    id="Harga_Produk" 
                    name="Harga_Produk" 
                    class="block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                    required>
            </div>
            <div>
                <label for="Tipe_Produk" class="block text-sm font-medium text-gray-700">Tipe Produk</label>
                <input 
                    type="text" 
                    id="Tipe_Produk" 
                    name="Tipe_Produk" 
                    class="block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                    required>
            </div>
            <div>
                <label for="Kategori_Produk" class="block text-sm font-medium text-gray-700">Kategori Produk</label>
                <select 
                    id="Kategori_Produk" 
                    name="Kategori_Produk" 
                    class="block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                    required>
                    <option value="" disabled selected>Select a category</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Gaming">Gaming</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            
            <div>
                <label for="Foto_Produk" class="block text-sm font-medium text-gray-700">Foto Produk</label>
                <input 
                    type="file" 
                    id="Foto_Produk" 
                    name="Foto_Produk" 
                    class="block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                    >
            </div>
            <div>
                <label for="Detail_Produk" class="block text-sm font-medium text-gray-700">Detail Produk</label>
                <textarea 
                id="Detail_Produk" 
                name="Detail_Produk" 
                rows="4" 
                class="block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                required></textarea>
            </div>
            <div>
                <label for="Diskon" class="block text-sm font-medium text-gray-700">Diskon</label>
                <input 
                    type="text" 
                    id="Diskon" 
                    name="Diskon" 
                    class="block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                    >
            </div>
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:ring focus:ring-blue-300">
                Save Product
            </button>
        </form>
    </div>
</div>


    <!-- Script to Toggle Modal -->
    <script>
        const addmodal = document.getElementById("addProductModal");
        const addProductBtn = document.getElementById("addProductBtn");
        const closeModalBtn = document.getElementById("closeModalBtn");

        addProductBtn.addEventListener("click", () => {
            addmodal.classList.remove("hidden");
        });

        closeModalBtn.addEventListener("click", () => {
            addmodal.classList.add("hidden");
        });

        addmodal.addEventListener("click", (event) => {
            if (event.target === addmodal) {
                addmodal.classList.add("hidden");
            }
        });

        function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function confirmDelete() {
        return confirm('Are you sure you want to delete this product? This action cannot be undone.');
    }
    </script>
</body>
</html>
