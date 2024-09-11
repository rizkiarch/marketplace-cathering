<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Order Date:</h3>
                        <p>{{ $invoice->order->order_date->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Pickup Date:</h3>
                        <p>{{ $invoice->order->pickup_date->format('d/m/Y') }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Product Name:</h3>
                        <p>{{ $invoice->order->product->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Total Price:</h3>
                        <p>{{ number_format($invoice->total_price, 0, ',', '.') }} IDR</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Paid:</h3>
                        <p>{{ $invoice->is_paid ? 'Yes' : 'No' }}</p>
                    </div>
                    <div class="flex justify-end">
                        <a href="{{ route('invoice.index') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to
                            List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
