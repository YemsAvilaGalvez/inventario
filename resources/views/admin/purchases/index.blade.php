<x-admin-layout 
title="Compras | inventario"
:breadcrumbs="[
    [
        'name' => 'Dashboard', 
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Compras', 
    ]
]">

<x-slot name='action'>
    <x-wire-button href="{{ route('admin.purchases.create') }}" blue>
        Nuevo
    </x-wire-button>
</x-slot>

@livewire('admin.datatables.purchase-table')

</x-admin-layout>