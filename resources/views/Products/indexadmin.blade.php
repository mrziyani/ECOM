<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumia - Téléphones Portables</title>
    <link rel="stylesheet" href="{{ asset('css/style10.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
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
            <a href="{{ route('product.create') }}">create</a>
            <a href="{{ route('user.disconnect') }}">disconnect</a>
        </div>
    </div>
</header>
    
<main>
    <!-- Display flash messages -->
    @if (session('success'))
    <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div  class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="form-input">
        <form action="{{ route('filter.filterProducts') }}" method="POST">
        @csrf
            <h2>Catégories</h2>
            <select id="category" name="category" class="form-input" required> 
                <option value="Category">Category</option>
                <option value="Phones">Phones</option>
                <option value="Electric Products">Electric Products</option>
            </select>
            <div class="form-group">
                <button class="search-button" type="submit">Sélectionner</button>
            </div>
        </form>
    </div>
    
    <div class="product-grid">
        @foreach ($products as $product)
            <div class="product-card">
                <a href="{{ route('product.update', ['id' => $product->product_id]) }}" class="product-link">
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
</main>
</body>
</html>