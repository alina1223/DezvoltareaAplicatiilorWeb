@extends('layouts.app')

@section('title', 'Despre Noi - Academia IT')

@section('content')
    <h1>ℹ️ Despre Academia IT</h1>
    
    <p>Academia IT este o platformă de cursuri online dedicată educației în domeniul tehnologiei informației. Misiunea noastră este să oferim acces la educație de înaltă calitate și să pregătim generația următoare de profesioniști în IT.</p>
    
    <p>Cu o echipă de instructori experimentați și cursuri actualizate constant, Academia IT se angajează să vă ajute să atingeți obiectivele dvs. în carieră și să deveniți exponenți în domeniu.</p>

    <!-- Sectiune cu date dinamice -->
    <div class="card">
        <h2>🌟 Misiunea și Valorile Noastre</h2>
        
        <h3>Misiunea Noastră</h3>
        <p>
            {{ $mission ?? 'Să democratizez educația tehnologică prin furnizarea de cursuri accesibile, de înaltă calitate, care pregătesc studenții să reușească în industria IT globală.' }}
        </p>

        <h3>Valorile Noastre</h3>
        @php
            $values = [
                'Excelență' => 'Commitment la cea mai bună calitate în educație',
                'Inovație' => 'Adaptare constantă la noile tehnologii și tendințe',
                'Accesibilitate' => 'Educație disponibilă pentru toți, indiferent de background',
                'Integritate' => 'Transparență și etică în toate operațiunile noastre',
                'Comunitate' => 'Construirea unei comunități de învățare colaborativă'
            ]
        @endphp

        <ul>
            @foreach ($values as $value => $description)
                <li><strong>{{ $value }}:</strong> {{ $description }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Echipa si Historia -->
    <div class="card">
        <h2>👨‍💼 Despre Echipa Noastră</h2>
        <p>Academia IT a fost fondată în 2020 de un grup de profesioniști din industria IT care au observat necesitatea unei platforme educaționale de calitate.</p>
        
        <h3>Fapte Despre Noi:</h3>
        @php
            $facts = [
                'Peste 50 instructori certificați cu experiență în industrie',
                'Peste 100 cursuri în diferite domenii ale IT-ului',
                '15.000+ studenți activi din 50+ țări',
                'Rating de 4.8/5 de la utilizatori',
                'Certificări recunoscute la nivel internațional',
                'Program de mentorat personalizat pentru fiecare student'
            ]
        @endphp

        <ol>
            @foreach ($facts as $fact)
                <li>{{ $fact }}</li>
            @endforeach
        </ol>
    </div>

    <a href="{{ route('services') }}" class="btn">Explorează Serviciile Noastre</a>
@endsection
