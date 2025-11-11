<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Modifier Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Custom CSS for the form */
        .modal-dialog {
            max-width: 800px; /* Wider modal */
        }

        .modal-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .input-field {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .input-field:focus {
            border-color: #007bff;
            outline: none;
        }

        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .image-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%; /* Rounded shape */
            object-fit: cover;
            border: 2px solid #131414;
        }

        .image-container input[type="file"] {
            display: none; /* Hide the default file input */
        }

        .image-container label {
            display: block;
            margin-top: 10px;
            color: #007bff;
            cursor: pointer;
        }

        .image-container label:hover {
            text-decoration: underline;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffeeba;
            color: #856404;
        }
    </style>
</head>
<body>
 
    <div class="modal fade" id="editEmpModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier un employé</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editEmpForm" action="/updateEmp" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="alert alert-warning d-none" id="edit_errorList"></div>
                        @csrf
                        <input type="hidden" id="emp_id" name="id">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Image Field -->
                                <div class="image-container">
                                    <img id="currentImage" src="" alt="Current Image" style="display: none;">
                                    <label for="imageUpload">Changer l'image</label>
                                    <input type="file" name="imageE" id="imageUpload" class="course form-control">
                                </div>

                                <!-- Other Fields -->
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" name="nom" id="firstName" class="input-field" placeholder="Entrez le nom">
                                </div>
                                <div class="form-group">
                                    <label>Prénom</label>
                                    <input type="text" name="prenom" id="lastName" class="input-field" placeholder="Entrez le prénom">
                                    <input type="hidden" name="_method" value="POST">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="input-field" placeholder="exemple@entreprise.com">
                                </div>
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" name="mdp" id="mdp" class="input-field" placeholder="*******">
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input type="tel" name="tel" id="tel" class="input-field" placeholder="Entrez votre numéro de téléphone">
                                </div>
                                <div class="form-group">
                                    <label>Matricule</label>
                                    <input type="text" name="matricule" id="mat" class="input-field" placeholder="Entrez le matricule">
                                </div>
                                <div class="form-group">
                                    <label>Date de naissance</label>
                                    <input type="text" name="date_naissance" id="birthDate" class="input-field" placeholder="YYYY-MM-DD">
                                </div>
                                <div class="form-group">
                                    <label>Lieu de naissance</label>
                                    <input type="text" name="lieu_naissance" id="birthPlace" class="input-field" placeholder="Entrez le lieu de naissance">
                                </div>
                                <div class="form-group">
                                    <label>Rôle</label>
                                    <input type="text" name="role" id="role" class="input-field" placeholder="Entrez le rôle">
                                </div>
                                <div class="form-group">
                                    <label>Département</label>
                                    <input type="text" name="departement" id="dep" class="input-field" placeholder="Entrez le département">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" value="">Editer</button>
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
            // Fetch and populate employee data
            $(document).on('click', '.edit-emp-btn', function(e){
                e.preventDefault();
                var empId = $(this).data('id');
                $('#editEmpModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/employe/" + empId,
                    success: function(response){
                        if(response.status == 404){
                            alert(response.message);
                            $('#editEmpModal').modal('hide');
                        } else {
                            $('#firstName').val(response.employe.nom);
                            $('#lastName').val(response.employe.prenom);
                            $('#email').val(response.employe.email);
                            $('#mdp').val(response.employe.mdp);
                            $('#tel').val(response.employe.tel);
                            $('#mat').val(response.employe.matricule);
                            $('#birthDate').val(response.employe.date_naissance);
                            $('#birthPlace').val(response.employe.lieu_naissance);
                            $('#role').val(response.employe.role);
                            $('#dep').val(response.employe.departement);
                            $('#emp_id').val(response.employe.id_emp);

                            // Display the current image
                            if (response.employe.imageE) {
                                $('#currentImage').attr('src', '/uploads/employeImg/' + response.employe.imageE);
                                $('#currentImage').show();
                            } else {
                                $('#currentImage').hide();
                            }
                        }
                    }
                });
            });

            // Submit the form
            $(document).on('submit', '#editEmpForm', function(e){
                e.preventDefault();
                var Id = $('#emp_id').val();
                let EditformData = new FormData($('#editEmpForm')[0]);
                EditformData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    type: "POST",
                    url: "/updateEmp/" + Id,
                    data: EditformData,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        if(response.status == 400){
                            $('#edit_errorList').html("");
                            $('#edit_errorList').removeClass('d-none');
                            $.each(response.errors, function (key, err_value){
                                $('#edit_errorList').append('<li>' + err_value + '</li>');
                            });
                        } else if (response.status == 404){
                            alert(response.message);
                        } else if (response.status == 200){
                            $('#edit_errorList').html("");
                            $('#edit_errorList').addClass('d-none');
                            $('#editEmpModal').modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                            alert(response.message);
                            FetchEmp();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
