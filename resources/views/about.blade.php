<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Despre Noi - Academia IT</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        p { line-height: 1.6; color: #666; }
        nav { margin-bottom: 20px; }
        nav a { margin-right: 15px; text-decoration: none; color: #0066cc; }
        nav a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Acasă</a>
        <a href="{{ route('about') }}">Despre Noi</a>
        <a href="{{ route('services') }}">Servicii</a>
        <a href="{{ route('contact.page') }}">Contact</a>
    </nav>

    <h1>Despre Noi</h1>
    <p>Academia IT este o platformă de cursuri online dedicată educației în domeniul tehnologiei informației. Misiunea noastră este să oferim acces la educație de înaltă calitate și să pregătim generația următoare de profesioniști în IT.</p>
    <p>Cu o echipă de instructori experimentați și cursuri actualizate constant, Academia IT se angajează să vă ajute să atingeți obiectivele dvs. în carieră și să deveniți exponenți în domeniu.</p>
</body>
</html>
