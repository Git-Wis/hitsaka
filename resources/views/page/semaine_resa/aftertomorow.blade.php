@extends('dashboard')

@Section('dasboard_containte')
    <div class="container mt-5">
        <h1 class="mb-4">Liste des Réservations d'aujourd'hui</h1>

         @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         @endif

        <!-- Filtres -->
        <form method="GET" action="{{ route('resa.semaine_resa',3) }}" class="mb-4">
            <div class="row">
                
                <div class="col-md-3">
                    <label for="direction" class="form-label">Direction</label>
                    <select name="direction" class="form-select" id="direction">
                        <option value="">Toutes</option>
                        <option value="TMV-SM" {{ request('direction') == 'TMV-SM' ? 'selected' : '' }}>TMV-SM</option>
                        <option value="SM-TMV" {{ request('direction') == 'SM-TMV' ? 'selected' : '' }}>SM-TMV</option>
                    </select>
                </div>
                
                <div class="col-md-3 mt-4">
                    <button type="submit" class="btn btn-primary mt-2">Filtrer</button>
                </div>
            </div>
        </form>

        <!-- Tableau des réservations -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom du client</th>
                    <th>Direction</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>

                <!-- afficher les reservation par rapport au filtre selection -->

                @forelse($reservations as $reservation)
                  <tr>
                      <td>{{ $reservation->passage->name }}</td>
                      <td>{{ $reservation->direction }}</td>
                      <td>
                       
                        @if (!$reservation->payer)
                            <span class="badge bg-warning">Non confirmé</span>      
                        @else
                            <span class="badge bg-success">Confirmé</span>
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

        
    </div>


@endsection