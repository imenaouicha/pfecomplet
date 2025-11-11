<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<!-- View Employé Modal -->
<div class="modal fade" id="viewEmployeModal" tabindex="-1" aria-labelledby="viewEmployeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails de l'Employé</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5><strong>Matricule:</strong></h5>
                            <p id="view-matricule"></p>
                        </div>
                        <div class="col-md-6">
                            <h5><strong>Lieu de Naissance:</strong></h5>
                            <p id="view-lieu-naissance"></p>
                        </div>
                      
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5><strong>Prénom:</strong></h5>
                            <p id="view-prenom"></p>
                        </div>
                        <div class="col-md-6">
                            <h5><strong>Date de Naissance:</strong></h5>
                            <p id="view-date-naissance"></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5><strong>Nom:</strong></h5>
                            <p id="view-nomE"></p>
                        </div>
                        <div class="col-md-6">
                            <h5><strong>Département:</strong></h5>
                            <p id="view-departement"></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5><strong>Email:</strong></h5>
                            <p id="view-email"></p>
                        </div>
                        <div class="col-md-6">
                            <h5><strong>Téléphone:</strong></h5>
                            <p id="view-tel"></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5><strong>Rôle:</strong></h5>
                            <p id="view-role"></p>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        // View Employé Details
        $(document).on('click', '.view-emp-btn', function(e){
            e.preventDefault();
            var employeId = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "/employe/" + employeId,
                success: function(response) {
                    if(response.status == 404) {
                        alert(response.message);
                    } else {
                        const formatDate = (dateString) => {
                            return new Date(dateString).toLocaleDateString('fr-FR', {
                                year: 'numeric', month: 'long', day: 'numeric'
                            });
                        };

                        $('#view-matricule').text(response.employe.matricule);
                        $('#view-nomE').text(response.employe.nom);
                        $('#view-prenom').text(response.employe.prenom);
                        $('#view-date-naissance').text(formatDate(response.employe.date_naissance));
                        $('#view-lieu-naissance').text(response.employe.lieu_naissance || 'N/A');
                        $('#view-departement').text(response.employe.departement);
                        $('#view-email').text(response.employe.email);
                        $('#view-tel').text(response.employe.tel);
                        $('#view-role').text(response.employe.role);
                       
                        $('#viewEmployeModal').modal('show');
                    }
                },
                error: function() {
                    alert("Erreur lors de la récupération des détails de l'employé.");
                }
            });
        });
    });
</script>

</body>
</html>
