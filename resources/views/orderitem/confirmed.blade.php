<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="{{ asset('css/style14.css') }}">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="success-icon">✔️</div>
            <h1>Order Successful!</h1>
        </div>

        @if(session('order'))
            @php
                $order = session('order');
            @endphp
            <p>Thank you! Your payment of <strong>Rs. {{ $order->total_amount }}</strong> will be cash on delivery.</p>
            <p>Order ID: {{ $order->id }} | Transaction ID: {{ $order->transaction_id ?? 'N/A' }}</p>

            <h2>Payment Details</h2>
            <div class="payment-details">
                <p>Total Amount: ₹ {{ $order->total_amount }}</p>
                
            </div>
        @else
            <p>Order details not found.</p>
        @endif

       
        <p class="contact">Please contact us at 1800- or email to <a href="mailto:REDA@TEST.com">REDA@TEST.com</a> for any query.</p>

        <a href="{{ route('orderitem.panier') }}" class="ok-button">OK</a>
    </div>
</body>
</html>