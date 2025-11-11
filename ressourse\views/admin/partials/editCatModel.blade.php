<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Modifier Catégorie</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <!-- Modal for Edit Catégorie -->
  <div class="modal fade" id="editCatModal" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier une Catégorie</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editCatForm" action="/updateCat" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="alert alert-warning d-none" id="edit_errorList-cat"></div>
            @csrf
            <input type="hidden" id="cat_id" name="id">
            <div class="image-container">
              <img id="currentImage-cat" src="" alt="Current Image" style="display: none;">
              <label for="imageUpload-cat">Changer l'image</label>
              <input type="file" name="imageC" id="imageUpload-cat" class="course form-control">
            </div>
            <div class="form-group">
              <label>Nom</label>
              <input type="text" name="nomC" id="nomc" class="input-field">
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
      // Lorsqu'on clique sur le bouton Editer
      $(document).on('click', '.edit-cat-btn', function(e){
        e.preventDefault();

        var catId = $(this).data('id');  // Récupérer l'ID
        $('#editCatModal').modal('show');

        $.ajax({
          type: "GET",
          url: "/categorie/" + catId, // Récupérer les données de la catégorie
          success: function(response){
            if(response.status == 404){
              alert(response.message);
              $('#editCatModal').modal('hide');
            } else {
              $('#nomc').val(response.categorie.nom);
              $('#cat_id').val(response.categorie.id);
              if (response.categorie.imageC) {
                $('#currentImage-cat').attr('src', '/uploads/categorieImg/' + response.categorie.imageC);
                $('#currentImage-cat').show(); // Show the image
              } else {
                $('#currentImage-cat').hide(); // Hide the image if none exists
              }
            }
          },
        });
      });

      // Script pour soumettre la modification
      $(document).on('submit', '#editCatForm', function(e){
        e.preventDefault();

        var Id = $('#cat_id').val();
        let EditformData = new FormData($('#editCatForm')[0]);
        EditformData.append('_token', '{{ csrf_token() }}');

        $.ajax({
          type: "POST",
          url: "/updateCat/" + Id,
          data: EditformData,
          processData: false, // Ne pas traiter les données
          contentType: false, // Ne pas ajouter d’en-tête Content-Type
          success: function(response){
            console.log("Response from updateCat:", response);
            if(response.status == 400){ // Validation errors
              $('#edit_errorList-cat').html(""); // Clear previous errors
              $('#edit_errorList-cat').removeClass('d-none');

              $.each(response.errors, function (key, err_value){
                $('#edit_errorList-cat').append('<li>' + err_value + '</li>');
              });
            } else if (response.status == 404){ // If not found
              alert(response.message);
            } else if (response.status == 200){ // Success
              $('#edit_errorList-cat').html("");
              $('#edit_errorList-cat').addClass('d-none');

              $('#editCatModal').modal('hide');
              $('body').removeClass('modal-open');
              $('.modal-backdrop').remove();
              $('body').css('overflow', 'auto');

              alert(response.message);
              FetchCat(); // Ensure this function is defined
            }
          },
        });
      });

      // Fix for backdrop not disappearing when modal is closed
      $('#editCatModal').on('hidden.bs.modal', function () {
        $('.modal-backdrop').remove(); // Remove the backdrop
        $('body').removeClass('modal-open'); // Remove the modal-open class
        $('body').css('overflow', 'auto'); // Restore scrolling
      });
    });
  </script>
</body>
</html>
