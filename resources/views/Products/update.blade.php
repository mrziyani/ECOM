<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumia - Modifier {{ $product->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/style11.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style12.css') }}">
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
            <a href="{{ route('orderitem.panier') }}">Panier</a>
            <a href="{{ route('orderitem.history') }}">History</a>
            <a href="{{ route('user.profil') }}">Profil</a>
        </div>
    </header>
    <main>
    <div class="product-container">
        <div class="product-images">
            <img src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->name }}" height="350" width="350">
        </div>
        <div class="product-info">
            <h1 class="product-title">Modifier le produit : {{ $product->name }}</h1>
            <form action="{{ route('product.afterupdate', $product->product_id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <label for="name">Nom du produit :</label>
    <input type="text" id="name" name="name" value="{{ $product->name }}" required>

    <label for="price">Prix :</label>
    <input type="number" id="price" name="price" value="{{ $product->price }}" required>

    <label for="stock">Quantité en stock :</label>
    <input type="number" id="stock" name="stock" value="{{ $product->stock }}" required>

    <p class="product-delivery">Livraison gratuite (vous économisez 22.00 Dhs) vers CASABLANCA - Anfa</p>
    <div class="product-rating">★★★★☆ ({{ $product->reviews_count }} avis vérifiés)</div>
    
    <button type="submit" name="action" value="update" class="buy-button">Mettre à jour</button>
    <button type="submit" name="action" value="delete" class="buy-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</button>
</form>
        </div>
    </div>
</main>

