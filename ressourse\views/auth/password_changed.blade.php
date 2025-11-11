<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Mot de passe changé | Administration</title>
</head>
<body>
  <div class="wrapper">
    <div class="container main">
        <div class="row" id="mainRow">
            <div class="col-md-6 side-image"></div>
            <div class="col-md-6 right">
                <div class="input-box">
                   <header>
                       <i class="fas fa-check-circle success-icon"></i>
                       <div>Mot de passe changé</div>
                   </header>
                   
                   @if(session('success'))
                   <div class="success-message">
                       <i class="fas fa-check"></i> {{ session('success') }}
                   </div>
                   @endif

                   <p class="success-text">Que souhaitez-vous faire maintenant ?</p>

                   <div class="options-container">
                       <a href="{{ route('login') }}" class="option-btn btn-primary">
                           <i class="fas fa-sign-in-alt"></i> Se reconnecter
                       </a>
                       <form action="{{ route('relogin') }}" method="POST">
                           @csrf
                           <button type="submit" class="option-btn btn-success">
                               <i class="fas fa-tachometer-alt"></i> Tableau de bord
                           </button>
                       </form>
                   </div>
                </div>  
            </div>
        </div>
    </div>
</div>
</body>
</html>
