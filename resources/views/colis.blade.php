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
                background-color: #f8f9fa;
                color: #343a40;
            }
    
            .timeline {
                position: relative;
                padding: 20px 0;
            }
    
            .timeline-item {
                text-align: center;
                margin: 20px 0;
            }
    
            .timeline-point {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #ccc;
                margin: 0 auto;
                position: relative;
                transition: background 0.3s;
            }
    
            .timeline-point.active {
                background: #28a745; /* Couleur verte pour le statut actif */
            }
    
            .timeline-point::after {
                content: '';
                width: 2px;
                height: 100px;
                background: #ccc;
                position: absolute;
                top: 15px;
                left: 50%;
                transform: translateX(-50%);
                z-index: -1;
            }
    
            .timeline-item:last-child .timeline-point::after {
                display: none; /* Supprime la ligne après le dernier point */
            }
    
            .card {
                margin-bottom: 20px;
            }
    
            h1, h3 {
                text-align: center;
                margin-bottom: 20px;
            }
    
            .input-group {
                max-width: 600px;
                margin: 0 auto 20px auto;
            }
    
            @media (max-width: 576px) {
                .timeline-point {
                    width: 20px;
                    height: 20px;
                }
    
                .timeline-point::after {
                    height: 70px; /* Ajuste la hauteur de la ligne sur mobile */
                }
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
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 px-3 py-2 bg-danger">Réservation</a>
                    <a href="{{ route('colis.suivi') }}" class="text-sm text-gray-700 px-3 py-2 bg-danger">Suivie de Colis</a>
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
    
                <div class="container mt-5">
                    <h1>Suivi de Colis</h1>
                    <form action="{{ route('colis.suivi') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="numcolis" class="form-control" placeholder="Entrez votre Numéro de colis" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Suivre</button>
                            </div>
                        </div>
                    </form>
                    
                    @if (filled($number))

                        @forelse ($Colis as $colis)
                        <div class="row">
                            <div class="card col-md-8">
                                <div class="card-header">
                                    Détails du Colis (ID: {{$colis->num_colis}})
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Expéditeur: {{$colis->expeditaires->name}}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Destinataire: {{$colis->destinataires->name}}</h6>
                                    <p>Statut: <strong>{{$colis->statut}}</strong></p>
                                    <p>Adresse de destinatinateur: {{$colis->destinataires->Adresse}}</p>
                                    <p>Date d'envoi: {{$colis->date_envoi}}</p>
                                    <p>Date d'arrivée: N/A</p>
                                </div>
                            </div>
    
                            <div class="col-md-4">
                                <h3>Historique de Suivi</h3>
                                <div class="timeline ">
                                    <div class="timeline-item">
                                        <div class="timeline-point active">
                                            <span>Déposé</span>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-point active">
                                            <span>Expédié</span>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-point">
                                            <span>Livré</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty
                            <div class="text-center">Aucune colis trouvé</div>
                        @endforelse

                        
                    @else
                        @forelse ($Colis as $colis)
                        <div class="card">
                            <div class="card-header">
                                Détails du Colis (ID: {{$colis->num_colis}})
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Expéditeur: {{$colis->expeditaires->name}}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Destinataire: {{$colis->destinataires->name}}</h6>
                                
                            </div>
                        </div>

                        
                        @empty
                            <div class="text-center">Aucune colis trouvé</div>
                        @endforelse
                    @endif


                    
                    
                </div>

                   
            </div>
        
    </body>
</html>
