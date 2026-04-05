<?php

namespace App\Livewire\Admin;

use App\Models\PurchaseOrder;
use Livewire\Component;

class PurchaseOrderCreate extends Component
{
    public $vaucher_type = 1; // Default to "Factura"
    public $serie;
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

    public function save()
    {
        // Validation and saving logic will go here
    }

    public function render()
    {
        return view('livewire.admin.purchase-order-create');
    }
}
