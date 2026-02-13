@extends('layouts.app')

@section('title', 'Bine ați Venit - Academia IT')

@section('content')
    <div style="text-align: center; padding: 60px 20px;">
        <h1 style="font-size: 3em; margin-bottom: 20px;">🎓 Bine ați Venit la Academia IT</h1>
        
        <p style="font-size: 1.2em; color: #666; margin-bottom: 30px; max-width: 600px; margin-left: auto; margin-right: auto;">
            Centrul de excellență în educație tehnologică și inovație digitală
        </p>

        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 40px;">
            <a href="{{ route('home') }}" class="btn">🏠 Pagina Principală</a>
            <a href="{{ route('services') }}" class="btn btn-secondary">🔧 Servicii</a>
            <a href="{{ route('contact.page') }}" class="btn btn-secondary">📧 Contact</a>
        </div>

        <div style="margin-top: 60px; padding: 30px; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border-radius: 10px;">
            <h2>🌟 De Ce Academia IT?</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
                <div>
                    <h3>📚 Cursuri de Calitate</h3>
                    <p>Peste 100 cursuri actualizate constant în domenii diverse ale IT-ului</p>
                </div>
                <div>
                    <h3>👨‍🏫 Instructori Experimentați</h3>
                    <p>Echipă de profesioniști cu experiență reală în industrie</p>
                </div>
                <div>
                    <h3>🌍 Comunitate Globală</h3>
                    <p>Conectează-te cu studenți și profesioniști din 50+ țări</p>
                </div>
                <div>
                    <h3>📜 Certificări Recunoscute</h3>
                    <p>Obții certificări internaționale care îți vor avansa cariera</p>
                </div>
                <div>
                    <h3>💰 Prețuri Accesibile</h3>
                    <p>Educație de calitate la prețuri care se potrivesc bugetului tău</p>
                </div>
                <div>
                    <h3>🎯 Mentorat Personalizat</h3>
                    <p>Suport individual adaptat nevoilor și scopurilor tale</p>
                </div>
            </div>
        </div>
    </div>
@endsection
