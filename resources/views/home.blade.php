@extends('layouts.app')

@section('title', 'Acasă - Academia IT')

@section('content')
    <h1>� Pagina Principală</h1>
    
    <p>Bine ați venit la <strong>{{ $appInfo['name'] }}</strong>! Suntem o platformă de cursuri online de inginerie și informatică care vă oferă acces la cursuri de calitate superioară în diverse domenii ale tehnologiei.</p>
    
    <p>{{ $appInfo['tagline'] }}</p>

    <!-- ============ STATISTICI DINAMICE DIN CONTROLLER ============ -->
    <div class="card">
        <h2>📊 Statistici Platformă</h2>
        <p>Iată informațiile din aplicația noastră:</p>
        
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #667eea; color: white;">
                    <th style="padding: 10px; text-align: left;">Indicator</th>
                    <th style="padding: 10px; text-align: left;">Valoare</th>
                    <th style="padding: 10px; text-align: left;">Descriere</th>
                </tr>
            </thead>
            <tbody>
                @foreach($statistics as $stat)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 10px;"><strong>{{ $stat['icon'] }} {{ $stat['label'] }}</strong></td>
                        <td style="padding: 10px; font-size: 1.2em; color: #667eea;"><strong>{{ $stat['value'] }}</strong></td>
                        <td style="padding: 10px;">{{ $stat['description'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ============ INFORMAȚII DESPRE APLICAȚIE ============ -->
    <div class="card">
        <h2>ℹ️ Despre {{ $appInfo['name'] }}</h2>
        
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 8px 0;"><strong>📛 Nume:</strong> {{ $appInfo['name'] }}</li>
            <li style="padding: 8px 0;"><strong>💡 Motto:</strong> {{ $appInfo['tagline'] }}</li>
            <li style="padding: 8px 0;"><strong>🗓️ Fondată în:</strong> {{ $appInfo['founded'] }}</li>
            <li style="padding: 8px 0;"><strong>⏳ Ani de operare:</strong> {{ $appInfo['years_active'] }} ani</li>
            <li style="padding: 8px 0;"><strong>🌍 Locație:</strong> {{ $appInfo['country'] }}</li>
            <li style="padding: 8px 0;"><strong>🎯 Misiune:</strong> {{ $appInfo['mission'] }}</li>
            <li style="padding: 8px 0;"><strong>🔮 Viziune:</strong> {{ $appInfo['vision'] }}</li>
        </ul>
    </div>

    <!-- ============ CATEGORII PRINCIPALE ============ -->
    <div class="card">
        <h2>🔍 Categoriile Noastre Principale</h2>
        <p>Explorați cursurile noastre din următoarele domenii:</p>
        
        @php
            $categories = [
                'Web Development' => 'Învață HTML, CSS, JavaScript, Laravel și alte tehnologii web',
                'Mobile Development' => 'Dezvoltă aplicații pentru iOS și Android',
                'Data Science' => 'Master-ezi Python, Machine Learning și Big Data',
                'Cloud Computing' => 'Lucrează cu AWS, Azure și Google Cloud',
                'DevOps' => 'Automatizare, CI/CD și infrastructure as code',
                'Cybersecurity' => 'Protejează sistemele și datele împotriva amenințărilor'
            ]
        @endphp
        
        <ul>
            @foreach ($categories as $category => $description)
                <li>
                    <strong>{{ $category }}:</strong> {{ $description }}
                </li>
            @endforeach
        </ul>
    </div>

    <a href="{{ route('services') }}" class="btn">Explorează Cursurile Noastre</a>
@endsection
