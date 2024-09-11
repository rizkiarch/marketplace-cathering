<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoices') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-semibold">Invoice List</h3>
                        {{-- @if (Auth::user()->role === 'merchant')
                            <a href="{{ route('invoice.create') }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                                Invoice</a>
                        @endif --}}
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">#</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Order Date</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Pickup Date</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Product Name</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Invoice Date</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Total Price</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Paid</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td class="text-left py-3 px-4">{{ $loop->iteration }}</td>
                                        <td class="text-left py-3 px-4">
                                            {{ $invoice->order->order_date->format('d/m/Y H:i') }}</td>
                                        <td class="text-left py-3 px-4">
                                            {{ $invoice->order->pickup_date->format('d/m/Y') }}</td>
                                        <td class="text-left py-3 px-4">{{ $invoice->order->product->name }}</td>
                                        <td class="text-left py-3 px-4">
                                            {{ $invoice->invoice_date->format('d/m/Y H:i') }}</td>
                                        <td class="text-left py-3 px-4">
                                            {{ number_format($invoice->total_price, 0, ',', '.') }} IDR</td>
                                        <td class="text-left py-3 px-4">
                                            {{ $invoice->is_paid ? 'Yes' : 'No' }}
                                        </td>
                                        <td class="text-left py-3 px-4">
                                            <a href="{{ route('invoice.show', $invoice->id) }}"
                                                class="text-blue-500 hover:underline mr-3">View</a>

                                            @if (Auth::user()->role === 'merchant')
                                                @if ($invoice->is_paid != '1')
                                                    <a href="{{ route('invoice.edit', $invoice->id) }}"
                                                        class="text-blue-500 hover:underline mr-3">Edit</a>
                                                @endif
                                            @endif

                                            {{-- <form action="{{ route('invoice.destroy', $invoice->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
