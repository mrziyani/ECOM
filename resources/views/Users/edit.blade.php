<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - REDA</title>
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
    <h1>Edit Profile</h1>
</div>

<form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname" value="{{ $user->firstname }}" required>
    </div>
    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname" value="{{ $user->lastname }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required>
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="number" name="age" id="age" value="{{ $user->age ?? '' }}">
    </div>
    <button type="submit" class="save-button">Save Changes</button>
</form>

@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

</body>
</html>