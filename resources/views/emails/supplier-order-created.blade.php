<html>

<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
</head>

<body>
    <p>Dear {{ $supplierOrder->supplier->name }},</p>
    <p>Hume order mil chuki hai. Order ID ye hai: {{ $supplierOrder->id }}</p>
    <p>Order ki total price ye hai: {{ Number::currency($supplierOrder->total_price, 'INR') }}</p>
    <p>Order ki details niche di hui hai:</p>

    <ul>
        @foreach ($supplierOrder->supplierOrderItems as $item)
        <li>{{ $item->product->name }} - {{ $item->quantity }} x {{ Number::currency($item->unit_price, 'INR') }} = {{ Number::currency($item->total_price, 'INR') }}</li>
        @endforeach
    </ul>

    <p>Thank you!</p>
</body>

</html>
