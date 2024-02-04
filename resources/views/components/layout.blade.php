<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      @vite('resources/css/app.css')
    {{$link??''}}
    <title>{{$title ?? "Admin Dashboard"}}</title>
</head>
<body>
    <div class="min-h-[100vh] flex">
        <div class="h-screen w-[300px] border border-right">
            <h4 class="text-3xl m-3 text-center text-blue-500 font-mono">GoShoppy</h4>
            <ul class="mt-5">
                <a href="/admin"><li class="p-2 rounded hover:text-white hover:bg-black">Dashboard</li></a>
                <div class="my-2">
                    <small class="m-3 text-red-500 font-bold">Orders</small>
                    <a href="{{route('orders.index')}}"><li class="p-2 rounded hover:text-white hover:bg-black">Order List</li></a>
                    <a href="{{route('orders.accepted')}}"><li class="p-2 rounded hover:text-white hover:bg-black">Accepted Order</li></a>
                    <a href="{{route('orders.canceled')}}"><li class="p-2 rounded hover:text-white hover:bg-black">Canceled Order</li></a>
                </div>
                <div class="my-2">
                    <small class="m-3 text-red-500 font-bold">Banner</small>
                    <a href="{{ route('banners.index') }}"><li class="p-2 rounded hover:text-white hover:bg-black">All Banners</li></a>
                    <a href="{{ route('banners.create') }}">
                        <li class="p-2 rounded hover:text-white hover:bg-black">Create Banner</li>
                    </a>
                </div>
                <div class="my-2">
                    <small class="m-3 text-red-500 font-bold">Categories</small>
                    <a href="{{ route('categories.index') }}"><li class="p-2 rounded hover:text-white hover:bg-black">All Categories</li></a>
                    <a href="{{ route('categories.create') }}">
                        <li class="p-2 rounded hover:text-white hover:bg-black">Create Category</li>
                    </a>
                </div>

                <div class="my-2">
                    <small class="m-3 text-red-500 font-bold">Products</small>
                    <a href="{{route('products.index')}}"><li class="p-2 rounded hover:text-white hover:bg-black">All Products</li></a>
                    <a href="{{route('products.create')}}"><li class="p-2 rounded hover:text-white hover:bg-black">Create Product</li></a>
                </div>
                <div class="my-2">
                    <small class="m-3 text-red-500 font-bold">Transfer</small>
                    <a href="{{route('transaction.index')}}"><li class="p-2 rounded hover:text-white hover:bg-black">Transfer List</li></a>
                </div>                
                <div class="my-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button class="p-2 w-full bg-red-500 text-white rounded hover:bg-red-400">Logout</button>
                    </form>
                </div>
            </ul>
        </div>
        <div class="p-5 w-full bg-gray-200">
            {{ $slot }}
        </div>
    </div>
    {{ $script??'' }}
</body>
</html>

