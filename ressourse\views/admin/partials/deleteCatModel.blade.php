<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
  </head>
  <body>
    <div class="modal fade" id="deleteCatModal" tabindex="-1" aria-labelledby="exampleModalLabel" insert>
        <div class="modal-dialog">
          <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Supprimer un employé</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
    
             <form id="deleteCatForm" method="DELETE" enctype="multipart/form-data" >
                @csrf

                 <div class="modal-body">
                       
                        <h5>Etes-vous sure de vouloir supprimer ?</h5>
                        <input type="hidden" id="cat-id" name="id">
                        
                        
                 </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="confirm-categorie-delete btn btn-primary"  value="">Supprimer</button>
                    </div>
               </form>
            </div> 
        </div> 
    </div> 
    <script  src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script>
        //to display the modal 
    $(document).on('click','.delete-cat-btn',function(e){
     e.preventDefault();
      var cat_id=$(this).data('id');
     
      $('#deleteCatModal').modal('show');
      $('#cat-id').val(cat_id);
    });

    //to delete the data 
    $(document).on('click','.confirm-categorie-delete',function(e){
        e.preventDefault();
        var id=$('#cat-id').val();
       

        $.ajax({
            type: "DELETE",
            url: "/deleteCat/" + id,
            data: {
                _token: "{{ csrf_token() }}"
            },
            dataType:"json",
            success: function(response){
                if(response.status == 404){
                    alert(response.message);
                    $('#deleteCatModal').modal('hide');
                }else if(response.status == 200){

                    FetchCat();
                    $('#deleteCatModal').modal('hide');
                    alert(response.message);
                  
                }
            },
            
        });
    });
    </script>
