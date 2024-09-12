<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="{{ asset('css/style13.css') }}">
</head>
<body>

<header>
    <div class="header-content">
        <div class="logo">REDA</div>
        <div class="formsss-input">
            <form action="{{ route('product.find') }}" method="POST">
                @csrf
                <div>
                    <input id="var" name="var" type="text" class="search-input" placeholder="Cherchez un produit ou une catégorie">
                    <button class="search-button" type="submit">RECHERCHER</button>
                </div>
            </form>
        </div>
        <div class="user-actions">
            <a href="#">Bonjour, reda</a>
            <a href="#">Panier</a>
        </div>
    </div>
</header>

<main>
    <h1 class="cart-title">Your Cart</h1> <!-- Reuse 'cart-title' class for consistency -->

    @if($orders->isEmpty())
        <p>No orders found.</p>
    @else
   

    @foreach($orders as $order)
    <div class="cart-container">
        <p>Status: {{ $order->bought ? 'Bought' : 'Not Bought' }}</p>
        <p>Total Amount: {{ $order->total_amount }} Dhs</p>

        <h3 class="cart-title">Order Items:</h3>

        @if($order->orderItems->isEmpty())
            <p>No items in this order.</p>
        @else
            @foreach($order->orderItems as $item)
                <div class="cart-item">
                    <div class="cart-product-info">
                        <img src="{{ asset('images/' . $item->product->image_path) }}" class="cart-product-image" alt="{{ $item->product->name }}">
                        <div class="cart-product-details">
                            <h3 class="product-name">{{ $item->product->name }}</h3>
                            <p class="vendor">Vendeur: {{ $item->product->vendor->name ?? 'Unknown Vendor' }}</p>
                            @if($item->product->stock <= 2)
                                <p class="stock-warning">{{ $item->product->stock }} articles seulement</p>
                            @endif
                        </div>
                    </div>

                    <div class="cart-product-actions">
                        <div class="cart-price">
                            <p class="current-price">{{ $item->price }} Dhs</p>
                            @if($item->discount)
                                <p class="original-price">{{ $item->original_price }} Dhs</p>
                                <p class="discount">-{{ $item->discount }}%</p>
                            @endif
                        </div>
                        <div class="quantity-control">
                            <input type="text" value="{{ $item->quantity }}" class="quantity-input" readonly>
                        </div>

                        <!-- Form for deletion -->
                        <div class="remove-button">
                            <form action="{{ route('orderitem.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-item"><i class="trash-icon"></i> SUPPRIMER</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endforeach
    @endif
</main>



</body>
</html>
