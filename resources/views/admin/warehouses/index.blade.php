<x-admin-layout 
title="Almacenes | inventario"
:breadcrumbs="[
    [
        'name' => 'Dashboard', 
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Almacenes', 
    ]
]">

<x-slot name='action'>
    <x-wire-button href="{{ route('admin.warehouses.create') }}" blue>
        Nuevo
    </x-wire-button>
</x-slot>

@livewire('admin.datatables.warehouse-table')

@push('js')
    <script>
        froms = document.querySelectorAll('.delete-form');

        froms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "No podrás revertir esta acción!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, eliminar!",
                    cancelButtonText: "Cancelar"
                    }).then((result) => {
                    if (result.isConfirmed){
                        form.submit();
                    }                    
                });
            });
        });
    </script>
@endpush
</x-admin-layout>