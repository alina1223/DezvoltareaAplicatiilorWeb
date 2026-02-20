@extends('layouts.app')

@section('title', 'Servicii - Academia IT')

@section('content')
    <h1>🔧 Serviciile Noastre</h1>
    
    <p>Academia IT oferă servicii de formare profesională în domeniul tehnologiei informației. Oferim <strong>{{ count($courses) }} cursuri online</strong> de înaltă calitate, mentorat personalizat și resurse educaționale complete pentru ca studenții noștri să devină experți în domeniu.</p>

    <!-- ============ GRID CU CURSURI DINAMICE DIN CONTROLLER ============ -->
    <h2>📚 Cursurile Noastre</h2>
    
    <div class="services-grid">
        @foreach ($courses as $course)
            <div class="service-item">
                <h3>{{ $course['icon'] }} {{ $course['title'] }}</h3>
                <p><em>{{ $course['description'] }}</em></p>
                
                <!-- DETALII CURS -->
                <div style="border-top: 1px solid #ddd; padding-top: 10px; margin-top: 10px;">
                    <p><strong>⏱️ Durată:</strong> {{ $course['duration'] }}</p>
                    <p><strong>💰 Preț:</strong> {{ $course['price'] }}</p>
                    <p><strong>👨‍🏫 Instructor:</strong> {{ $course['instructor'] }}</p>
                    <p><strong>👥 Studenți Înscriși:</strong> {{ $course['students'] }}</p>
                    
                    <!-- RATING CONDIȚIONAL -->
                    @if($course['rating'] >= 4.8)
                        <p><strong>⭐ Rating:</strong> <span style="color: #FFD700;">{{ $course['rating'] }}/5 ⭐⭐⭐⭐⭐</span></p>
                    @elseif($course['rating'] >= 4.5)
                        <p><strong>⭐ Rating:</strong> <span style="color: #FFA500;">{{ $course['rating'] }}/5 ⭐⭐⭐⭐</span></p>
                    @else
                        <p><strong>⭐ Rating:</strong> {{ $course['rating'] }}/5 ⭐⭐⭐</p>
                    @endif
                </div>
                
                <a href="#" class="btn" style="margin-top: 10px;">Detalii & Înregistrare</a>
            </div>
        @endforeach
    </div>

    <!-- ============ STATISTICI CURSURI ============ -->
    <div class="card">
        <h2>📊 Statistici Cursuri</h2>
        
        @php
            $totalStudents = 0;
            $averageRating = 0;
            foreach($courses as $course) {
                $totalStudents += $course['students'];
                $averageRating += $course['rating'];
            }
            $averageRating = $averageRating / count($courses);
        @endphp
        
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 8px 0;"><strong>📚 Total Cursuri Disponibile:</strong> <span style="color: #667eea; font-size: 1.2em;">{{ count($courses) }}</span></li>
            <li style="padding: 8px 0;"><strong>👥 Total Studenți Înscriși:</strong> <span style="color: #667eea; font-size: 1.2em;">{{ number_format($totalStudents) }}</span></li>
            <li style="padding: 8px 0;"><strong>⭐ Rating Mediu Cursuri:</strong> <span style="color: #667eea; font-size: 1.2em;">{{ number_format($averageRating, 2) }}/5</span></li>
            <li style="padding: 8px 0;"><strong>👨‍🏫 Instructori Certificați:</strong> <span style="color: #667eea; font-size: 1.2em;">{{ count($courses) }}</span></li>
        </ul>
    </div>

    <!-- ============ PACHETE DE SERVICII DINAMICE ============ -->
    <h2>📦 Pachete de Abonament</h2>
    <p>Alege pachetul care se potrivește nevoilor tale:</p>
    
    <div class="services-grid">
        @foreach ($packages as $package)
            <div class="service-item">
                <h3>{{ $package['name'] }}</h3>
                <p style="font-size: 1.5em; color: #667eea; font-weight: bold;">{{ $package['price'] }}</p>
                
                <p><strong>Acces la:</strong> {{ $package['courses'] }} cursuri</p>
                
                <h4 style="margin-top: 15px;">Inclus:</h4>
                <ul style="padding-left: 20px;">
                    @foreach($package['features'] as $feature)
                        <li>✅ {{ $feature }}</li>
                    @endforeach
                </ul>
                
                <a href="#" class="btn" style="margin-top: 10px;">Alege Pachetul</a>
            </div>
        @endforeach
    </div>

    <div class="card" style="margin-top: 30px;">
        <h2>💡 De Ce Să Alegi Academia IT?</h2>
        <ul>
            <li>✅ Cursuri create de experți cu 10+ ani de experiență</li>
            <li>✅ Certificări recunoscute internațional</li>
            <li>✅ Suport personalizat și mentorat individual</li>
            <li>✅ Comunitate activă de profesioniști</li>
            <li>✅ Acces la resurse și materiale descărcabile</li>
            <li>✅ Garanție de satisfacție sau bani înapoi</li>
        </ul>
    </div>

    <a href="{{ route('contact.page') }}" class="btn">Contactează-ne Pentru Informații Detaliate</a>
@endsection


