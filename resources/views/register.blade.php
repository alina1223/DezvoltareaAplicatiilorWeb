@extends('layouts.app')

@section('title', 'Înregistrare - Academia IT')

@section('content')
    <div style="max-width: 500px; margin: 40px auto;">
        <div class="card">
            <h1 style="text-align: center; border: none; padding: 0; color: #333; margin-bottom: 30px;">📝 Creează un Cont Nou</h1>

            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>❌ Eroare la înregistrare!</strong><br>
                    @foreach ($errors->all() as $error)
                        • {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="alert alert-info" style="margin-bottom: 25px;">
                <strong>💡 Informații Rol:</strong><br>
                👑 <strong>Admin</strong> - Acces la panoul de administrare<br>
                👤 <strong>User</strong> - Utilizator cu acces la cursuri
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">👤 Nume Complet</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        placeholder="Ion Popescu"
                        value="{{ old('name') }}"
                    >
                </div>

                <div class="form-group">
                    <label for="email">📧 Adresă de Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        placeholder="email@example.com"
                        value="{{ old('email') }}"
                        autocomplete="email"
                    >
                </div>

                <div class="form-group">
                    <label for="password">🔑 Parolă</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        placeholder="Minim 6 caractere"
                        autocomplete="new-password"
                    >
                </div>

                <div class="form-group">
                    <label for="password_confirmation">🔑 Confirmare Parolă</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        placeholder="Repetați parola"
                        autocomplete="new-password"
                    >
                </div>

                <div class="form-group">
                    <label for="role">👥 Selectează Rolul Tău</label>
                    <select id="role" name="role" required>
                        <option value="">-- Selectați rolul --</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>👑 Admin</option>
                        <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>👤 User</option>
                    </select>
                </div>

                <button type="submit" class="btn" style="width: 100%; text-align: center;">Creează Contul</button>
            </form>

            <div style="text-align: center; margin-top: 25px; padding-top: 25px; border-top: 1px solid #e0e0e0;">
                <p style="color: #666; margin-bottom: 15px;">Aveți deja cont?</p>
                <a href="{{ route('login') }}" class="btn btn-secondary" style="width: 100%; text-align: center;">Conectează-te</a>
            </div>

            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('home') }}" style="color: #667eea; text-decoration: none; font-weight: 500;">← Înapoi la pagina principală</a>
            </div>
        </div>
    </div>
@endsection
