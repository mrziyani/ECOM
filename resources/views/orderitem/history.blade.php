<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your history of orders</title>
    <link rel="stylesheet" href="{{ asset('css/style13.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            <a href="{{ route('orderitem.panier') }}">Panier</a>
            <a href="{{ route('orderitem.history') }}">History</a>
            <a href="{{ route('user.profil') }}">Profil</a>
        </div>
    </div>
</header>

<main>
    <h1 class="cart-title">Your history of orders</h1>

    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @if($orders->isEmpty())
    <div class="container-empty">
        <div class="icon">
            <img src="cart-icon.png" alt="Panier" />
        </div>
        <h1>Votre panier est vide!</h1>
        <p>Parcourez nos catégories et découvrez nos meilleures offres!</p>
        
        <a href="{{ route('product.index') }}" class="ok-button">COMMENCEZ VOS ACHATS</a>
    </div>
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