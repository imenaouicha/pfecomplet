<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ajouter Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
</head>
<body>
   
    <!-- Modal for Add Employé -->
    <div class="modal fade" id="addEmpModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un employé</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addEmpForm" action="/addEmp" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="alert alert-warning d-none" id="save_errorList"></div>
                        @csrf
                        <input type="hidden" id="empId" name="id">
                        <div class="two-column-layout">
                            <!-- Left Column -->
                            <div class="column">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" name="nom" id="FirstName" class="input-field">
                                </div>
                                <div class="form-group">
                                    <label>Prénom</label>
                                    <input type="text" name="prenom" id="LastName" class="input-field">
                                    <input type="hidden" name="_method" value="POST">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="Email" class="input-field">
                                </div>
                                <div class="form-group">
                                    <label>Mot de Passe</label>
                                    <input type="password" name="mdp" id="Mdp" class="input-field">
                                </div>
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input type="tel" name="tel" id="Tel" class="input-field">
                                </div>
                            </div>
                            <!-- Right Column -->
                            <div class="column">
                                <div class="form-group">
                                    <label>Matricule</label>
                                    <input type="text" name="matricule" id="Mat" class="input-field">
                                </div>
                                <div class="form-group">
                                    <label>Date de Naissance</label>
                                    <input type="text" name="date_naissance" id="BirthDate" class="input-field" placeholder="YYYY-MM-DD">
                                </div>
                                <div class="form-group">
                                    <label>Lieu de Naissance</label>
                                    <input type="text" name="lieu_naissance" id="BirthPlace" class="input-field">
                                </div>
                                <div class="form-group">
                                    <label>Rôle</label>
                                    <select name="role" id="Role" class="input-field">
                                        <option value="">Sélectionnez un rôle</option>
                                        <option value="employe">Employé</option>
                                        <option value="responsable">Responsable</option>
                                        <option value="administrateur">Administrateur</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Département</label>
                                    <input type="text" name="departement" id="Dep" class="input-field">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="imageE" class="course form-control">
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
            FetchEmp();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Script pour soumettre la modification
            $(document).on('submit','#addEmpForm', function(e) {
                e.preventDefault();

                let formData = new FormData($('#addEmpForm')[0]);
                let empId = $('#empId').val();

                $.ajax({
                    type: "POST",
                    url: "/addEmp",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false, // Ne pas traiter les données
                    contentType: false, // Ne pas ajouter d’en-tête Content-Type
                    success: function(response){
                        if(response.status == 400){
                            $('#save_errorList').html("");
                            $('#save_errorList').removeClass('d-none');

                            $.each(response.errors, function (key, err_value){
                                $('#save_errorList').append('<li>' + err_value + '</li>');
                            });
                        } else if(response.status == 200){
                            $('#save_errorList').html("");
                            $('#save_errorList').addClass('d-none');

                            $('#addEmpForm').find('input').val(''); // Clear the fields
                            $('#addEmpModal').modal('hide');

                            document.activeElement.blur();
                            $('.modal-backdrop').remove();
                            $('body').removeClass('modal-open');
                            $('body').css('overflow', 'auto');

                            alert(response.message);
                            FetchEmp();
                        }
                    },
                });
            });
        });
    </script>
</body>
</html>
