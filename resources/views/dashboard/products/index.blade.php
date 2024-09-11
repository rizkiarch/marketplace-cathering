<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-semibold"> {{ $title }}</h3>
                        <a href="{{ route('product.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">#</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Description</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Price</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                                </tr>
                            </thead>
                            @if ($products->isEmpty())
                                <tbody class="bg-gray divide-y divide-gray-200">
                                    <tr>
                                        <td colspan="3"
                                            class="px-6 py-4 whitespace-nowrap text-gray-900 text-center">
                                            Tidak ada data </td>
                                    </tr>
                                </tbody>
                            @else
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="text-left py-3 px-4">{{ $loop->iteration }}</td>
                                        <td class="text-left py-3 px-4">{{ $product->name }}</td>
                                        <td class="text-left py-3 px-4">{{ $product->description }}</td>
                                        <td class="text-left py-3 px-4">
                                            {{ number_format($product->price, 0, ',', '.') }} IDR</td>
                                        <td class="text-left py-3 px-4">
                                            <a href="{{ route('product.edit', $product->id) }}"
                                                class="text-blue-500 hover:underline mr-3">Edit</a>
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>

                    <div class="mt-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
