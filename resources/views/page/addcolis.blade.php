@extends('dashboard')

@Section('dasboard_containte')

<div class="container">
    <div class="row flex justify-center">
        <!-- Colonne droite: Bouton pour ouvrir le formulaire d'envoi de colis dans une modale -->
        <div class="col right-0">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#envoiColisModal">
                Envoyer un colis
            </button>
        </div>
    </div>
    <div class="row">
        <!-- Colonne gauche: Liste des colis avec filtrage -->
        <div class="col mt-3" style="max-height: 80vh; overflow-y: auto;">
            <h2 class="mb-4">Liste des Colis</h2>

            <!-- Filtres de recherche -->
            <form method="GET" action="{{route('colis.index')}}">
                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="filter_date" class="form-label">Date d'envoi</label>
                        <input type="date" class="form-control" id="filter_date" name="filter_date" />
                    </div>
                    <div class="col-md-5">
                        <label for="filter_destination" class="form-label">Destination</label>
                        <select name="filter_destination" id="filter_destination" class="form-select">
                            <option value="">Tous</option>
                            <option value="TMV-SM">TMV-SM</option>
                            <option value="SM-TMV">SM-TMV</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-secondary mb-3">Filtrer</button>
                    </div>
                </div>
            </form>

            <!-- Liste des colis -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Expéditeur</th>
                        <th>Destinataire</th>
                        <th>Destination</th>
                        <th>Date d'envoi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($colis as $Coli)
                        <tr>
                            <td>{{$Coli->num_colis}}</td>
                            <td>{{$Coli->destinataires->name ?? 'N/A'}}</td>
                            <td>{{$Coli->expeditaires->name ?? 'N/A'}}</td>
                            <td>{{$Coli->direction}}</td>
                            <td>{{$Coli->date_envoi}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucun colis trouvée</td>
                        </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>  

    </div>
</div>

<!-- Modale pour l'envoi de colis -->
<div class="modal fade bg-bg-dark" id="envoiColisModal" tabindex="-1" aria-labelledby="envoiColisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="envoiColisModalLabel">Envoyer un colis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('colis.store') }}" method="POST">
                    @csrf

                    <!-- Destination -->
                    <div class="mb-3">
                        <label for="trajet" class="form-label">La destination du colis</label>
                        <select name="trajet" id="trajet" class="form-select" required>
                            <option value="TMV-SM">TMV-SM</option>
                            <option value="SM-TMV">SM-TMV</option>
                        </select>
                    </div>

                    <div class="row">
                        <!-- Information Expéditeur -->
                        <div class="col-md-6">
                            <h5>Informations de l'Expéditeur</h5>
                            <div class="mb-3">
                                <label for="expediteur" class="form-label">Nom complet de l'expéditeur</label>
                                <input type="text" class="form-control" id="expediteur" name="expediteur" placeholder="Nom complet" required />
                            </div>
                            <div class="mb-3">
                                <label for="expediteur_mail" class="form-label">E-mail de l'expéditeur</label>
                                <input type="email" class="form-control" id="expediteur_mail" name="expediteur_mail" placeholder="E-mail" required />
                            </div>
                        </div>

                        <!-- Information Destinataire -->
                        <div class="col-md-6">
                            <h5>Informations du Destinataire</h5>
                            <div class="mb-3">
                                <label for="destinataire" class="form-label">Nom complet du destinataire</label>
                                <input type="text" class="form-control" id="destinataire" name="destinataire" placeholder="Nom complet" required />
                            </div>
                            <div class="mb-3">
                                <label for="destinataire_mail" class="form-label">E-mail du destinataire</label>
                                <input type="email" class="form-control" id="destinataire_mail" name="destinataire_mail" placeholder="E-mail" required />
                            </div>
                            <div class="mb-3">
                                <label for="destinataire_tel" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="destinataire_tel" name="destinataire_tel" value="+261" placeholder="Ex: +261 34 12 345 67" required />
                            </div>
                        </div>
                    </div>

                    <!-- Adresse du destinataire -->
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse Destinataire</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="L'adresse principale du destinataire" />
                    </div>

                    <!-- Poids et Type du colis -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="poids" class="form-label">Poids en KG</label>
                                <input type="number" class="form-control" id="poids" name="poids" placeholder="Poids du colis en KG" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Type du colis</label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="papier">Papier</option>
                                    <option value="fragile">Fragile</option>
                                    <option value="bagage">Bagage</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection