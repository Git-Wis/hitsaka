@extends('dashboard')

@Section('dasboard_containte')
 
 
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

@endsection