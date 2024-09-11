<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-semibold">Order List</h3>
                        <a href="{{ route('order.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create Order
                        </a>
                    </div>

                    @if ($orders->isEmpty())
                        <p class="text-gray-500">You have no orders.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">#</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Order Date</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Total Portions
                                        </th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Pickup Date</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Total Price</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Product</th>
                                        {{-- <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-left py-3 px-4">{{ $loop->iteration }}</td>
                                            <td class="text-left py-3 px-4">
                                                {{ $order->order_date->format('d/m/Y H:i') }}</td>
                                            <td class="text-left py-3 px-4">{{ $order->total_porsi }}</td>
                                            <td class="text-left py-3 px-4">{{ $order->pickup_date->format('d/m/Y') }}
                                            </td>
                                            <td class="text-left py-3 px-4">
                                                {{ number_format($order->total_price, 0, ',', '.') }} IDR</td>
                                            <td class="text-left py-3 px-4">{{ $order->product->name }}</td>
                                            <td class="text-left py-3 px-4">
                                                {{-- <a href="{{ route('order.show', $order->id) }}"
                                                    class="text-blue-500 hover:underline mr-3">View</a> --}}
                                                {{-- <a href="{{ route('order.edit', $order->id) }}"
                                                    class="text-blue-500 hover:underline mr-3">Edit</a> --}}
                                                {{-- <form action="{{ route('order.destroy', $order->id) }}" method="POST"
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
