<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare - Academia IT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .register-container {
            max-width: 400px;
            margin: 30px auto;
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            outline: none;
            border-color: #0066cc;
            box-shadow: 0 0 5px rgba(0,102,204,0.3);
        }
        select {
            cursor: pointer;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0052a3;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            text-decoration: none;
            color: #0066cc;
            font-weight: bold;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .error-box {
            background-color: #ffebee;
            border-left: 4px solid #d32f2f;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #d32f2f;
        }
        .success-box {
            background-color: #e8f5e9;
            border-left: 4px solid #4caf50;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #2e7d32;
        }
        .role-info {
            background-color: #e3f2fd;
            border-left: 4px solid #0066cc;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 13px;
            color: #0066cc;
        }
        nav {
            text-align: center;
            margin-top: 20px;
        }
        nav a {
            text-decoration: none;
            color: #0066cc;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Înregistrare</h1>

        @if ($errors->any())
            <div class="error-box">
                <strong>Eroare!</strong><br>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="success-box">
                {{ session('success') }}
            </div>
        @endif

        <div class="role-info">
            <strong>Selectați rolul:</strong><br>
            • <strong>Admin</strong> - Acces la panoul de administrare<br>
            • <strong>User</strong> - Utilizator obișnuit
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nume complet:</label>
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
                <label for="email">Email:</label>
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
                <label for="password">Parolă:</label>
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
                <label for="password_confirmation">Confirmare parolă:</label>
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
                <label for="role">Rol:</label>
                <select id="role" name="role" required>
                    <option value="">-- Selectați rolul --</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <button type="submit">Înregistrare</button>
        </form>

        <div class="login-link">
            Aveți deja cont? <a href="{{ route('login') }}">Conectați-vă</a>
        </div>

        <nav style="margin-top: 30px;">
            <a href="{{ route('home') }}">← Înapoi la pagina principală</a>
        </nav>
    </div>
</body>
</html>
