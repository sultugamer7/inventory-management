<?php

namespace App\Livewire\SupplierOrders;

use App\Models\Product;
use App\Models\SupplierOrder;
use App\Models\SupplierOrderItem;
use Livewire\Component;
use App\Models\Supplier;

class Create extends Component
{
    public $suppliers;
    public $products = [];

    public $selectedSupplierID;
    public $orderItems = [];
    public $totalPrice = 0;

    public function mount()
    {
        $this->suppliers = Supplier::whereHas('products')->orderBy('name')->get();

        $this->addOrderItem(false);
    }

    public function addOrderItem(bool $shouldValidate = true)
    {
        if ($shouldValidate) {
            $this->validate();
        }

        $this->orderItems[] = [
            'product_id' => null,
            'unit_price' => 0,
            'quantity' => 1,
            'total_price' => 0
        ];
    }

    public function removeOrderItem(int $index)
    {
        if (count($this->orderItems) == 1) {
            return;
        }

        unset($this->orderItems[$index]);

        $this->orderItems = array_values($this->orderItems);
    }

    public function render()
    {
        return view('livewire.supplier-orders.create');
    }

    public function populateProducts()
    {
        $this->products = Product::orderBy('name')->where('supplier_id', $this->selectedSupplierID)->get();
    }

    public function setUnitPriceAndCalculateTotalPrice(int $index)
    {
        $this->orderItems[$index]['unit_price'] = Product::find($this->orderItems[$index]['product_id'])->buy_price;

        $this->orderItems[$index]['quantity'] = 1;

        $this->calculateTotalPrice($index);
    }

    public function calculateTotalPrice(int $index)
    {
        $this->orderItems[$index]['total_price'] = $this->orderItems[$index]['unit_price'] * $this->orderItems[$index]['quantity'];

        $this->totalPrice = array_sum(array_column($this->orderItems, 'total_price'));
    }

    public function save()
    {
        $this->validate();

        $supplierOrder = SupplierOrder::create([
            'supplier_id' => $this->selectedSupplierID,
            'total_price' => $this->totalPrice
        ]);

        foreach ($this->orderItems as $orderItem) {
            SupplierOrderItem::create([
                'supplier_order_id' => $supplierOrder->id,
                'product_id' => $orderItem['product_id'],
                'unit_price' => $orderItem['unit_price'],
                'quantity' => $orderItem['quantity'],
                'total_price' => $orderItem['total_price']
            ]);

            $product = Product::find($orderItem['product_id']);
            $product->update([
                'stock' => $product->stock + $orderItem['quantity']
            ]);
        }

        // Email

        return redirect()->route('supplier-orders.index');
    }

    protected function rules()
    {
        return [
            'selectedSupplierID' => ['required', 'integer'],
            'orderItems.*.product_id' => ['required', 'integer'],
            'orderItems.*.unit_price' => ['required', 'numeric', 'min:1'],
            'orderItems.*.quantity' => ['required', 'integer', 'min:1'],
            'orderItems.*.total_price' => ['required', 'numeric', 'min:1'],
            'totalPrice' => ['required', 'numeric', 'min:0'],
        ];
    }
}
