<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Academia IT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .login-container {
            max-width: 400px;
            margin: 50px auto;
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
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #0066cc;
            box-shadow: 0 0 5px rgba(0,102,204,0.3);
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
        .login-info {
            background-color: #e3f2fd;
            border-left: 4px solid #0066cc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 14px;
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
    <div class="login-container">
        <h1>Autentificare</h1>
        
        <div class="login-info">
            <strong>Credențiale test:</strong><br>
            Email: admin@test.com<br>
            Parolă: password123<br>
            <em>Rol: Admin</em>
        </div>

        <form method="POST" action="/login">
            @csrf
            
            @if ($errors->any())
                <div style="background-color: #ffebee; border-left: 4px solid #d32f2f; padding: 15px; margin-bottom: 20px; border-radius: 4px; color: #d32f2f;">
                    <strong>Eroare!</strong><br>
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            
            <div class="form-group">
                <label for="email">Email:</label>
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
                <label for="password">Parolă:</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    placeholder="Introduceți parola"
                    autocomplete="current-password"
                >
            </div>

            <button type="submit">Autentificare</button>
        </form>

        <div style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd;">
            <p style="color: #666;">Nu aveți cont?</p>
            <a href="{{ route('register') }}" style="display: inline-block; padding: 10px 20px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">
                Creați un cont nou
            </a>
        </div>

        <nav style="margin-top: 30px; text-align: center;">
            <a href="{{ route('home') }}">← Înapoi la pagina principală</a>
        </nav>
    </div>
</body>
</html>
