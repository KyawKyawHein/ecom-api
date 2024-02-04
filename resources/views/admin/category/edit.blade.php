@props(['category'])
<x-layout>
     <div class="">
        <form method="post" action="{{ route('categories.update',$category->slug) }}">
            @csrf
            @method('put')
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-3xl mb-4 font-semibold leading-7 text-blue-500">Edit Category</h2>
                    <div class="">
                        <label for="name" class="block font-medium leading-6 text-gray-900">Category name</label>
                        <input type="text" value="{{ $category->name }}" name="name" id="name" autocomplete="given-name" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Category</button>
            </div>
            </form>
    </div>
</x-layout>
