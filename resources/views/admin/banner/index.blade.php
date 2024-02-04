@props(['banners'])
<x-layout>
        <button><a href="{{ route('banners.create') }}" class="rounded bg-blue-500 p-2 text-white hover:bg-black">Create Banner</a></button>
        @if (session('success'))
            <p class="bg-green-500 text-white p-3 w-100 my-3">{{ session('success') }}</p>
        @endif
          @if (session('error'))
            <p class="bg-green-500 text-white p-3 w-100 my-3">{{ session('success') }}</p>
        @endif
        <table class="table-auto border-collapse border border-slate-400 mt-5 rounded">
            <thead>
                <tr>
                    <th class="border border-slate-400 p-2">Id</th>
                    <th class="border border-slate-400 p-2 w-[200px]">Image</th>
                    <th class="border border-slate-400 p-2 w-[200px]">Expire Date</th>
                    <th class="border border-slate-400 p-2 w-[200px]">Link</th>
                    <th class="border border-slate-400 p-2 w-[200px]">Status</th>
                    <th class="border border-slate-400 p-2 w-[200px]">Control</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banners as $key=>$banner)
                    <tr class="border border-slate-400">
                        <td class="border border-slate-400 p-2">{{ $key+1}}</td>
                        <td class="border border-slate-400 p-2"><img src="{{asset("image/banners/$banner->image")}}" width="150px" alt=""></td>
                        <td class="border border-slate-400 p-2">{{ $banner->expire_date }}</td>
                        <td class="border border-slate-400 p-2"><a href="{{ $banner->url }}" class="text-blue-500">{{ $banner->url }}</a></td>
                        <td class="border border-slate-400 p-2 {{ $banner->status=="Active"?'text-blue-500':'text-red-500' }}">{{ $banner->status }}</td>
                        <td class="border p-2 flex items-center gap-3 justify-center">
                            <form action="{{ route('banners.destroy',$banner->id) }}"  method="post">
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

