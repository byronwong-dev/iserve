@extends('layouts.app')

@section('content')
<table class="w-full divide-y divide-gray-200 table-auto">
    <thead class="bg-gray-50">
    <tr>
        <x-table-header>
            {{ __('#') }}
        </x-table-header>
        <x-table-header name="name" sortable="true">
            #ID / Name
        </x-table-header>
        <x-table-header name="username" sortable="true">
            Username
        </x-table-header>
        <x-table-header name="email" sortable="true">
            Email
        </x-table-header>
        <x-table-header name="total" sortable="false">
            Todos Completed
        </x-table-header>
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach($data as $idx => $user)
        <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
        <td class="px-6 py-4 whitespace-nowrap">
            {{ ($data->currentPage() - 1) * $data->perPage() + $idx + 1 }}
        </td>
        <td class="px-6 py-4 text-center whitespace-nowrap">
            ID: {{ $user->id }} / {{ $user->name }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            {{ $user->username ?? '-' }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            {{ $user->email ?? '-' }}
        </td>
        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
            {{ $user->total }}
        </td>
        </tr>
    @endforeach
</tbody>
</table>
@endsection