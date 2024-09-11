<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumia - {{ $product->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/style11.css') }}">
</head>
<body>
    <header>
        <div class="logo">JUMIA</div>
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Cherchez un produit, une marque ou une catégorie">
            <button class="search-button">RECHERCHER</button>
        </div>
        <div class="user-actions">
            <a href="#">Bonjour, reda</a>
            <a href="#">Aide</a>
            <a href="#">Panier</a>
        </div>
    </header>
    
    <main>
        <div class="product-container">
            <div class="product-images">
                <img src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->name }}"  height="350" width="350">
            </div>
            <div class="product-info">
                <h1 class="product-title">{{ $product->name }}</h1>
                <p class="product-brand">Marque: {{ $product->brand }} | Produits similaires par {{ $product->brand }}</p>
                <p class="product-price">{{ $product->price }} Dhs 
                    @if($product->original_price)
                        <span class="product-original-price">{{ $product->original_price }} Dhs</span>
                    @endif
                    @if($product->discount)
                        <span class="product-discount">-{{ $product->discount }}%</span>
                    @endif
                </p>
                <p class="product-availability">{{ $product->stock > 0 ? 'Disponible' : 'Indisponible' }}</p>
                <p class="product-delivery">Livraison gratuite (vous économisez 22.00 Dhs) vers CASABLANCA - Anfa</p>
                <div class="product-rating">★★★★☆ ({{ $product->reviews_count }} avis vérifiés)</div>
                
                <a href="#" class="buy-button">J'ACHÈTE</a>
            </div>
        </div>
    </main>
</body>
</html>
