@extends('dashboard')

@Section('dasboard_containte')
    
    <div class="container mt-5">
        <div class="container py-5">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h1 class="fw-bold">Gestion des Finances</h1>
                    <p class="text-muted">Suivez vos revenus, dépenses et profits en un coup d’œil.</p>
                </div>
            </div>
    
            <!-- Statistiques rapides -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Total Revenus</h5>
                            <p class="display-6 text-success">{{$revenus}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Total Dépenses</h5>
                            <p class="display-6 text-danger">{{$depenses}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Profit Net</h5>
                            <p class="display-6 text-primary">{{$revenus - $depenses}}</p>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Graphiques -->
            <div class="row mb-5">
                <div class="col-md-6">
                    <canvas id="revenusChart"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="depensesChart"></canvas>
                </div>
            </div>
    
            <!-- Liste des transactions -->
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Historique des Transactions</h5>
                    <a href="#" class="btn btn-primary btn-sm">Ajouter une Transaction</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Montant</th>
                                <th>type</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @forelse($alltransaction as $transaction)
                                <tr>
                                    
                                    <td>{{ $transaction->date_transaction }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td><span class="badge bg-success">{{ $transaction->type }}</span></td>
                                    <td>{{ $transaction->montant }} Ariary</td>
                                    <td>{{ $transaction->type }}</td>
                                </tr>

                            @empty
                                <p class="text-muted">Aucune transaction disponible.</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <script>
            // Graphique Revenus
            const revenusCtx = document.getElementById('revenusChart').getContext('2d');
            new Chart(revenusCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Revenus ($)',
                        data: [1200, 1500, 1800, 2000, 2300, 2500],
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    }]
                },
            });
    
            // Graphique Dépenses
            const depensesCtx = document.getElementById('depensesChart').getContext('2d');
            new Chart(depensesCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Dépenses ($)',
                        data: [800, 900, 1100, 1200, 1400, 1500],
                        borderColor: 'rgba(255, 99, 132, 0.5)',
                        borderWidth: 2,
                    }]
                },
            });
        </script>
    </div>

@endsection