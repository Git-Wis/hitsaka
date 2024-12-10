@extends('dashboard')

@Section('dasboard_containte')
    <div class="container mt-5">
        <h1 class="mb-4">Liste des Réservations</h1>

         @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         @endif

        <!-- Filtres -->
        <form method="GET" action="{{ route('resa.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label for="date" class="form-label">Date de départ</label>
                    <input type="date" class="form-control" name="date" id="date" value="{{ request('date') }}">
                </div>
                <div class="col-md-3">
                    <label for="direction" class="form-label">Direction</label>
                    <select name="direction" class="form-select" id="direction">
                        <option value="">Toutes</option>
                        <option value="TMV-SM" {{ request('direction') == 'TMV-SM' ? 'selected' : '' }}>TMV-SM</option>
                        <option value="SM-TMV" {{ request('direction') == 'SM-TMV' ? 'selected' : '' }}>SM-TMV</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="payer" class="form-label">Statut</label>
                    <select name="payer" class="form-select" id="payer">
                        <option value="">Tous</option>
                        <option value="1"{{ request('payer') == '1' ? 'selected' : '' }}>Confirmé</option>
                        <option value="0"{{ request('payer') == '0' ? 'selected' : '' }}>Pas Confirmé</option>
                    </select>
                </div>
                <div class="col-md-3 mt-4">

                    <div class="row">
                        <div class="col-4"><button type="submit" class="btn btn-primary mt-2">Filtrer</button></div>
                        
                        <div class="col-4">
                            <a href="{{ route('resa.export.excel') }}" class="btn btn-success me-2">Exporter en Excel</a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('resa.export.pdf') }}" class="btn btn-danger">Exporter en PDF</a>
                         </div>
                    </div>
                    
                    <!-- Boutons d'exportation -->
                    <div class="mt-4">
                    </div>
                </div>

                 

            </div>
        </form>

        <!-- Tableau des réservations -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom du client</th>
                    <th>Direction</th>
                    <th>Date de départ</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <!-- afficher les reservation par rapport au filtre selection -->

                @forelse($reservations as $reservation)
                  <tr>
                      <td>{{ $reservation->passage->name }}</td>
                      <td>{{ $reservation->direction }}</td>
                      <td>{{ $reservation->date }}</td>
                      <td>
                       
                        @if (!$reservation->payer)
                            <span class="badge bg-warning">Non confirmé</span>      
                        @else
                            <span class="badge bg-success">Confirmé</span>
                        @endif
                    </td>
                      <td>
                          @if(!$reservation->payer)
                              <form action="{{ route('resa.confirm', $reservation->id) }}" method="POST">
                                  @csrf
                                  <button type="submit" class="btn btn-success btn-sm">Confirmer</button>
                              </form>
                            @else
                                <form action="{{ route('resa.imprimerReçu', $reservation->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Imprimer Reçu</button>
                                </form>
                          @endif
                      </td>
                  </tr>
                  @empty
                  <tr>
                      <td colspan="5" class="text-center">Aucune réservation trouvée</td>
                  </tr>
                  @endforelse

            </tbody>
        </table>


        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $reservations->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $reservations->previousPageUrl() . request()->getQueryString() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @for ($i = 1; $i <= $reservations->lastPage(); $i++)
                    <li class="page-item {{ $reservations->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $reservations->url($i) . request()->getQueryString() }}">{{ $i }}</a>
                    </li>
                @endfor

                <li class="page-item {{ $reservations->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $reservations->nextPageUrl() . request()->getQueryString() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

        

        
    </div>


@endsection