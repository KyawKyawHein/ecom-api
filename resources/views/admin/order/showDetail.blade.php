@props(['orderItems'])

<x-layout>
    <a href="{{ route('orders.index') }}" class="bg-blue-500 text-white p-2 rounded">Back to Order List</a>
    <x-error/>
    <table class="table-auto border-collapse border border-slate-400 mt-5 rounded">
        <thead>
            <tr>
                <th class="border border-slate-400 p-2 w-[200px]">Product</th>
                <th class="border border-slate-400 p-2 w-[200px]">Image</th>
                <th class="border border-slate-400 p-2 w-[200px]">Quantity</th>
                <th class="border border-slate-400 p-2 w-[200px]">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $key=>$item)
                <tr class="border border-slate-400">
                    <td class="border border-slate-400 p-2">{{ $item->product->name }}</td>
                    <td class="border border-slate-400 p-2">{{ asset("image/products/".$item->product->image) }}</td>
                    <td class="border border-slate-400 p-2">{{ $item->quantity }}</td>
                    <td class="border border-slate-400 p-2">{{ $item->price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
