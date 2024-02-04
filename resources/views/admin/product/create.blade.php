@props(['categories'])
<x-layout>
    <div class="">
        <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-3xl mb-4 font-semibold leading-7 text-blue-500">Create Product</h2>
                    <div class="">
                        <label for="name" class="block font-medium leading-6 text-gray-900">Product name</label>
                        <input type="text" name="name" id="name" autocomplete="given-name" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="">
                        <label for="description" class="block font-medium leading-6 text-gray-900">Product description</label>
                        <textarea name="description" id="description" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        @error('description')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="">
                        <label for="price" class="block font-medium leading-6 text-gray-900">Product price</label>
                        <input type="number" name="price" id="price" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('price')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="">
                        <label for="stock" class="block font-medium leading-6 text-gray-900">Stock</label>
                        <input type="number" name="stock_quantity" id="stock" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('stock_quantity')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="">
                        <label for="category" class="block font-medium leading-6 text-gray-900">Category</label>
                        <select name="category_id" id="category" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id}}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="">
                        <label for="image" class="block font-medium leading-6 text-gray-900">Image</label>
                        <input type="file" name="image" id="image" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('image')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create Product</button>
            </div>
            </form>
    </div>
</x-layout>
