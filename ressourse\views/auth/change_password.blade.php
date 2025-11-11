<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Changer mot de passe | Administration</title>
</head>
<body>
  <div class="wrapper">
    <div class="container main">
        <div class="row" id="mainRow">
            <div class="col-md-6 side-image"></div>
            <div class="col-md-6 right">
                <div class="input-box">
                   <header>
                       <i class="fas fa-lock"></i>
                       <div>Changer de mot de passe</div>
                   </header>
                   <form action="{{ route('change.password') }}" method="POST">
                        @csrf
                        <div class="input-field">
                            <input type="password" class="input" id="current_password" name="current_password" required>
                            <label for="current_password">Mot de passe actuel</label>
                            <i class="fas fa-key input-icon"></i>
                            <button type="button" class="toggle-password">
                                <i class="far fa-eye"></i>
                            </button>
                            @error('current_password')
                                <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <input type="password" class="input" id="new_password" name="new_password" required>
                            <label for="new_password">Nouveau mot de passe</label>
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button" class="toggle-password">
                                <i class="far fa-eye"></i>
                            </button>
                            <div class="password-hint">5 caractères minimum</div>
                            @error('new_password')
                                <span class="text-danger error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <input type="password" class="input" id="new_password_confirmation" name="new_password_confirmation" required>
                            <label for="new_password_confirmation">Confirmer le mot de passe</label>
                            <i class="fas fa-check-circle input-icon"></i>
                            <button type="button" class="toggle-password">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <div class="input-field">
                            <input type="submit" class="submit" value="Mettre à jour">
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
