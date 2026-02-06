<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Academia IT</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #f5f5f5;
        }
        .admin-container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 { 
            color: #d32f2f;
            border-bottom: 3px solid #d32f2f;
            padding-bottom: 10px;
        }
        p { 
            line-height: 1.8; 
            color: #333;
            font-size: 16px;
        }
        .warning { 
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        nav { margin-bottom: 20px; }
        nav a { 
            margin-right: 15px; 
            text-decoration: none; 
            color: #0066cc;
            font-weight: bold;
        }
        nav a:hover { text-decoration: underline; }
        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #d32f2f;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        .logout-btn:hover { background-color: #b71c1c; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Acasă</a>
        <a href="{{ route('about') }}">Despre Noi</a>
        <a href="{{ route('services') }}">Servicii</a>
        <a href="{{ route('contact.page') }}">Contact</a>
    </nav>

    <div class="admin-container">
        <h1>🔐 Zona admin – acces restricționat (demo)</h1>
        
        <div class="warning">
            <strong>⚠️ Atenție:</strong> Aceasta este o pagină de administrare accesibilă doar utilizatorilor autentificați. Gestionați cu atenție datele și setările din această secțiune.
        </div>

        <p>Bine ați venit în panoul de administrare al Academiei IT! De aici puteți gestiona întreaga platformă, inclusiv utilizatori, cursuri, setări și alte funcționalități administrative.</p>

        <p>Această pagină este protejată prin autentificare și poate fi accesată doar de utilizatorii cu drepturi administrative. Asigurați-vă că vă delogați după ce ați terminat lucrul.</p>

        <h2>Funcționalități disponibile:</h2>
        <ul>
            <li>Gestionarea utilizatorilor</li>
            <li>Gestionarea cursurilor</li>
            <li>Rapoarte și statistici</li>
            <li>Setări generale ale platformei</li>
            <li>Gestionarea conținutului</li>
        </ul>

        <a href="{{ route('home') }}" class="logout-btn">Înapoi la pagina principală</a>
    </div>
</body>
</html>
