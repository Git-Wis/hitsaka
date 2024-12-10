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
                            <p class="display-6 text-success">{{$totalrevenus}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Total Dépenses</h5>
                            <p class="display-6 text-danger">{{$totaldepenses}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Profit Net</h5>
                            <p class="display-6 text-primary">{{$totalrevenus - $totaldepenses}}</p>
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
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createTransactionModal">Ajouter une Transaction</button>
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
                                    <td>
                                        <span class="{{ $transaction->type == 'Dépense' ? 'badge bg-danger' : 'badge bg-success' }}">
                                            {{ $transaction->type }}
                                        </span>
                                    </td>
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

        <!-- Modal -->
        <div class="modal fade" id="createTransactionModal" tabindex="-1" aria-labelledby="createTransactionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTransactionModalLabel">Nouvelle Dépense / Transaction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('capital.store') }}">
                        @csrf
                        <div class="modal-body">
                            <!-- Montant -->
                            <div class="mb-3">
                                <label for="montant" class="form-label">Montant</label>
                                <input type="number" class="form-control" id="montant" name="montant" required>
                            </div>

                            <!-- Type -->
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Sélectionner le type</option>
                                    <option value="Dépense">Dépense</option>
                                    <option value="Revenu">Revenu</option>
                                </select>
                            </div>

                            <div class="mb-3" id="expenseCategorySection">
                                <label for="expense_type_id" class="form-label">Categorie de dépense :</label>
                                <select name="expense_type_id" id="expense_type_id" onchange="updateDescription()">
                                    <option value="" selected disabled>-- Sélectionner un type --</option>
                                    @foreach ($categoriesDepense as $type)
                                        <option value="{{ $type->id }}" data-description="{{ $type->description }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Description générée automatiquement"></textarea>
                            </div>

                            


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>

            function toggleCategories() {
                const typeSelect = document.getElementById('type');
                const expenseCategorySection = document.getElementById('expenseCategorySection');

                    // Afficher la section "Catégorie de dépense" uniquement si le type est "Dépense"
                if (typeSelect.value === 'Dépense') {
                    expenseCategorySection.style.display = 'block';
                } else {
                    expenseCategorySection.style.display = 'none';
                }
            }

            // Fonction pour mettre à jour la description automatiquement
            function updateDescription() {
                // Récupérer l'élément sélectionné
                const select = document.getElementById('expense_type_id');
                const selectedOption = select.options[select.selectedIndex];

                // Récupérer la description associée au type sélectionné
                const description = selectedOption.getAttribute('data-description') || '';

                // Mettre à jour la zone de texte avec la description
                document.getElementById('description').value = description;

            }

            const revenusData = @json($revenus);
            const depensesData = @json($depenses);
            // Revenus
            const revenusLabels = Object.keys(revenusData).map(mois => `Mois ${mois}`);
            const revenusValues = Object.values(revenusData);
        
            const revenusCtx = document.getElementById('revenusChart').getContext('2d');
            new Chart(revenusCtx, {
                type: 'bar',
                data: {
                    labels: revenusLabels,
                    datasets: [{
                        label: 'Revenus',
                        data: revenusValues,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
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
        
            // Dépenses
            const depensesLabels = Object.keys(depensesData).map(mois => `Mois ${mois}`);
            const depensesValues = Object.values(depensesData);
        
            const depensesCtx = document.getElementById('depensesChart').getContext('2d');
            new Chart(depensesCtx, {
                type: 'bar',
                data: {
                    labels: depensesLabels,
                    datasets: [{
                        label: 'Dépenses',
                        data: depensesValues,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
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
        </script>
        
    </div>

@endsection