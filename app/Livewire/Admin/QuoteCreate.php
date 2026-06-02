<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\Quote;
use Livewire\Component;

class QuoteCreate extends Component
{
    public $vaucher_type = 1; // Default to "Factura"
    public $serie = 'C001';
    public $correlative;
    public $date;
    public $customer_id;
    public $total = 0;
    public $observations;
    public $products = [];
    public $product_id;

    public function boot()
    {
        //Verificar si hay errores de validación previos
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();
                $html = '<ul class="text-left">';

                foreach ($errors as $error) {
                    $html .= "<li>{$error[0]}</li>";
                }

                $html .= '</ul>';

                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => '¡Error de validación!',
                    'html' => $html,
                ]);
            }
        });
    }

    public function mount()
    {
        $this->correlative = Quote::max('correlative') + 1; // Get the next correlative number
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
            'price' => $product->price,
            'subtotal' => $product->price,
        ];

        $this->reset('product_id');
    }

    public function save()
    {
        $this->validate([
            'vaucher_type' => 'required|in:1,2',
            'date' => 'nullable|date',
            'customer_id' => 'required|exists:customers,id',
            'total' => 'required|numeric|min:0',
            'observations' => 'nullable|string|max:255',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ],[],[
            'vaucher_type' => 'tipo de comprobante',
            'date' => 'fecha',
            'customer_id' => 'cliente',
            'total' => 'total',
            'observations' => 'observaciones',
            'products' => 'productos',
            'products.*.id' => 'producto',
            'products.*.quantity' => 'cantidad',
            'products.*.price' => 'precio',
        ]);

        $quote = Quote::create([
            'vaucher_type' => $this->vaucher_type,
            'serie' => $this->serie,
            'correlative' => $this->correlative,
            'date' => $this->date ?? now(),
            'customer_id' => $this->customer_id,
            'total' => $this->total,
            'observations' => $this->observations,
        ]);

        foreach ($this->products as $product) {
            $quote->products()->attach($product['id'], [
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'subtotal' => $product['quantity'] * $product['price'],
            ]);
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'La cotización ha sido creada exitosamente.',
        ]);
        return redirect()->route('admin.quotes.index');
    }

    public function render()
    {
        return view('livewire.admin.quote-create');
    }
}
