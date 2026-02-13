@extends('layouts.app')

@section('title', 'Contact - Academia IT')

@section('content')
    <h1>📧 Contactează-ne</h1>
    <p>Dacă aveți întrebări sau doriți să colaborați cu noi, vă rugăm să ne contactați utilizând informațiile de mai jos.</p>
    
    <div class="card">
        <h2>📍 Informații de Contact</h2>
        <div class="contact-info">
            <p>
                <strong>✉️ Email:</strong> 
                <a href="mailto:academie@gmail.com">academie@gmail.com</a>
            </p>
            <p>
                <strong>📱 Telefon:</strong> 
                <a href="tel:+40123456789">+40 (0)123 456 789</a>
            </p>
            <p>
                <strong>🏢 Adresă:</strong> 
                Str. Tehnologiei 123, 010101 București, România
            </p>
            <p>
                <strong>🕐 Orele de Funcționare:</strong> 
                Luni - Vineri: 09:00 - 18:00 | Sâmbătă: 10:00 - 14:00
            </p>
        </div>
    </div>

    <!-- Formularul de Contact -->
    <div class="card">
        <h2>📝 Trimite-ne un Mesaj</h2>
        <form method="POST" action="{{ route('contact.page') }}">
            @csrf
            
            <div class="form-group">
                <label for="name">Nume Complet *</label>
                <input type="text" id="name" name="name" required placeholder="Introduceți numele dvs.">
            </div>

            <div class="form-group">
                <label for="email">Adresă de Email *</label>
                <input type="email" id="email" name="email" required placeholder="exemplu@email.com">
            </div>

            <div class="form-group">
                <label for="subject">Subiect *</label>
                <input type="text" id="subject" name="subject" required placeholder="Subiectul mesajului">
            </div>

            <div class="form-group">
                <label for="message">Mesaj *</label>
                <textarea id="message" name="message" required placeholder="Introduceți mesajul dvs..."></textarea>
            </div>

            <div class="form-group">
                <label for="category">Categoria Dorită</label>
                <select id="category" name="category">
                    <option value="">-- Selecteaza o categorie --</option>
                    <option value="general">Întrebare Generală</option>
                    <option value="curso">Despre Cursuri</option>
                    <option value="technical">Suport Tehnic</option>
                    <option value="partnership">Parteneriat</option>
                    <option value="other">Altceva</option>
                </select>
            </div>

            <button type="submit" class="btn">Trimite Mesajul</button>
        </form>
    </div>

    <!-- Intrebari Frecvente -->
    <div class="card">
        <h2>❓ Întrebări Frecvente</h2>
        
        @php
            $faqs = [
                'Care sunt condițiile de înscrierii?' => 'Oricine poate se înscrie la cursurile noastre. Singura cerință este să aveți acces la internet și dorința de a învăța.',
                'Cum funcționează certificarea?' => 'După finalizarea unui curs, puteți obține o certificare care va fi trimisă la adresa de email și disponibilă în dashboard-ul dvs.',
                'Ce suport este disponibil pentru studenți?' => 'Offerăm suport email 24/7, forumuri de discuție, și mentorat personalizat pentru pachetele premium.',
                'Pot accesa cursurile offline?' => 'Cursurile noastre necesită conexiune internet, dar puteți descărca materialele pentru a le studia later.',
                'Cum este politica de rambursare?' => 'Offerăm garanție de 30 de zile. Dacă nu sunteti mulțumit, vă vom rambursa integral.'
            ]
        @endphp

        @foreach ($faqs as $question => $answer)
            <div style="margin-bottom: 20px; border-left: 4px solid #667eea; padding-left: 15px;">
                <h4>{{ $question }}</h4>
                <p>{{ $answer }}</p>
            </div>
        @endforeach
    </div>

    <style scoped>
        .contact-info {
            margin-top: 15px;
        }

        .contact-info p {
            margin: 12px 0;
            font-size: 1.05em;
        }

        .contact-info a {
            color: #667eea;
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }
    </style>
@endsection
