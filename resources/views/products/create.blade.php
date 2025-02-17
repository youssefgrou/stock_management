@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-base font-semibold leading-6 text-gray-900">Add New Product</h1>
    <p class="mt-2 text-sm text-gray-700">Create a new product in your inventory</p>
</div>

<form action="{{ route('products.store') }}" method="POST" class="mt-8 space-y-6" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
            <div class="mt-2">
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-3">
            <label for="sku" class="block text-sm font-medium leading-6 text-gray-900">SKU</label>
            <div class="mt-2">
                <input type="text" name="sku" id="sku" value="{{ old('sku') }}" required
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            @error('sku')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-3">
            <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
            <div class="mt-2">
                <select name="category_id" id="category_id" required
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-3">
            <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price</label>
            <div class="mt-2">
                <div class="relative rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" required
                        class="block w-full rounded-md border-0 py-1.5 pl-7 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            @error('price')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-3">
            <label for="quantity" class="block text-sm font-medium leading-6 text-gray-900">Quantity</label>
            <div class="mt-2">
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 0) }}" min="0" required
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            @error('quantity')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-3">
            <label for="minimum_quantity" class="block text-sm font-medium leading-6 text-gray-900">Minimum Quantity</label>
            <div class="mt-2">
                <input type="number" name="minimum_quantity" id="minimum_quantity" value="{{ old('minimum_quantity', 0) }}" min="0" required
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            @error('minimum_quantity')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-3">
            <label for="unit" class="block text-sm font-medium leading-6 text-gray-900">Unit</label>
            <div class="mt-2">
                <select name="unit" id="unit" required
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="piece" {{ old('unit') == 'piece' ? 'selected' : '' }}>Piece</option>
                    <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>Kilogram</option>
                    <option value="liter" {{ old('unit') == 'liter' ? 'selected' : '' }}>Liter</option>
                    <option value="box" {{ old('unit') == 'box' ? 'selected' : '' }}>Box</option>
                </select>
            </div>
            @error('unit')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-3">
            <label for="barcode" class="block text-sm font-medium leading-6 text-gray-900">Barcode</label>
            <div class="mt-2">
                <input type="text" name="barcode" id="barcode" value="{{ old('barcode') }}"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            @error('barcode')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-3">
            <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Product Image</label>
            <div class="mt-2">
                <input type="file" name="image" id="image" accept="image/*"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
            </div>
            @error('image')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-span-full">
            <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
            <div class="mt-2">
                <textarea name="description" id="description" rows="3"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('description') }}</textarea>
            </div>
            @error('description')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="{{ route('products.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
        <button type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Create Product
        </button>
    </div>
</form>
@endsection 