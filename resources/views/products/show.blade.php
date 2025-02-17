@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
            <p class="mt-1 text-sm text-gray-500">Product Details</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('products.edit', $product) }}" 
               class="inline-flex items-center rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500
                      sm:px-4 sm:py-2 sm:border sm:border-gray-300 sm:text-gray-700 sm:bg-white sm:hover:bg-gray-50
                      px-2 py-2 bg-gray-100 text-gray-700 hover:bg-gray-200">
                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                <span class="hidden sm:inline ml-2">Edit</span>
            </a>
            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')"
                    class="inline-flex items-center rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500
                           sm:px-4 sm:py-2 sm:border sm:border-transparent sm:bg-red-600 sm:hover:bg-red-700 sm:text-white
                           px-2 py-2 bg-red-100 text-red-700 hover:bg-red-200">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="hidden sm:inline ml-2">Delete</span>
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Basic Information Card -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-500">SKU</span>
                        <span class="text-gray-900 font-medium">{{ $product->sku }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Category</span>
                        <span class="text-gray-900 font-medium">{{ $product->category->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Price</span>
                        <div class="text-right">
                            <span class="text-gray-900 font-medium">{{ \App\Helpers\CurrencyHelper::format($product->price) }}</span>
                            <span class="text-gray-500 text-sm">/{{ $product->unit }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Value</span>
                        <div class="text-right">
                            <span class="text-gray-900 font-medium">{{ \App\Helpers\CurrencyHelper::format($product->price * $product->quantity) }}</span>
                            <span class="text-gray-500 text-sm">({{ $product->quantity }} {{ $product->unit }}s)</span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Barcode</span>
                        <span class="text-gray-900 font-medium">{{ $product->barcode ?? 'N/A' }}</span>
                    </div>
                    <div class="pt-4 border-t border-gray-200">
                        <span class="text-gray-500 block mb-2">Product Image</span>
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-32 h-32 object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity"
                                 onclick="openImageModal(this.src)"
                                 title="Click to view larger image">
                        @else
                            <span class="text-gray-400">No image available</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <!-- Inventory Information Card -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Inventory Information</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Current Quantity</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $product->quantity <= $product->minimum_quantity ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                {{ $product->quantity }} {{ $product->unit }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Minimum Quantity</span>
                            <span class="text-gray-900 font-medium">{{ $product->minimum_quantity }} {{ $product->unit }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Unit</span>
                            <span class="text-gray-900 font-medium">{{ ucfirst($product->unit) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information Card -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h3>
                    <div class="space-y-4">
                        <div>
                            <span class="text-gray-500 block mb-2">Description</span>
                            <p class="text-gray-900">{{ $product->description ?? 'No description available' }}</p>
                        </div>
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-500">Created At</span>
                                <span class="text-gray-900">{{ $product->created_at->format('F j, Y, g:i a') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Last Updated</span>
                                <span class="text-gray-900">{{ $product->updated_at->format('F j, Y, g:i a') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('products.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
            &larr; Back to Products
        </a>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-75 flex items-center justify-center p-4">
        <div class="relative max-w-4xl w-full">
            <button onclick="closeImageModal()" class="absolute top-0 right-0 m-4 text-white hover:text-gray-300">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img id="modalImage" src="" alt="Large product image" class="max-w-full h-auto rounded-lg">
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openImageModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
        modal.classList.remove('hidden');
        
        // Prevent scrolling on the body when modal is open
        document.body.style.overflow = 'hidden';
        
        // Close modal when clicking outside the image
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeImageModal();
            }
        });
        
        // Add keyboard support for closing
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    }

    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
@endpush
@endsection 