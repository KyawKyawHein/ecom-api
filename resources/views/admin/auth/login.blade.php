<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      @vite('resources/css/app.css')

    <title>Admin Dashboard</title>
</head>
<body>

    <div class="h-screen w-full flex flex-col justify-center items-center">
        <h1 class="text-blue-500 text-3xl">Login</h1>
        <div class="w-full max-w-xs">
            @session('success')
                <p class="bg-green-500 p-3 text-white my-2 rounded">{{ $value }}</p>
            @endsession
            @session('error')
                <p class="bg-red-500 p-3 text-white my-2 rounded">{{ $value }}</p>
            @endsession
            <form action="{{ route('postLogin') }}" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Email
                    </label>
                    <input name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" placeholder="Email">
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                    @error('password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="text-end">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" >
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>

