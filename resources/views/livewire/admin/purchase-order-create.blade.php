<div>
    <x-wire-card>
        <form wire:submit="save" class="space-y-4">
            <div class="grid grid-cols-4 gap-4">
                <x-wire-native-select label="Tipo de Comprobante" wire:model="vaucher_type">
                    <option value="1">Factura</option>
                    <option value="2">Boleta</option>
                </x-wire-native-select>

                <x-wire-input 
                label="Serie" 
                wire:model="serie" 
                placeholder="Serie del comprobante"
                disabled
                />

                <x-wire-input 
                label="Correlativo" 
                wire:model="correlative" 
                placeholder="Correlativo del comprobante"
                disabled
                />

                <x-wire-input 
                label="Fecha" 
                wire:model="date" 
                type="date"
                />
            </div>

            
        </form>
    </x-wire-card>
</div>
