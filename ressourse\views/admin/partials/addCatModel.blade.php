
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ajouter emp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   

</head>

<body>
    <div class="modal fade" id="addCatModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une Catégorie</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addCatForm" action="/addCat" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="alert alert-warning d-none" id="save_errorList-cat"></div>
                @csrf
                <input type="hidden" id="Catid" name="id">
                <div class="form-group">
                  <label>Nom</label>
                  <input type="text" name="nomC" id="nomC" class="input-field">
                </div>
                <div class="form-group">
                  <label>Image</label>
                  <input type="file" name="imageC" class="course form-control">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
      <script>
     $(document).ready(function(){
        FetchCat();
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            // Script pour soumettre la modification
            $(document).on('submit','#addCatForm', function(e) {
                e.preventDefault();
        
                let foormData = new FormData($('#addCatForm')[0]);
                let CatId = $('#CatId').val();
                
                $.ajax({
                    type: "POST",
                    url: "/addCat" ,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: foormData,
                    processData: false, // Ne pas traiter les données
                    contentType: false, // Ne pas ajouter d’en-tête Content-Type
                    success: function(response){
                        if(response.status == 400){
                        
                        $('#save_errorList-cat').html("");
                        $('#save_errorList-cat').removeClass('d-none');

                        $.each(response.errors, function (key, err_value){
    
                            $('#save_errorList-cat').append('<li>' + err_value + '</li>');
                        });
                        }else if(response.status == 200 ){
                            $('#save_errorList-cat').html("");
                            $('#save_errorList-cat').addClass('d-none');
                        
                            $('#addCatForm').find('input').val('');// clear the fields 
                            $('#addCatModal').modal('hide');

                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();

                            $('body').css('overflow', 'auto'); 
 
                            alert(response.message);
                            FetchCat();
                           
                        }
                    },
                
                });
            });
           
        });
    </script>  
    
    
    
    
    
    
   
</body>
</html>
