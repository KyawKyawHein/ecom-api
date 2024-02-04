@props(['orders'])

<x-layout>
    <x-error/>

    <table class="table-auto border-collapse border border-slate-400 mt-5 rounded">
        <thead>
            <tr>
                <th class="border border-slate-400 p-2 w-[200px]">User Name</th>
                <th class="border border-slate-400 p-2 w-[200px]">Address</th>
                <th class="border border-slate-400 p-2 w-[200px]">Product Count</th>
                <th class="border border-slate-400 p-2 w-[200px]">Comment</th>
                <th class="border border-slate-400 p-2 w-[200px]">Ordered Date</th>
                <th class="border border-slate-400 p-2 w-[200px]">Control</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key=>$order)
                <tr class="border border-slate-400">
                    <td class="border border-slate-400 p-2">{{ $order->user->name }}</td>
                    <td class="border border-slate-400 p-2"></td>
                    <td class="border border-slate-400 p-2">{{ $order->items->count() }}</td>
                    <td class="border border-slate-400 p-2">{{ $order->comment }}</td>
                    <td class="border border-slate-400 p-2">{{ $order->created_at->diffForHumans() }}</td>
                    <td class="border p-2 flex items-center gap-3 justify-center">
                        <a href="{{route('orders.showOrderItems',$order->id)}}" class="bg-gray-400 px-3 rounded text-white">See</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{ $orders->links() }}
    </table>
</x-layout>
