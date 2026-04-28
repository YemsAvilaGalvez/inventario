<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\PurchaseOrder;
use Livewire\Component;

class PurchaseOrderCreate extends Component
{
    public $vaucher_type = 1; // Default to "Factura"
    public $serie = 'OC01';
    public $correlative;
    public $date;
    public $supplier_id;
    public $total = 0;
    public $observations;
    public $products = [];
    public $product_id;

    public function mount()
    {
        $this->correlative = PurchaseOrder::max('correlative') + 1; // Get the next correlative number
    }

    public function addProduct(){
        $this->validate([
            'product_id' => 'required|exists:products,id',
            ],[],[
            'product_id' => 'producto',
        ]);

        $existing = collect($this->products)
                ->firstWhere('id', $this->product_id);

        if ($existing) {
            $this->dispatch('swal', [
                'icon' => 'warning',
                'title' => 'Producto ya agregado',
                'text' => 'El producto seleccionado ya está en la lista.',
            ]);

            return;
        }

        $product = Product::find($this->product_id);

        $this->products[] = [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => 1,
            'price' => 0,
            'subtotal' => 0,
        ];

        $this->reset('product_id');
    }

    public function save()
    {
        $this->validate([
            'vaucher_type' => 'required|in:1,2',
            'date' => 'nullable|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'total' => 'required|numeric|min:0',
            'observations' => 'nullable|string|max:255',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ]);

        $purchaseOrder = PurchaseOrder::create([
            'vaucher_type' => $this->vaucher_type,
            'serie' => $this->serie,
            'correlative' => $this->correlative,
            'date' => $this->date ?? now(),
            'supplier_id' => $this->supplier_id,
            'total' => $this->total,
            'observations' => $this->observations,
        ]);

        foreach ($this->products as $product) {
            $purchaseOrder->products()->attach($product['id'], [
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'subtotal' => $product['quantity'] * $product['price'],
            ]);
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'La orden de compra ha sido creada exitosamente.',
        ]);
        return redirect()->route('admin.purchase-orders.index');
    }

    public function render()
    {
        return view('livewire.admin.purchase-order-create');
    }
}
