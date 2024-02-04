@props(['products'])
<x-layout>
        <button><a href="{{ route('products.create') }}" class="rounded bg-blue-500 p-2 text-white hover:bg-blue-400">Create Product</a></button>
        @if (session('success'))
            <p class="bg-green-500 text-white p-3 w-100 my-3">{{ session('success') }}</p>
        @endif
        <table class="table-auto border-collapse border border-slate-400 mt-5 rounded">
            <thead>
                <tr>
                    <th class="border border-slate-400 p-2">Id</th>
                    <th class="border border-slate-400 p-2 w-[200px]">Name</th>
                    <th class="border border-slate-400 p-2 w-[200px]">Description</th>
                    <th class="border border-slate-400 p-2 w-[200px]">Price</th>
                    <th class="border border-slate-400 p-2 w-[200px]">Stock</th>
                    <th class="border border-slate-400 p-2 w-[200px]">Category</th>
                    <th class="border border-slate-400 p-2 w-[200px]">Image</th>
                    <th class="border border-slate-400 p-2 w-[200px]">Control</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key=>$product)
                    <tr class="border border-slate-400">
                        <td class="border border-slate-400 p-2">{{ $key+1}}</td>
                        <td class="border border-slate-400 p-2">{{ $product->name }}</td>
                        <td class="border border-slate-400 p-2">{{ $product->description }}</td>
                        <td class="border border-slate-400 p-2">{{ $product->price }}</td>
                        <td class="border border-slate-400 p-2">{{ $product->stock_quantity }}</td>
                        <td class="border border-slate-400 p-2">{{ $product->category->name }}</td>
                        <td class="border border-slate-400 p-2">
                            <img src="{{ asset('image/products/'.$product->image) }}" width="100px" alt="">
                        </td>
                        <td class="border p-2 flex items-center gap-3 justify-center">
                            <button><a href="{{ route('products.edit',$product->slug) }}" class="bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-400 rounded">Edit</a></button>
                            <form action="{{ route('products.destroy',$product->slug) }}"  method="post">
                                @csrf
                                @method("delete")
                                <button class="bg-red-500 px-3 py-1 text-white hover:bg-red-400 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{ $products->links() }}
        </table>
</x-layout>
