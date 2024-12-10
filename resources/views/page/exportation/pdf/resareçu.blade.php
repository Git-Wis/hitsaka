@extends('layouts.impression')

@Section('impression_containte')


    <div class="bg-light text-dark p-4 rounded shadow-lg mx-auto mt-4" style="max-width: 28rem; border: 1px solid #ddd;">
        <!-- En-tête -->
        <div class="text-center mb-4">
            <h2 class="h4 fw-bold mb-2">Reçu de Paiement</h2>
            <p class="small text-muted mb-0">Confirmation de réservation</p>
        </div>

        <!-- Détails de la réservation -->
        <div class="mb-4">
            <h5 class="text-primary mb-2">Détails de la Réservation</h5>
            <p class="small mb-1">
                <strong>Nom et Prénom :</strong> {{ $reservation->passage->name }}
            </p>
            <p class="small mb-1">
                <strong>Date :</strong> {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
            </p>
            <p class="small mb-1">
                <strong>Direction :</strong> {{ $reservation->direction }}
            </p>
            <p class="small mb-0">
                <strong>Numéro de Réservation :</strong> #{{ $reservation->id }}
            </p>
        </div>

        <!-- Paiement -->
        <div class="mb-4">
            <h5 class="text-primary mb-2">Détails du Paiement</h5>
            <p class="small mb-1">
                <strong>Montant Total :</strong> <span class="fw-bold text-warning">65 000,00 AR</span>
            </p>
            <p class="small mb-0">
                <strong>Statut :</strong> <span class="fw-bold text-success">Payé</span>
            </p>
        </div>

        <!-- Code-barres -->
        <div class="text-center my-4">
            <img src="{{ $barcodeBase64 }}" alt="Code-barres" class="img-fluid" style="max-width: 200px; height: auto;" />
        </div>

        <!-- Note de remerciement -->
        <div class="text-center mt-4">
            <p class="small text-muted fst-italic">Merci d'avoir choisi nos services.<br>Nous vous souhaitons un agréable voyage !</p>
        </div>
    </div>

    
@endsection