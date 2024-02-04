@props(['transactions'])
<x-layout>
        @if (session('success'))
            <p class="bg-green-500 text-white p-3 w-100 my-3">{{ session('success') }}</p>
        @endif
        @if (session('error'))
            <p class="bg-red-500 text-white p-3 w-100 my-3">{{ session('error') }}</p>
        @endif
        <h2 class="text-blue-500 font-bold text-2xl">Transaction List</h2>
        @if(count($transactions)>0)
            <table class="table-auto border-collapse border border-slate-400 mt-5 rounded">
                <thead>
                    <tr>
                        <th class="border border-slate-400 p-2">Id</th>
                        <th class="border border-slate-400 p-2 w-[200px]">User name</th>
                        <th class="border border-slate-400 p-2 w-[200px]">Image</th>
                        <th class="border border-slate-400 p-2 w-[200px]">Amount</th>
                        <th class="border border-slate-400 p-2 w-[200px]">Control</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $key=>$transaction)
                        <tr class="border border-slate-400">
                            <td class="border border-slate-400 p-2">{{ $key+1}}</td>
                            <td class="border border-slate-400 p-2">{{ $transaction->user->name }}</td>
                            <td class="border border-slate-400 p-2">
                                <img id="image" src="{{ asset('storage/'.$transaction->image) }}" width="300px" alt="photo">
                            </td>
                            <td class="border border-slate-400 p-2">{{ $transaction->amount }}</td>
                            <td class="border p-2 flex items-center gap-3 justify-center">
                                <form action="{{ route('transaction.add',$transaction->transaction_token) }}"  method="post">
                                    @csrf
                                    <button class="bg-blue-500 px-3 py-1 text-white hover:bg-blue-400 rounded">Add Money</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                {{ $transactions->links() }}
            </table>
        @else
            <h1 class="text-red-500 text-center text-2xl my-5 font-bold">There is no transaction.</h1>
        @endif

        <x-slot name="script">
            <script>
                const img = document.getElementById('image');
                img.addEventListener('click',function(){
                })
            </script>
        </x-slot>
</x-layout>
