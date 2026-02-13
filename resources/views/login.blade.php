@extends('layouts.app')

@section('title', 'Login - Academia IT')

@section('content')
    <div style="max-width: 450px; margin: 40px auto;">
        <div class="card">
            <h1 style="text-align: center; border: none; padding: 0; color: #333; margin-bottom: 30px;">🔐 Autentificare</h1>
            
            <div class="alert alert-info">
                <strong>💡 Credențiale Test:</strong><br>
                📧 Email: admin@test.com<br>
                🔑 Parolă: password123<br>
                👤 Rol: Admin
            </div>

            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>❌ Eroare la autentificare!</strong><br>
                    @foreach ($errors->all() as $error)
                        • {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="/login">
                @csrf
                
                <div class="form-group">
                    <label for="email">📧 Adresă de Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required 
                        placeholder="admin@test.com"
                        autocomplete="email"
                        value="{{ old('email') }}"
                    >
                </div>

                <div class="form-group">
                    <label for="password">🔑 Parolă</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        placeholder="Introduceți parola"
                        autocomplete="current-password"
                    >
                </div>

                <button type="submit" class="btn" style="width: 100%; text-align: center;">Conectează-te</button>
            </form>

            <div style="text-align: center; margin-top: 25px; padding-top: 25px; border-top: 1px solid #e0e0e0;">
                <p style="color: #666; margin-bottom: 15px;">Nu aveți cont?</p>
                <a href="{{ route('register') }}" class="btn btn-secondary" style="width: 100%; text-align: center;">Creați un cont nou</a>
            </div>

            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('home') }}" style="color: #667eea; text-decoration: none; font-weight: 500;">← Înapoi la pagina principală</a>
            </div>
        </div>
    </div>
@endsection
