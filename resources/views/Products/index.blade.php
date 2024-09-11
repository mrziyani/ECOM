<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumia - Téléphones Portables</title>
    <link rel="stylesheet" href="{{ asset('css/style10.css') }}">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">REDA</div>
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Cherchez un produit, une marque ou une catégorie">
                <button class="search-button">RECHERCHER</button>
            </div>
            <div class="user-actions">
                <a href="#">Bonjour, reda</a>
                <a href="#">Aide</a>
                <a href="#">Panier</a>
            </div>
        </div>
    </header>
    
    <main>
    <div class="product-grid">
    @foreach ($products as $product)
        <div class="product-card">
            <!-- Wrap the entire card in a link -->
            <a href="{{ route('product.add', ['id' => $product->product_id]) }}" class="product-link">
                <img src="{{ asset('images/' . $product->image_path) }}" height="100" width="100" alt="{{ $product->name }}">
                <div class="product-item">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p>Price: {{ $product->price }} Dhs</p>
                    <p>Stock: {{ $product->stock }}</p>
                    @if ($product->image_path)
                        <!-- Image is displayed -->
                    @else
                        <p>No image available</p>
                    @endif
                </div>
            </a>
        </div>
    @endforeach
</div>





        <div class="product-grid">
            <div class="product-card">
            <img src="{{ asset('images/icons/emsi.png') }}"        height="100" width="100" >
                <h3 class="product-title">Samsung Galaxy A05 - 6.7" - 4GB + 128GB - Noir</h3>
                <p class="product-price">1,240.00 Dhs</p>
                <p class="product-original-price">1,425.00 Dhs <span class="product-discount">-13%</span></p>
                <div class="product-rating">★★★★☆ (26)</div>
                <div class="product-seller">JUMIA EXPRESS</div>
            </div>
            <!-- Repeat the product-card div for other products -->
        </div>

    </main>
</body>
</html>