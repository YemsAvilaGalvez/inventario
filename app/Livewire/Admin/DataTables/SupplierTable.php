<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder;

class SupplierTable extends DataTableComponent
{
    //protected $model = Supplier::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Tipo Doc", "identity.name")
                ->sortable(),
            Column::make("Num Doc", "document_number")
            ->searchable()
                ->sortable(),
            Column::make("Razón Social", "name")
                ->searchable()
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Teléfono", "phone")
                ->sortable(),
            Column::make("Acciones")
                ->label(function($row) {
                    return view('admin.suppliers.actions', ['supplier' => $row]);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Supplier::query()->with('identity');
    }
}
