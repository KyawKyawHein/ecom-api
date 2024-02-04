@session('success')
        <p class="bg-green-500 p-3 rounded text-white">{{ $value }}</p>
@endsession
@session('error')
    <p class="bg-green-500 p-3 rounded text-white">{{ $value }}</p>
@endsession
