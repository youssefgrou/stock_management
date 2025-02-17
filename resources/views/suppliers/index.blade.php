@extends('layouts.app')

@section('content')
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Suppliers</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all suppliers in your stock management system.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <button type="button" onclick="openSupplierModal()" 
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Add Supplier
            </button>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="rounded-md bg-green-50 p-4 mt-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Phone</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Address</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($suppliers as $supplier)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ $supplier->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $supplier->email }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $supplier->phone }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $supplier->address }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <button type="button" onclick="openEditSupplierModal({{ $supplier->id }}, '{{ $supplier->name }}', '{{ $supplier->email }}', '{{ $supplier->phone }}', '{{ $supplier->address }}')" 
                                            class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</button>
                                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this supplier?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 py-4 text-sm text-gray-500 text-center">No suppliers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Supplier Modal -->
    <div id="supplierModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" id="supplierModalBackdrop"></div>
        
        <div class="min-h-full flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all w-full sm:my-8 sm:max-w-lg sm:p-6 mx-4 sm:mx-auto">
                <!-- Close button - visible on all screens -->
                <div class="absolute right-0 top-0 pr-4 pt-4 block">
                    <button type="button" onclick="closeSupplierModal()" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Add New Supplier</h3>
                        
                        <form action="{{ route('suppliers.store') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="hidden sm:block text-sm font-medium leading-6 text-gray-900">Name</label>
                                    <div class="mt-2">
                                        <input type="text" name="name" id="name" required placeholder="Supplier Name"
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div>
                                    <label for="email" class="hidden sm:block text-sm font-medium leading-6 text-gray-900">Email</label>
                                    <div class="mt-2">
                                        <input type="email" name="email" id="email" required placeholder="Email Address"
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div>
                                    <label for="phone" class="hidden sm:block text-sm font-medium leading-6 text-gray-900">Phone</label>
                                    <div class="mt-2">
                                        <input type="tel" name="phone" id="phone" required placeholder="Phone Number"
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div>
                                    <label for="address" class="hidden sm:block text-sm font-medium leading-6 text-gray-900">Address</label>
                                    <div class="mt-2">
                                        <textarea name="address" id="address" rows="3" required placeholder="Full Address"
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 sm:mt-4 flex flex-col-reverse sm:flex-row-reverse gap-2">
                                <button type="submit"
                                    class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">
                                    Create Supplier
                                </button>
                                <button type="button" onclick="closeSupplierModal()"
                                    class="mt-0 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Supplier Modal -->
    <div id="editSupplierModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" id="editSupplierModalBackdrop"></div>
        
        <div class="min-h-full flex items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all w-full sm:my-8 sm:max-w-lg sm:p-6 mx-4 sm:mx-auto">
                <!-- Close button - visible on all screens -->
                <div class="absolute right-0 top-0 pr-4 pt-4 block">
                    <button type="button" onclick="closeEditSupplierModal()" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Edit Supplier</h3>
                        
                        <form id="editSupplierForm" method="POST" class="mt-4">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">
                                <div>
                                    <label for="edit_name" class="hidden sm:block text-sm font-medium leading-6 text-gray-900">Name</label>
                                    <div class="mt-2">
                                        <input type="text" name="name" id="edit_name" required placeholder="Supplier Name"
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div>
                                    <label for="edit_email" class="hidden sm:block text-sm font-medium leading-6 text-gray-900">Email</label>
                                    <div class="mt-2">
                                        <input type="email" name="email" id="edit_email" required placeholder="Email Address"
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div>
                                    <label for="edit_phone" class="hidden sm:block text-sm font-medium leading-6 text-gray-900">Phone</label>
                                    <div class="mt-2">
                                        <input type="tel" name="phone" id="edit_phone" required placeholder="Phone Number"
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div>
                                    <label for="edit_address" class="hidden sm:block text-sm font-medium leading-6 text-gray-900">Address</label>
                                    <div class="mt-2">
                                        <textarea name="address" id="edit_address" rows="3" required placeholder="Full Address"
                                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 sm:mt-4 flex flex-col-reverse sm:flex-row-reverse gap-2">
                                <button type="submit"
                                    class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">
                                    Update Supplier
                                </button>
                                <button type="button" onclick="closeEditSupplierModal()"
                                    class="mt-0 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($suppliers->hasPages())
        <div class="mt-4">
            {{ $suppliers->links() }}
        </div>
    @endif
@endsection

@push('scripts')
<script>
    function openSupplierModal() {
        const modal = document.getElementById('supplierModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeSupplierModal() {
        const modal = document.getElementById('supplierModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    const supplierModalBackdrop = document.getElementById('supplierModalBackdrop');
    if (supplierModalBackdrop) {
        supplierModalBackdrop.addEventListener('click', function(e) {
            if (e.target === this) {
                closeSupplierModal();
            }
        });
    }

    // Close modal on escape key press
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSupplierModal();
        }
    });

    // Focus trap for accessibility
    document.getElementById('supplierModal').addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            const focusableElements = this.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            const firstFocusableElement = focusableElements[0];
            const lastFocusableElement = focusableElements[focusableElements.length - 1];

            if (e.shiftKey) {
                if (document.activeElement === firstFocusableElement) {
                    lastFocusableElement.focus();
                    e.preventDefault();
                }
            } else {
                if (document.activeElement === lastFocusableElement) {
                    firstFocusableElement.focus();
                    e.preventDefault();
                }
            }
        }
    });

    // Edit modal functions
    function openEditSupplierModal(id, name, email, phone, address) {
        const modal = document.getElementById('editSupplierModal');
        const form = document.getElementById('editSupplierForm');
        const nameInput = document.getElementById('edit_name');
        const emailInput = document.getElementById('edit_email');
        const phoneInput = document.getElementById('edit_phone');
        const addressInput = document.getElementById('edit_address');

        // Set form action
        form.action = `/suppliers/${id}`;
        
        // Set form values
        nameInput.value = name;
        emailInput.value = email;
        phoneInput.value = phone;
        addressInput.value = address;

        // Show modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeEditSupplierModal() {
        const modal = document.getElementById('editSupplierModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close edit modal when clicking outside
    const editSupplierModalBackdrop = document.getElementById('editSupplierModalBackdrop');
    if (editSupplierModalBackdrop) {
        editSupplierModalBackdrop.addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditSupplierModal();
            }
        });
    }

    // Add escape key handler for edit modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeEditSupplierModal();
        }
    });

    // Focus trap for edit modal
    document.getElementById('editSupplierModal').addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            const focusableElements = this.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            const firstFocusableElement = focusableElements[0];
            const lastFocusableElement = focusableElements[focusableElements.length - 1];

            if (e.shiftKey) {
                if (document.activeElement === firstFocusableElement) {
                    lastFocusableElement.focus();
                    e.preventDefault();
                }
            } else {
                if (document.activeElement === lastFocusableElement) {
                    firstFocusableElement.focus();
                    e.preventDefault();
                }
            }
        }
    });
</script>
@endpush