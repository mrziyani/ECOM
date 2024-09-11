<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumia - Ajouter un Nouveau Produit</title>
    <link rel="stylesheet" href="{{ asset('css/style10.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style12.css') }}">


    
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
        <h1>Ajouter un Nouveau Produit</h1>
<form action="{{ route('product.aftercreate') }}" method="POST" enctype="multipart/form-data" >
@csrf
    <div>
        <label for="name">Nom du Produit:</label>
        <input type="text" id="name" name="name" class="form-input" required>
    </div>
    
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" class="form-input" required></textarea>
    </div>
    
    <div>
        <label for="price">Prix (Dhs):</label>
        <input type="number" id="price" name="price" step="0.01" class="form-input" required>
    </div>
    
    <div>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" class="form-input" required>
    </div>
    
    <div>
        <label for="image">Image du Produit:</label>
        <input type="file"   id="image" name="image" class="form-input" required>
    </div>
    
    <button type="submit">Ajouter le Produit</button>
</form>

    </main>
</body>
</html>