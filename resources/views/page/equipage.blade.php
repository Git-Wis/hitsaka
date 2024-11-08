@extends('dashboard')

@Section('dasboard_containte')

<div class="container my-4">
    <h1 class="text-center mb-4">Gestion des Équipages</h1>
        <div class="row mb-4">
            <div class="col-12 col-md-4 mb-3">
                <div class="card text-white bg-primary h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Personelle</h5>
                        <p class="card-text">{{0}}</p>
                    </div>
                </div>
            </div>
    
            <div class="col-12 col-md-4 mb-3">
                <div class="card text-white bg-success h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Present</h5>
                        <p class="card-text">{{0}}</p>
                    </div>
                </div>
            </div>
    
            <div class="col-12 col-md-4 mb-3">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total En congé</h5>
                        <p class="card-text">{{0}}</p>
                    </div>
                </div>
            </div>
        </div>


    <div class="card mb-4"> 
        <div class="card-header">
            <h2>Gestion des Équipiers</h2>
        </div> 
            
        <div class="card-body">
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addTeamMemberModal">Ajouter un Équipier</button>
            <table class="table table-striped"> 
                <thead> 
                    <tr> 
                        <th>Nom</th> 
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr> 
                </thead>
            
                <tbody> 
                <!-- Exemple de membre --> 
                    <tr> 
                        <td>Jean Dupont</td>
                        <td>Capitaine</td> 
                        <td> <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editMemberModal1">Modifier</button>
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?');">Supprimer</button> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


     <!-- Suivi des Horaires --> 
    <div class="card mb-4"> 
        <div class="card-header"> 
            <h2>Suivi des Horaires</h2> 
        </div>
    
        <div class="card-body">
            <h4>Planning de Navigation</h4>
            <table class="table table-bordered"> 
                <thead> 
                    <tr>
                        <th>Membre</th> 
                        <th>Horaires de Travail</th> 
                        <th>Horaires de Repos</th> 
                    </tr> 
                </thead> 
                <tbody>
                    <tr> 
                        <td>Jean Dupont</td>
                        <td>08:00 - 16:00</td> 
                        <td>16:00 - 08:00</td>
                    </tr>
                </tbody> 

                </table>
                
            <h4>Historique des Embarquements</h4> 
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Membre</th> 
                        <th>Date</th>
                        <th>Destination</th> 
                    </tr>
                </thead> 
                <tbody>
        
                    <tr> 
                        <td>Jean Dupont</td> 
                        <td>2023-10-15</td>
                        <td>Sainte-Marie</td>
                    </tr>
                </tbody> 
            </table>
        </div> 
    </div>
    
            
        <!-- Fonctionnalités principales -->
        <div class="row">

            <!-- Liste des equipages -->
            <div class="col-md-4 mb-3">
                <div class="card ">
                    <div class="card-body">
                        <h5 class="card-title">Liste des equipages</h5>
                        <p class="card-text">Affichez la liste des equipages et leurs fonctions respectifs.</p>
                        <button class="btn btn-primary btn-block ">Accéder</button>
                    </div>
                </div>
            </div>

            <!-- Recrutement et Sélection -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recrutement et Sélection</h5>
                        <p class="card-text">Gérez le recrutement des equipages et sélectionnez les meilleurs candidats.</p>
                        <button class="btn btn-primary btn-block">Accéder</button>
                    </div>
                </div>
            </div>

            <!-- Formation -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Formation</h5>
                        <p class="card-text">Organisez des sessions de formation pour les marins selon les normes.</p>
                        <button class="btn btn-success btn-block">Accéder</button>
                    </div>
                </div>
            </div>

            <!-- Embauche et Contrats -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Embauche et Contrats</h5>
                        <p class="card-text">Gérez les contrats de travail, les formalités administratives, et les visas.</p>
                        <button class="btn btn-warning btn-block">Accéder</button>
                    </div>
                </div>
            </div>

            <!-- Affectation -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Affectation</h5>
                        <p class="card-text">Assignez les marins aux différents navires selon leurs compétences.</p>
                        <button class="btn btn-info btn-block">Accéder</button>
                    </div>
                </div>
            </div>

            <!-- Gestion des Rotations -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Rotations</h5>
                        <p class="card-text">Organisez les rotations pour assurer la continuité des opérations.</p>
                        <button class="btn btn-secondary btn-block">Accéder</button>
                    </div>
                </div>
            </div>

            <!-- Paie et Avantages Sociaux -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Paie et Avantages Sociaux</h5>
                        <p class="card-text">Gérez la paie des equipages, les cotisations sociales, et les avantages sociaux.</p>
                        <button class="btn btn-danger btn-block">Accéder</button>
                    </div>
                </div>
            </div>

            <!-- Gestion des Carrières -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Carrières</h5>
                        <p class="card-text">Accompagnez les marins dans leur développement professionnel.</p>
                        <button class="btn btn-dark btn-block">Accéder</button>
                    </div>
                </div>
            </div>

            <!-- Compliance -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Conformité (Compliance)</h5>
                        <p class="card-text">Assurez le respect des réglementations internationales et nationales.</p>
                        <button class="btn btn-primary btn-block">Accéder</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>

@endsection