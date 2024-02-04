<x-layout>
    <div class="">
    <form method="post" action="{{ route('banners.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-3xl mb-4 font-semibold leading-7 text-blue-500">Create Banner</h2>
                <div class="">
                    <label for="image" class="block font-medium leading-6 text-gray-900">Image</label>
                    <input type="file" name="image" id="image" class="p-2 block w-full bg-white rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('image')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="">
                    <label for="url" class="block font-medium leading-6 text-gray-900">Url</label>
                    <textarea name="url" id="url" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    @error('url')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="">
                    <label for="expireDate" class="block font-medium leading-6 text-gray-900">Expire Date</label>
                    <input type="date" name="expire_date" id="expireDate" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('expire_date')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create Banner</button>
        </div>
    </form>
    </div>
</x-layout>