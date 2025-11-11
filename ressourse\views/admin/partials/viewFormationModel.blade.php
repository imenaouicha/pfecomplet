<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="modal fade" id="viewFormationModal" tabindex="-1" aria-labelledby="viewFormationModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewFormationModalLabel">Détails de la Formation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h4><strong>Nom:</strong></h4>
                                <p id="view-nom"></p>
                            </div>
                            <div class="col-md-6">
                                <h4><strong>Catégorie:</strong></h4>
                                <p id="view-categorie"></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h4><strong>Formateur:</strong></h4>
                                <p id="view-formateur"></p>
                            </div>
                            <div class="col-md-6">
                                <h4><strong>Capacité:</strong></h4>
                                <p id="view-capacite"></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h4><strong>Date de début:</strong></h4>
                                <p id="view-date-debut"></p>
                            </div>
                            <div class="col-md-6">
                                <h4><strong>Date de fin:</strong></h4>
                                <p id="view-date-fin"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4><strong>Description:</strong></h4>
                                <p id="view-description" class="text-justify"></p>
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
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    
<script>
    $(document).ready(function(){
    // View Formation Details
    $(document).on('click', '.view-formation-btn', function(e) {
        e.preventDefault();
        
        var formationId = $(this).data('id');
        
        $.ajax({
            type: "GET",
            url: "/formation/" + formationId,
            success: function(response) {
                if(response.status == 404) {
                    console.log('4O4');
                    alert(response.message);
                    modal.hide(); 
                } else {
                    console.log('200');
                    // Format dates for display
                    const formatDate = (dateString) => {
                        const options = { 
                            year: 'numeric', 
                            month: 'long', 
                            day: 'numeric',
                            hour: '2-digit', 
                            minute: '2-digit' 
                        };
                        return new Date(dateString).toLocaleDateString('fr-FR', options);
                    };
                    
                    // Populate modal fields
                    $('#view-nom').text(response.formation.nom);
                    $('#view-categorie').text(response.formation.categorie ? response.formation.categorie.nom : 'Non classé');
                    $('#view-formateur').text(response.formation.nom_formateur);
                    $('#view-description').text(response.formation.description);
                    $('#view-capacite').text(response.formation.capacite);
                    $('#view-date-debut').text(formatDate(response.formation.date_debut));
                    $('#view-date-fin').text(formatDate(response.formation.date_fin));
                 
                    
                    
                }
            },
            error: function() {
                alert("Erreur lors de la récupération des détails de la formation");
            }
        });
    });
});
</script>
</body>
</html><!-- View Formation Modal -->
