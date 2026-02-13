<footer class="footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Academia IT</h3>
                <p>Centrul de excellență în educație tehnologică și inovație digitală.</p>
            </div>
            <div class="footer-section">
                <h4>Link-uri Rapide</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Acasă</a></li>
                    <li><a href="{{ route('about') }}">Despre Noi</a></li>
                    <li><a href="{{ route('services') }}">Servicii</a></li>
                    <li><a href="{{ route('contact.page') }}">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact</h4>
                <p>Email: info@academia-it.ro</p>
                <p>Tel: +40 123 456 789</p>
                <p>Adresă: Str. Educației nr. 1, Cluj-Napoca</p>
            </div>
            <div class="footer-section">
                <h4>Urmărire</h4>
                <ul class="social-links">
                    <li><a href="#facebook">Facebook</a></li>
                    <li><a href="#twitter">Twitter</a></li>
                    <li><a href="#linkedin">LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Academia IT. Toate drepturile rezervate.</p>
        </div>
    </div>
</footer>
