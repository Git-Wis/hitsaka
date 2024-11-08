@extends('dashboard')

@Section('dasboard_containte')
    
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Bilan et Statistiques</h1>

        <!-- Section Statistiques Générales -->
        <div class="row mb-4">
            <div class="col-12 col-md-4 mb-3">
                <div class="card text-white bg-primary h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Réservations</h5>
                        <p class="card-text">{{$totalResa}}</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-3">
                <div class="card text-white bg-success h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Confirmé</h5>
                        <p class="card-text">{{$totalConfirm}}</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-3">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body">
                        <h5 class="card-title">Non Confirmé</h5>
                        <p class="card-text">{{$totalNotConfirm}}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Graphiques -->
        <div class="row mb-5">
            <div class="col-12 col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        Réservations par Mois
                    </div>
                    <div class="card-body">
                        <!-- Graphique en Barres -->
                        <canvas id="reservationChart" class="w-100" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        Statut des Paiements
                    </div>
                    <div class="card-body">
                        <!-- Graphique en Secteurs -->
                        <canvas id="paymentChart" class="w-100" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Bilan Détail -->
        <div class="card mb-5">
            <div class="card-header">
                Détails des Réservations Des trois Derniers Mois
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Date</th>
                                <th>Nombre de Réservations</th>
                                <th>Nombre Payé</th>
                                <th>Nombre Non Payé</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$mois3['Month_Name']}} 2024</td>
                                <td>{{$mois3['count']}}</td>
                                <td>{{$mois3['count_Conf']}}</td>
                                <td>{{$mois3['Count_Conf_Not']}}</td>
                               
                            </tr>
                            <tr>
                                
                                <td>{{$mois2['Month_Name']}} 2024</td>
                                <td>{{$mois2['count']}}</td>
                                <td>{{$mois2['count_Conf']}}</td>
                                <td>{{$mois2['Count_Conf_Not']}}</td>
                                
                            </tr>
                            <tr>
                                <td>{{$mois1['Month_Name']}} 2024</td>
                                <td>{{$mois1['count']}}</td>
                                <td>{{$mois1['count_Conf']}}</td>
                                <td>{{$mois1['Count_Conf_Not']}}</td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Chart.js pour les Graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Données pour le graphique des réservations
        var ctx = document.getElementById('reservationChart').getContext('2d');
        var reservationChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Réservations',
                    data: [12, 19, 3, 5, 2, 3, 9, 13, 22, 30, 20, 12],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Données pour le graphique des paiements
        var ctx2 = document.getElementById('paymentChart').getContext('2d');
        var paymentChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Payé', 'Non Payé'],
                datasets: [{
                    label: 'Paiements',
                    data: [75, 25],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>
    
@endsection