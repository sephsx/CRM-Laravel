@section('title', 'Client Dashboard')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-fixed w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Company Name</th>
                                <th class="px-4 py-2">Phone</th>
                                <th class="px-4 py-2">Address</th>
                                <th class="px-4 py-2">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td class="border px-4 py-2">{{ $client->name }}</td>
                                    <td class="border px-4 py-2">{{ $client->company_name }}</td>
                                    <td class="border px-4 py-2">{{ $client->phone }}</td>
                                    <td class="border px-4 py-2">{{ $client->address }}</td>
                                    <td class="border px-4 py-2">{{ $client->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
