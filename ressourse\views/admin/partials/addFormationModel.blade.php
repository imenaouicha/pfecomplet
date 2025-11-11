<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ajouter Formation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
</head>
<body>
 
    <!-- Modal for Add Formation -->
    <div class="modal fade" id="addFormationModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une formation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addFormationForm" action="/addFormation" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="alert alert-warning d-none" id="save_errorList-formation"></div>
                        @csrf
                        <input type="hidden" id="formId" name="id">
                        <div class="two-column-layout">
                            <div class="column">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" name="nom" id="Name" class="input-field">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" id="description" class="input-field"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nom Formateur</label>
                                    <input type="text" name="nom_formateur" id="nom_formateur" class="input-field">
                                </div>
                            </div>
                            <div class="column">
                                <div class="form-group">
                                    <label>Date et Heure de Début</label>
                                    <input type="datetime-local" name="date_debut" id="date_debut" class="input-field">
                                </div>
                                <div class="form-group">
                                    <label>Date et Heure de Fin</label>
                                    <input type="datetime-local" name="date_fin" id="date_fin" class="input-field">
                                </div>
                                <div class="form-group">
                                    <label>Capacité</label>
                                    <input type="text" name="capacite" id="capacite" class="input-field" placeholder="par personne">
                                </div>
                                <div class="form-group">
                                    <label for="categorie_id">Catégorie</label>
                                    <select name="categorie_id" id="categorie_id" class="input-field">
                                        <option value="">Chargement en cours...</option></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" value="">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script>
        $(document).ready(function(){
            FetchFormation();
            FetchCat('');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#addFormationModal').on('show.bs.modal', function() {
                if ($('#categorie_id option').length <= 1) { // Only reload if empty
                    FetchCat('');
                }
            });

            // Script pour soumettre la modification
            $(document).on('submit','#addFormationForm', function(e) {
                e.preventDefault();

                let formData = new FormData($('#addFormationForm')[0]);
                let formId = $('#formId').val();
                console.log(formId);

                $.ajax({
                    type: "POST",
                    url: "/addFormation",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false, // Ne pas traiter les données
                    contentType: false, // Ne pas ajouter d’en-tête Content-Type
                    success: function(response){
                        console.log('Dropdown element:', $('#categorie_id').length); 
                        if(response.status == 400){
                            $('#save_errorList-formation').html("");
                            $('#save_errorList-formation').removeClass('d-none');

                            $.each(response.errors, function (key, err_value){
                                $('#save_errorList-formation').append('<li>' + err_value + '</li>');
                            });
                        } else if(response.status == 200){
                            $('#save_errorList-formation').html("");
                            $('#save_errorList-formation').addClass('d-none');

                            $('#addFormationForm').find('input').val(''); // Clear the fields
                            $('#addFormationModal').modal('hide');

                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();

                            $('body').css('overflow', 'auto');

                            alert(response.message);
                            FetchFormation();
                        }
                    },
                });
            });
        });
    </script>
</body>
</html>
