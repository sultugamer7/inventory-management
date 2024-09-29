<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch"
          href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito"
          rel="stylesheet">
</head>

<body>
    <table width="100%">
        <tr>
            <td style="padding: 10px; background-color: #f2f2f2;">
                <h1>Supplier Order Details</h1>
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td style="padding: 10px;">
                <strong>ID:</strong>
                {{ $supplierOrder->id }}
            </td>
            <td style="padding: 10px;">
                <strong>Supplier Name:</strong>
                {{ $supplierOrder->supplier->name }}
            </td>
            <td style="padding: 10px;">
                <strong>Total Price:</strong>
                {{ Number::currency($supplierOrder->total_price, 'INR') }}
            </td>
            <td style="padding: 10px;">
                <strong>Created At:</strong>
                {{ date('d/m/Y', strtotime($supplierOrder->created_at)) }}
            </td>
        </tr>
    </table>

    <hr>

    <table width="100%">
        <tr>
            <td style="padding: 10px;" colspan="4">
                <h3><strong>Order Items</strong></h3>
            </td>
        </tr>

        <tr style="background-color: #f2f2f2;">
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

        @foreach ($supplierOrder->supplierOrderItems as $item)
        <tr>
            <td style="padding: 10px;">
                {{ $loop->iteration }}. {{ $item->product->name }}
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
            <td style="padding: 10px;" colspan="3">
                <strong>TOTAL PRICE:</strong>
            </td>
            <td style="padding: 10px;">
                <strong>
                    {{ Number::currency($supplierOrder->total_price, 'INR') }}
                </strong>
            </td>
        </tr>
    </table>
</body>

</html>
