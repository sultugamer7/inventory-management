<?php

namespace App\Livewire\Reports;

use App\Models\Customer;
use App\Models\CustomerOrder;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerOrders extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $fromDate;
    public $toDate;
    public $customers;
    public $selectedCustomerID;

    public function mount()
    {
        $this->fromDate = session('customer_orders_from_date', date('Y-m-d'));
        $this->toDate = session('customer_orders_to_date', date('Y-m-d'));
        $this->customers = Customer::whereHas('customerOrders')->orderBy('name')->get();
        $this->selectedCustomerID = session('customer_orders_selected_customer_id', null);
    }


    public function render()
    {
        return view('livewire.reports.customer-orders', [
            'customerOrders' => CustomerOrder::latest()
                ->whereBetween('created_at', ["{$this->fromDate} 00:00:00", "{$this->toDate} 23:59:59"])
                ->when($this->selectedCustomerID, function ($query) {
                    $query->where('customer_id', $this->selectedCustomerID);
                })
                ->paginate(10),
            'totalAmount' => CustomerOrder::whereBetween('created_at', ["{$this->fromDate} 00:00:00", "{$this->toDate} 23:59:59"])
                ->when($this->selectedCustomerID, function ($query) {
                    $query->where('customer_id', $this->selectedCustomerID);
                })
                ->sum('total_price'),
        ]);
    }

    public function validateDates()
    {
        if ($this->toDate < $this->fromDate) {
            $this->toDate = $this->fromDate;
        }

        session(['customer_orders_from_date' => $this->fromDate]);
        session(['customer_orders_to_date' => $this->toDate]);
    }

    public function customerUpdated()
    {
        session(['customer_orders_selected_customer_id' => $this->selectedCustomerID]);
    }
}
