<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\WithPagination;
use App\Models\SupplierOrder;

class SupplierOrders extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $fromDate;
    public $toDate;
    public $suppliers;
    public $selectedSupplierID;

    public function mount()
    {
        $this->fromDate = session('supplier_orders_from_date', date('Y-m-d'));
        $this->toDate = session('supplier_orders_to_date', date('Y-m-d'));
        $this->suppliers = Supplier::whereHas('products')->orderBy('name')->get();
        $this->selectedSupplierID = session('supplier_orders_selected_supplier_id', null);
    }

    public function render()
    {
        return view('livewire.reports.supplier-orders', [
            'supplierOrders' => SupplierOrder::latest()
                ->whereBetween('created_at', ["{$this->fromDate} 00:00:00", "{$this->toDate} 23:59:59"])
                ->when($this->selectedSupplierID && $this->selectedSupplierID != '', function ($query) {
                    $query->where('supplier_id', $this->selectedSupplierID);
                })
                ->paginate(10),
            'totalAmount' => SupplierOrder::whereBetween('created_at', ["{$this->fromDate} 00:00:00", "{$this->toDate} 23:59:59"])
                ->when($this->selectedSupplierID && $this->selectedSupplierID != '', function ($query) {
                    $query->where('supplier_id', $this->selectedSupplierID);
                })
                ->sum('total_price'),
        ]);
    }

    public function validateDates()
    {
        if ($this->toDate < $this->fromDate) {
            $this->toDate = $this->fromDate;
        }

        session(['supplier_orders_from_date' => $this->fromDate]);
        session(['supplier_orders_to_date' => $this->toDate]);
    }

    public function supplierUpdated()
    {
        session(['supplier_orders_selected_supplier_id' => $this->selectedSupplierID]);
    }
}
