<x-admin-layout 
title="Categorías | inventario"
:breadcrumbs="[
    [
        'name' => 'Dashboard', 
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Categorías', 
        'href' => route('admin.categories.index')
    ],
    [
        'name' => 'Nuevo',
    ]
    
]">

<x-wire-card>
    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
        @csrf

        <x-wire-textarea 
            label="Descripción" 
            name="description" 
            placeholder="Descripción de la categoría" 
        > 
            {{ old('description')}}
        </x-wire-textarea>

        <x-wire-textarea 
            label="Descripción" 
            name="description" 
            placeholder="Descripción de la categoría" 
            value="{{ old('description') }}"
        />

        <div class="flex justify-end">
            <x-button>
                Guardar
            </x-button>
        </div>
    </form>
</x-wire-card>

</x-admin-layout>