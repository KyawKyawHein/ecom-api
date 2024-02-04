@props(['categories'])
<x-layout>
        <button><a href="{{ route('categories.create') }}" class="rounded bg-blue-500 p-2 text-white hover:bg-black">Create Category</a></button>
        @if (session('success'))
            <p class="bg-green-500 text-white p-3 w-100 my-3">{{ session('success') }}</p>
        @endif
        <table class="table-auto border-collapse border border-slate-400 mt-5 rounded">
            <thead>
                <tr>
                    <th class="border border-slate-400 p-3">Id</th>
                    <th class="border border-slate-400 p-3">Name</th>
                    <th class="border border-slate-400 p-3">Control</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key=>$category)
                    <tr>
                        <td class="border border-slate-400 p-2">{{ $key+1}}</td>
                        <td class="border border-slate-400 p-2">{{ $category->name }}</td>
                        <td class="border border-slate-400 p-2 flex gap-3">
                            <button><a href="{{ route('categories.edit',$category->slug) }}" class="bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-400 rounded">Edit</a></button>
                            <form action="{{ route('categories.destroy',$category->slug) }}"  method="post">
                                @csrf
                                @method("delete")
                                <button class="bg-red-500 px-3 py-1 text-white hover:bg-red-400 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</x-layout>
