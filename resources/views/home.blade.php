<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acasă - Academia IT</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        p { line-height: 1.6; color: #666; }
        nav { margin-bottom: 20px; }
        nav a { margin-right: 15px; text-decoration: none; color: #0066cc; padding: 8px 12px; background-color: #f0f0f0; border-radius: 4px; display: inline-block; }
        nav a:hover { background-color: #e0e0e0; text-decoration: none; }
        .button { display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #0066cc; color: white; text-decoration: none; border-radius: 4px; }
        .button:hover { background-color: #0052a3; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Acasă</a>
        <a href="{{ route('about') }}">Despre Noi</a>
        <a href="{{ route('services') }}">Servicii</a>
        <a href="{{ route('contact.page') }}">Contact</a>
    </nav>

    <h1>Pagina principală</h1>
    <p>Bine ați venit la Academia IT! Suntem o platformă de cursuri online de inginerie și informatică care vă oferă acces la cursuri de calitate superioară în diverse domenii ale tehnologiei.</p>
    <p>Explorați oferta noastră și descoperiți cum puteți dezvolta competențele necesare în era digitală.</p>
    
    <a href="{{ route('contact.page') }}" class="button">Contactați-ne</a>
</body>
</html>
