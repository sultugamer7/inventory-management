<?php

namespace App\Livewire\CustomerOrders;

use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerOrderCreatedMail;

class Create extends Component
{
    public $customers;
    public $selectedCustomerID;
    public $orderItems = [];
    public $suppliers;
    public $totalPrice = 0;

    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();

        $this->addOrderItem();

        $this->suppliers = Supplier::whereHas('products')->orderBy('name')->get();
    }

    public function addOrderItem()
    {
        $this->orderItems[] = [
            'supplier_id' => null,
            'products' => [],
            'product_id' => null,
            'unit_price' => 0,
            'quantity' => 1,
            'stock' => 1,
            'total_price' => 0
        ];
    }

    public function populateProducts(int $index)
    {
        $this->orderItems[$index]['products'] = Product::where('supplier_id', $this->orderItems[$index]['supplier_id'])
            ->orderBy('name')
            ->get();
    }

    public function setStockAndUnitPriceAndCalculateTotalPrice(int $index)
    {
        $product = Product::find($this->orderItems[$index]['product_id']);
        $this->orderItems[$index]['unit_price'] = $product->sell_price;
        $this->orderItems[$index]['stock'] = $product->stock;

        $this->orderItems[$index]['quantity'] = 1;

        $this->calculateTotalPrice($index);
    }

    public function calculateTotalPrice(int $index)
    {
        $this->orderItems[$index]['total_price'] = $this->orderItems[$index]['unit_price'] * $this->orderItems[$index]['quantity'];

        $this->calculateOverallTotalPrice();
    }

    public function calculateOverallTotalPrice()
    {
        $this->totalPrice = array_sum(array_column($this->orderItems, 'total_price'));
    }

    public function removeOrderItem(int $index)
    {
        if (count($this->orderItems) == 1) {
            return;
        }

        unset($this->orderItems[$index]);

        $this->orderItems = array_values($this->orderItems);

        $this->calculateOverallTotalPrice();
    }

    public function render()
    {
        return view('livewire.customer-orders.create');
    }

    public function save()
    {
        $this->validate();

        $customerOrder = CustomerOrder::create([
            'customer_id' => $this->selectedCustomerID,
            'total_price' => $this->totalPrice
        ]);

        foreach ($this->orderItems as $orderItem) {
            CustomerOrderItem::create([
                'customer_order_id' => $customerOrder->id,
                'product_id' => $orderItem['product_id'],
                'unit_price' => $orderItem['unit_price'],
                'quantity' => $orderItem['quantity'],
                'total_price' => $orderItem['total_price']
            ]);

            $product = Product::find($orderItem['product_id']);
            $product->update([
                'stock' => $product->stock - $orderItem['quantity']
            ]);
        }

        // Email
        $customer = Customer::find($this->selectedCustomerID);
        Mail::to($customer->email)->send(new CustomerOrderCreatedMail($customerOrder));

        return redirect()->route('customer-orders.index');
    }

    protected function rules()
    {
        return [
            'selectedCustomerID' => ['required', 'integer'],
            'orderItems.*.supplier_id' => ['required', 'integer'],
            'orderItems.*.product_id' => ['required', 'integer'],
            'orderItems.*.unit_price' => ['required', 'numeric', 'min:1'],
            'orderItems.*.quantity' => ['required', 'integer', 'min:1'],
            'orderItems.*.total_price' => ['required', 'numeric', 'min:1'],
            'totalPrice' => ['required', 'numeric', 'min:0'],
        ];
    }
}
