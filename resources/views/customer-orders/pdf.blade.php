<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table width="100%">
        <tr>
            <td style="padding: 10px; background-color: #f2f2f2;">
                <h1>Customer Order Details</h1>
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td style="padding: 10px;">
                <strong>ID:</strong>
                {{ $customerOrder->id }}
            </td>
            <td style="padding: 10px;">
                <strong>Customer Name:</strong>
                {{ $customerOrder->customer->name }}
            </td>
            <td style="padding: 10px;">
                <strong>Total Price:</strong>
                {{ Number::currency($customerOrder->total_price, 'INR') }}
            </td>
            <td style="padding: 10px;">
                <strong>Created At:</strong>
                {{ date('d/m/Y', strtotime($customerOrder->created_at)) }}
            </td>
        </tr>
    </table>

    <hr>

    <table width="100%">
        <tr>
            <td style="padding: 10px;"
                colspan="4">
                <h3><strong>Order Items</strong></h3>
            </td>
        </tr>

        <tr style="background-color: #f2f2f2;">
            <td style="padding: 10px;">
                <strong>Supplier Name</strong>
            </td>
            <td style="padding: 10px;">
                <strong>Product Name</strong>
            </td>
            <td style="padding: 10px;">
                <strong>Quantity</strong>
            </td>
            <td style="padding: 10px;">
                <strong>Unit Price</strong>
            </td>
            <td style="padding: 10px;">
                <strong>Total Price</strong>
            </td>
        </tr>

        @foreach ($customerOrder->customerOrderItems as $item)
        <tr>
            <td style="padding: 10px;">
                {{ $loop->iteration }}. {{ $item->supplier->name }}
            </td>
            <td style="padding: 10px;">
                {{ $item->product->name }}
            </td>
            <td style="padding: 10px;">
                {{ $item->quantity }}
            </td>
            <td style="padding: 10px;">
                {{ Number::currency($item->unit_price, 'INR') }}
            </td>
            <td style="padding: 10px;">
                {{ Number::currency($item->total_price, 'INR') }}
            </td>
        </tr>
        @endforeach
        <tr style="background-color: #f2f2f2">
            <td style="padding: 10px;" colspan="4">
                <strong>TOTAL PRICE:</strong>
            </td>
            <td style="padding: 10px;">
                <strong>
                    {{ Number::currency($customerOrder->total_price, 'INR') }}
                </strong>
            </td>
        </tr>
    </table>
</body>

</html>
