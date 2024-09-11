<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Search Form -->
                    <form action="{{ route('order.create') }}" method="GET">
                        <div class="mb-4">
                            <label for="search" class="block text-sm font-medium text-gray-700">Search Merchant by Type
                                or Address</label>
                            <input type="text" name="search" id="search"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                placeholder="Enter merchant type or address" value="{{ request('search') }}" />
                        </div>
                        <div class="flex justify-end mb-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Search
                            </button>
                        </div>
                    </form>

                    <!-- Display Products Based on Search Results -->
                    @if ($products->isNotEmpty())
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="product_id" class="block text-sm font-medium text-gray-700">Select
                                    Product</label>
                                <select name="product_id" id="product_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }} (Merchant:
                                            {{ $product->merchant->company_name }})</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="text" name="phone" id="phone"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    value="{{ old('phone') }}" required />
                                <p class="text-gray-500 text-sm mt-1">Input Phone for WhatsApp Notification</p>
                                @error('phone')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="order_date" class="block text-sm font-medium text-gray-700">Order
                                    Date</label>
                                <input type="datetime-local" name="order_date" id="order_date"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    value="{{ old('order_date') }}" required />
                                @error('order_date')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="total_porsi" class="block text-sm font-medium text-gray-700">Total
                                    Portions</label>
                                <input type="number" name="total_porsi" id="total_porsi"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    value="{{ old('total_porsi') }}" required />
                                @error('total_porsi')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="pickup_date" class="block text-sm font-medium text-gray-700">Pickup
                                    Date</label>
                                <input type="date" name="pickup_date" id="pickup_date"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    value="{{ old('pickup_date') }}" required />
                                @error('pickup_date')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="total_price" class="block text-sm font-medium text-gray-700">Total
                                    Price</label>
                                <input type="number" name="total_price" id="total_price"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                    value="{{ old('total_price') }}" required />
                                @error('total_price')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Create Order
                                </button>
                            </div>
                        </form>
                    @else
                        <p class="text-red-500">No products found matching your search criteria.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ old('phone') }}" required />
                            <p class="text-gray-500 text-sm mt-1">Input Phone for WhatsApp Notification</p>
                            @error('phone')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="order_date" class="block text-sm font-medium text-gray-700">Order Date</label>
                            <input type="datetime-local" name="order_date" id="order_date"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ old('order_date') }}" required />
                            @error('order_date')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="total_porsi" class="block text-sm font-medium text-gray-700">Total
                                Portions</label>
                            <input type="number" name="total_porsi" id="total_porsi"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ old('total_porsi') }}" required />
                            @error('total_porsi')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="pickup_date" class="block text-sm font-medium text-gray-700">Pickup Date</label>
                            <input type="date" name="pickup_date" id="pickup_date"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ old('pickup_date') }}" required />
                            @error('pickup_date')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="total_price" class="block text-sm font-medium text-gray-700">Total Price</label>
                            <input type="number" name="total_price" id="total_price"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ old('total_price') }}" required />
                            @error('total_price')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="product_id" class="block text-sm font-medium text-gray-700">Product</label>
                            <select name="product_id" id="product_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="" disabled selected>Select a product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <a href="{{ route('order.index') }}"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back
                            </a>
                            <button type="reset"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Reset
                            </button>
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
