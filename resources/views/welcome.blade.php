<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hitsaka</title>

        <!-- Fonts --><!-- Styles  -->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            setTimeout(function() {
                let alert = document.querySelector('.alert');
                if (alert) {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500); // Supprimer l'élément après l'animation
                }
            }, 5000); // 5000ms = 5 secondes
        </script>


    </head>
    <body class="">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>

                <div class="hidden fixed px-6 top-6 py-4 sm:block">
                    <a href="{{ route('login') }}" class="bg-primary text-primary-foreground px-6 py-2 rounded-full hover:bg-primary/80 transition">Réservation</a>
                    <a href="{{ route('colis.suivi') }}" class="bg-primary text-primary-foreground px-6 py-2 rounded-full hover:bg-primary/80 transition">Suivie de Colis</a>
                </div>

            @endif

            <div class="container mt-5">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
        
                <!-- Section principale avec deux colonnes -->
                <div class="row mt-4">
                    <!-- Colonne gauche: image et texte d'accueil -->
                    <div class="col-md-6 d-flex align-items-center">
                        <div>
                            <img src="https://via.placeholder.com/400" alt="Voyage image" class="img-fluid mb-4" />
                            <h2>Bienvenue sur Hitsaka</h2>
                            <p>
                                <strong>Planifiez votre prochain voyage fluvial en toute simplicité !</strong><br>
                                Nous proposons des services de transport confortables et sécurisés. 
                                Faites le premier pas vers une expérience inoubliable en réservant dès maintenant votre place.
                            </p>
                            <ul>
                                <li><strong>Itinéraires flexibles :</strong> Choisissez entre TMV-SM et SM-TMV.</li>
                                <li><strong>Sécurité assurée :</strong> Profitez de notre expertise pour des voyages en toute tranquillité.</li>
                                <li><strong>Réservation facile :</strong> Un formulaire simple à compléter en quelques minutes.</li>
                            </ul>
                        </div>
                    </div>
        
                    <!-- Colonne droite: formulaire de réservation -->
                    <div class="col-md-6">
                        <h1 class="mb-4">Réserver votre billet</h1>
                        <form action="{{ route('resa.store') }}" method="POST">
                            @csrf
        
                            <div class="mb-3">
                                <label for="traget" class="form-label">Votre destination</label>
                                <select name="traget" id="traget" class="form-select" required>
                                    <option value="TMV-SM">TMV-SM</option>
                                    <option value="SM-TMV">SM-TMV</option>
                                </select>
                            </div>
        
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom & Prénom</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom complet" required />
                            </div>
        
                            <div class="mb-3">
                                <label for="mail" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="mail" name="mail" placeholder="Votre adresse e-mail" required />
                            </div>
        
                            <div class="mb-3">
                                <label for="tel" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="tel" name="tel" value="+261" placeholder="Ex: +261 34 12 345 67" required />
                            </div>
        
                            <div class="mb-3">
                                <label for="adresse1" class="form-label">Adresse 1</label>
                                <input type="text" class="form-control" id="adresse1" name="adresse1" placeholder="Votre adresse principale" />
                            </div>
        
                            <div class="mb-3">
                                <label for="adresse2" class="form-label">Adresse 2 (Optionnel)</label>
                                <input type="text" class="form-control" id="adresse2" name="adresse2" placeholder="Adresse secondaire (si applicable)" />
                            </div>
        
                            <div class="mb-3">
                                <label for="cin" class="form-label">CIN</label>
                                <input type="number" class="form-control" id="cin" name="cin" placeholder="Numéro de carte d'identité" required />
                            </div>
        
                            <div class="mb-3">
                                <label for="date" class="form-label">Date de départ</label>
                                <input type="date" class="form-control" id="date" name="date" required />
                            </div>
        
                            <button type="submit" class="btn btn-primary">Réserver</button>
                        </form>
                    </div>
                </div>
            </div>
        
    </body>
</html>
