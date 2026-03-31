<x-admin-layout 
title="Productos | inventario"
:breadcrumbs="[
    [
        'name' => 'Dashboard', 
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Productos', 
        'href' => route('admin.products.index')
    ],
    [
        'name' => 'Nuevo',
    ]
    
]">

<x-wire-card>
    <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-4">
        @csrf

        <x-wire-input 
            label="Nombre" 
            name="name" 
            placeholder="Nombre del producto" 
            value="{{ old('name') }}"
            required 
        />

        <x-wire-textarea 
            label="Descripción" 
            name="description" 
            placeholder="Descripción de la categoría" 
            value="{{ old('description') }}"
        />

        <x-wire-input 
            label="Precio"
            type="number" 
            name="price" 
            placeholder="Precio del producto" 
            value="{{ old('price') }}"
            required 
        />

        <x-wire-native-select label="Categoría" name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </x-wire-native-select>

        <div class="flex justify-end">
            <x-button>
                Guardar
            </x-button>
        </div>
    </form>
</x-wire-card>

</x-admin-layout>