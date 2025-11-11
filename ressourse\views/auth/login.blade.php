<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Connexion</title>
</head>
<body>
  <div class="wrapper">
    <div class="container main">
        <div class="row" id="mainRow">
            <div class="col-md-6 side-image"></div>
            <div class="col-md-6 right">
                <div class="input-box">
                   <header>
                       <i class="fas fa-user-shield"></i>
                       <div>Connexion</div>
                   </header>
                   <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="input-field">
                            <input type="email" class="input" id="email" name="email" required autocomplete="off" value="{{ old('email') }}">
                            <label for="email">Email</label>
                            <i class="fas fa-envelope input-icon"></i>
                            @error('email')
                                <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <input type="password" class="input" id="mdp" name="mdp" required>
                            <label for="mdp">Mot de passe</label>
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button" class="toggle-password">
                                <i class="far fa-eye"></i>
                            </button>
                            @error('mdp')
                                <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <input type="submit" class="submit" value="Se connecter">
                        </div>
                    </form>
                   <div class="signin">
                       <a href="{{ route('change.password.form') }}">
                           <i class="fas fa-key"></i> Changer de mot de passe
                       </a>
                       <div class="password-help-text">
        Mot de passe oublié ? Contactez l'administration.
    </div>
                   </div>
                   
                </div>  
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
