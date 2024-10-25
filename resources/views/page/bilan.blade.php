@extends('dashboard')

@Section('dasboard_containte')
    
    <div class="container mt-5">
        <h1 class="mb-4">Bilan et Statistiques</h1>

        <!-- Section Statistiques Générales -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Réservations</h5>
                        <p class="card-text">150</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Payé</h5>
                        <p class="card-text">100</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Non Payé</h5>
                        <p class="card-text">50</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Annulations</h5>
                        <p class="card-text">10</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Graphiques -->
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Réservations par Mois
                    </div>
                    <div class="card-body">
                        <!-- Graphique en Barres -->
                        <canvas id="reservationChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Statut des Paiements
                    </div>
                    <div class="card-body">
                        <!-- Graphique en Secteurs -->
                        <canvas id="paymentChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Bilan Détail -->
        <div class="card mb-5">
            <div class="card-header">
                Détails des Réservations
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Direction</th>
                            <th>Nombre de Réservations</th>
                            <th>Nombre Payé</th>
                            <th>Nombre Non Payé</th>
                            <th>Annulations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Octobre 2024</td>
                            <td>TMV-SM</td>
                            <td>50</td>
                            <td>30</td>
                            <td>15</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td>Septembre 2024</td>
                            <td>SM-TMV</td>
                            <td>40</td>
                            <td>35</td>
                            <td>5</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Août 2024</td>
                            <td>TMV-SM</td>
                            <td>60</td>
                            <td>35</td>
                            <td>20</td>
                            <td>5</td>
                        </tr>
                    </tbody>
                </table>
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