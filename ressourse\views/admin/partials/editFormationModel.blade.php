
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="modal fade" id="editFormationModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier une Formation</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editformationForm" action="/updateFormation" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="alert alert-warning d-none" id="edit_errorList-formation"></div>
                @csrf
                <input type="hidden" id="formation_id" name="id">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nom</label>
                      <input type="text" name="nomF" id="nomf" class="input-field">
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="description" id="descriptionF" class="input-field"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Nom Formateur</label>
                      <input type="text" name="nom_formateur" id="nom_formateurF" class="input-field">
                    </div>
                  </div>

                 <div class="col-md-6">
                    <div class="form-group">
                      <label>Date et Heure de Début</label>
                      <input type="datetime-local" name="date_debut" id="date_debutF" class="input-field">
                    </div>
                    <div class="form-group">
                      <label>Date et Heure de Fin</label>
                      <input type="datetime-local" name="date_fin" id="date_finF" class="input-field">
                    </div>
                    <div class="form-group">
                      <label>Capacité</label>
                      <input type="text" name="capacite" id="capaciteF" class="input-field">
                    </div>
                    <div class="form-group">
                      <label>Catégorie</label>
                      <select name="categorie_id" id="categorie_idF" class="input-field">
                        <option value="">Chargement en cours...</option>
                      </select>
                     
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
  <script  src="{{ asset('js/jquery.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/admin.js') }}"></script>
  <script>
  $(document).ready(function(){
      // Lorsqu'on clique sur le bouton Editer
      $(document).on('click','.edit-formation-btn', function(e){
          e.preventDefault();

          var formationId = $(this).data('id');  // Récupérer l'ID
          
          $('#editFormationModal').modal('show');

          FetchCat('', '#categorie_idF');

          $.ajax({
              type: "GET",
              url: "/formation/" + formationId , // Récupérer les données de l'employé
              
              success: function(response){
              
                  if(response.status == 404){
                      alert(response.message);
                      $('#editFormationModal').modal('hide');
                  }else { 
                      $('#nomf').val(response.formation.nom);
                      $('#formation_id').val(response.formation.id);
                      $('#descriptionF').val(response.formation.description);
                        $('#nom_formateurF').val(response.formation.nom_formateur);
                        $('#date_debutF').val(response.formation.date_debut);
                        $('#date_finF').val(response.formation.date_fin);
                        $('#capaciteF').val(response.formation.capacite);
                        setTimeout(() => {
                                            $('#categorie_idF').val(response.formation.categorie_id);
                                        }, 200); 

                 
                    }
              },
          });

      });
  
      // Script pour soumettre la modification
      $(document).on('submit','#editformationForm', function(e){
          e.preventDefault();
  
          var Id = $('#formation_id').val();
         
        
          let EditformData = new FormData($('#editformationForm')[0]);
          EditformData.append('_token', '{{ csrf_token() }}');
          $.ajax({
              type: "POST",
              url: "/updateFormation/" + Id,
              data: EditformData ,
              processData: false, // Ne pas traiter les données
              contentType: false, // Ne pas ajouter d’en-tête Content-Type
              success: function(response){
               
                  if(response.status == 400){//the valisators one 
                      
                      $('#edit_errorList-formation').html("");
                      $('#edit_errorList-formation').removeClass('d-none');

                      $.each(response.errors, function (key, err_value){
                              $('#edit_errorList-formation').append('<li>' + err_value + '</li>');
                          });

                  }else if (response.status == 404){// if not found 
                     alert(response.message);
                  }
                  else if (response.status == 200){
                      $('#edit_errorList-formation').html("");
                      $('#edit_errorList-formation').addClass('d-none');
                 
                      $('#editFormationModal').modal('hide');
                      $('body').removeClass('modal-open');
                      $('.modal-backdrop').remove();
                      $('body').removeClass('modal-open').css('overflow', 'auto'); 
                      alert(response.message);
                      FetchFormation();
                         
                  }
              },
             
          });
      });
  });
  </script>
  
