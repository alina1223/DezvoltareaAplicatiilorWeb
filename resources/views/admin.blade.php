@extends('layouts.app')

@section('title', 'Admin Dashboard - Academia IT')

@section('content')
    <h1>🔐 Panou de Administrare</h1>
    
    <div class="card" style="border-left: 4px solid #ff9800;">
        <p style="color: #e65100; font-weight: 600;">
            ⚠️ <strong>Atenție:</strong> Aceasta este o pagină de administrare accesibilă doar utilizatorilor autentificați. Gestionați cu atenție datele și setările din această secțiune.
        </p>
    </div>

    <div class="card">
        <h2>Bine ați venit, {{ Auth::user()->name ?? 'Administrator' }}!</h2>
        
        <p>Sunteți conectat la panoul de administrare al Academiei IT. De aici puteți gestiona întreaga platformă, inclusiv utilizatori, cursuri, setări și alte funcționalități administrative.</p>

        <p>Această pagină este protejată prin autentificare și poate fi accesată doar de utilizatorii cu drepturi administrative. Asigurați-vă că vă delogați după ce ați terminat lucrul.</p>
    </div>

    <!-- Statistici Admin -->
    <div class="card">
        <h2>📊 Statistici Platformă</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px 0;">
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 8px; text-align: center;">
                <h3 style="margin: 0; color: white;">{{ $totalUsers ?? 1250 }}</h3>
                <p style="color: rgba(255,255,255,0.9); margin: 0;">Utilizatori Totali</p>
            </div>

            <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 20px; border-radius: 8px; text-align: center;">
                <h3 style="margin: 0; color: white;">{{ $activeCourses ?? 102 }}</h3>
                <p style="color: rgba(255,255,255,0.9); margin: 0;">Cursuri Active</p>
            </div>

            <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 20px; border-radius: 8px; text-align: center;">
                <h3 style="margin: 0; color: white;">{{ $activeStudents ?? 892 }}</h3>
                <p style="color: rgba(255,255,255,0.9); margin: 0;">Studenți Activi</p>
            </div>

            <div style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; padding: 20px; border-radius: 8px; text-align: center;">
                <h3 style="margin: 0; color: white;">{{ $completedCertificates ?? 234 }}</h3>
                <p style="color: rgba(255,255,255,0.9); margin: 0;">Certificate Emise</p>
            </div>
        </div>
    </div>

    <!-- Funcționalități Admin -->
    <div class="card">
        <h2>⚙️ Funcționalități Disponibile</h2>
        
        @php
            $adminFeatures = [
                'Gestionarea Utilizatorilor' => 'Adaugă, editează sau șterge conturi de utilizator',
                'Gestionarea Cursurilor' => 'Creează și administrează cursurile disponibile',
                'Rapoarte și Statistici' => 'Vizualizează date detaliate despre utilizare',
                'Setări Generale' => 'Configurează parametrii platformei',
                'Gestionarea Conținutului' => 'Moderează și actualizează conținutul',
                'Suport Utilizatori' => 'Răspunde la mesajele și problemele utilizatorilor'
            ]
        @endphp

        <ul>
            @foreach ($adminFeatures as $feature => $description)
                <li><strong>{{ $feature }}:</strong> {{ $description }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Acțiuni Rapide -->
    <div class="card">
        <h2>🚀 Acțiuni Rapide</h2>
        <p>Accesează rapid funcționalitățile administrative:</p>
        
        <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 15px;">
            <a href="{{ route('home') }}" class="btn">Pagina Principală</a>
            <a href="{{ route('about') }}" class="btn btn-secondary">Despre Noi</a>
            <a href="{{ route('services') }}" class="btn btn-secondary">Servicii</a>
        </div>
    </div>

    <!-- Ultima Activitate -->
    <div class="card">
        <h2>📋 Informații Contul Dvs</h2>
        <ul>
            <li><strong>Nume:</strong> {{ Auth::user()->name ?? 'N/A' }}</li>
            <li><strong>Email:</strong> {{ Auth::user()->email ?? 'N/A' }}</li>
            <li><strong>Rol:</strong> <span style="color: #d32f2f; font-weight: 600;">Administrator</span></li>
            <li><strong>Conectat din:</strong> {{ Auth::user()->created_at ?? 'N/A' }}</li>
        </ul>
    </div>

    <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
        @csrf
        <button type="submit" class="btn" style="background-color: #d32f2f;">🚪 Logout</button>
    </form>
@endsection
