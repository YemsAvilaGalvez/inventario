<x-admin-layout 
title="Productos | inventario"
:breadcrumbs="[
    [
        'name' => 'Dashboard', 
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Productos', 
    ]
]">

<x-slot name='action'>
    <x-wire-button href="{{ route('admin.products.create') }}" blue>
        Nuevo
    </x-wire-button>
</x-slot>

@livewire('admin.datatables.product-table')

@push('css')
    <style>
        table th span, table td {
            font-size: 0.75rem !important
        }

        .image-product {
            width: 5rem !important;
            height: 3rem !important;
            object-fit: cover !important;
            object-position: center !important;
        }
    </style>
@endpush

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