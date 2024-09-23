<html>

<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
</head>

<body>
    <p>Dear {{ $customerOrder->customer->name }},</p>
    <p>We have sent the order to you. Order ID ye hai: {{ $customerOrder->id }}</p>
    <p>Order ki total price ye hai: {{ Number::currency($customerOrder->total_price, 'INR') }}</p>
    <p>Order ki details niche di hui hai:</p>

    <ul>
        @foreach ($customerOrder->customerOrderItems as $item)
        <li>{{ $item->product->name }} - {{ $item->quantity }} x {{ Number::currency($item->unit_price, 'INR') }} = {{ Number::currency($item->total_price, 'INR') }}</li>
        @endforeach
    </ul>

    <p>Aap ko order 2 se 3 dino me mil jayegi.</p>
    <p>Thank you!</p>
</body>

</html>
