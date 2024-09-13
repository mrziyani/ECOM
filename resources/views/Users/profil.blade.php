<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - REDA</title>
    <link rel="stylesheet" href="{{ asset('css/style10.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style15.css') }}">
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
            <a href="#">Bonjour, {{ $user->name }}</a>
            <a href="{{ route('orderitem.panier') }}">Panier</a>
            <a href="{{ route('orderitem.history') }}">History</a>
            <a href="{{ route('user.profil') }}">Profil</a>
        </div>
    </div>
</header>

<div class="profile-header">
    <h1>Profile</h1>
    <a href="{{ route('user.edit', $user->id) }}" class="edit-button">Edit Profile</a> <!-- Edit button -->
</div>

<div class="about">
    <h2>About me</h2>
    <p>I am a dedicated seller with a passion for connecting people with the products they need. With experience in various markets, I understand the importance of customer satisfaction and strive to provide top-notch service. Whether it’s finding the perfect item for a buyer or negotiating deals with suppliers, my goal is to create a seamless shopping experience. I believe in building relationships based on trust and transparency, ensuring that every transaction leaves both parties happy.</p>
</div>

<div class="details">
    <h2>Details</h2>
    <p><strong>Full Name:</strong> {{ $user->firstname }} {{ $user->lastname }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    
</div>
</body>
</html>