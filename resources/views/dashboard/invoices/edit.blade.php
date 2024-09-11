<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('invoice.update', $invoice->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="order_id" class="block text-sm font-medium text-gray-700">Order</label>
                            <select name="order_id" id="order_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                {{-- @foreach ($orders as $order) --}}
                                <option value="{{ $invoice->order->id }}"
                                    {{ $invoice->order->order_id == $invoice->order->id ? 'selected' : '' }}>
                                    {{ $invoice->order->product->name }} -
                                    {{ $invoice->order->order_date->format('d/m/Y H:i') }}
                                </option>
                                {{-- @endforeach --}}
                            </select>
                            @error('order_id')
                                <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="invoice_date" class="block text-sm font-medium text-gray-700">Invoice
                                Date</label>
                            <input type="datetime-local" name="invoice_date" id="invoice_date"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ $invoice->invoice_date->format('Y-m-d\TH:i') }}" required />
                            @error('invoice_date')
                                <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="total_price" class="block text-sm font-medium text-gray-700">Total Price</label>
                            <input type="number" name="total_price" id="total_price"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ $invoice->total_price }}" required />
                            @error('total_price')
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
                            <label for="is_paid" class="block text-sm font-medium text-gray-700">Paid</label>
                            <input type="checkbox" name="is_paid" id="is_paid" class="mt-1" value="1"
                                {{ old('is_paid', $invoice->is_paid) ? 'checked' : '' }} />
                            @error('is_paid')
                                <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('invoice.index') }}"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back
                            </a>
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ms-4">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
