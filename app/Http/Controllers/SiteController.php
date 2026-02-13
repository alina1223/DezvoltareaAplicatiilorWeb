<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        // Statistici dinamice despre platformă
        $statistics = [
            [
                'icon' => '📚',
                'label' => 'Cursuri Active',
                'value' => 45,
                'description' => 'Cursuri în diverse domenii'
            ],
            [
                'icon' => '👥',
                'label' => 'Studenți Înscriși',
                'value' => 1250,
                'description' => 'Oameni care se dezvoltă cu noi'
            ],
            [
                'icon' => '🎯',
                'label' => 'Cursuri Completate',
                'value' => 892,
                'description' => 'Studenți care au finalizat cursuri'
            ],
            [
                'icon' => '⭐',
                'label' => 'Rating Mediu',
                'value' => '4.8/5',
                'description' => 'Evaluarea din partea studenților'
            ]
        ];
        
        // Informații despre aplicație
        $appInfo = [
            'name' => 'Academia IT',
            'tagline' => 'Educație în Tehnologie & Inovație',
            'founded' => 2020,
            'year' => 2026,
            'years_active' => 6,
            'country' => 'Moldova',
            'mission' => 'Să oferim acces egal la educație de calitate în tehnologie',
            'vision' => 'Să devenim cea mai mare platformă de e-learning din Europa de Est'
        ];
        
        return view('home', [
            'statistics' => $statistics,
            'appInfo' => $appInfo
        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function services()
    {
        // Cursuri disponibile
        $courses = [
            [
                'id' => 1,
                'icon' => '🌐',
                'title' => 'Web Development',
                'description' => 'HTML5, CSS3, JavaScript, Laravel, React',
                'duration' => '12 săptămâni',
                'price' => '299 lei/lună',
                'instructor' => 'Ion Popescu',
                'students' => 145,
                'rating' => 4.9
            ],
            [
                'id' => 2,
                'icon' => '🐍',
                'title' => 'Python & AI',
                'description' => 'Python, Machine Learning, Data Science, TensorFlow',
                'duration' => '16 săptămâni',
                'price' => '349 lei/lună',
                'instructor' => 'Maria Ionescu',
                'students' => 89,
                'rating' => 4.9
            ],
            [
                'id' => 3,
                'icon' => '⚙️',
                'title' => 'DevOps & Cloud',
                'description' => 'Docker, Kubernetes, AWS, Azure',
                'duration' => '10 săptămâni',
                'price' => '329 lei/lună',
                'instructor' => 'Alex Diaconu',
                'students' => 67,
                'rating' => 4.7
            ],
            [
                'id' => 4,
                'icon' => '🔐',
                'title' => 'Cybersecurity',
                'description' => 'Ethical Hacking, Pentesting, Security Audit',
                'duration' => '14 săptămâni',
                'price' => '379 lei/lună',
                'instructor' => 'Radu Mihai',
                'students' => 45,
                'rating' => 4.9
            ],
            [
                'id' => 5,
                'icon' => '📱',
                'title' => 'Mobile Development',
                'description' => 'React Native, Flutter, Swift',
                'duration' => '13 săptămâni',
                'price' => '319 lei/lună',
                'instructor' => 'Cristina Georgescu',
                'students' => 92,
                'rating' => 4.8
            ],
            [
                'id' => 6,
                'icon' => '📊',
                'title' => 'Data Analytics',
                'description' => 'SQL, Power BI, Tableau, R',
                'duration' => '12 săptămâni',
                'price' => '299 lei/lună',
                'instructor' => 'Bogdan Stoica',
                'students' => 78,
                'rating' => 4.7
            ]
        ];
        
        // Pachete de servicii
        $packages = [
            [
                'name' => 'Starter Pack',
                'price' => '99 lei/lună',
                'courses' => 10,
                'features' => ['Acces la 10 cursuri', 'Certificat de absolvire', 'Suport email']
            ],
            [
                'name' => 'Professional Pack',
                'price' => '199 lei/lună',
                'courses' => 30,
                'features' => ['Acces la 30 cursuri', 'Mentorat personalizat', 'Forumuri', 'Certificări']
            ],
            [
                'name' => 'Enterprise Pack',
                'price' => '499 lei/lună',
                'courses' => 999,
                'features' => ['TOATE cursurile', 'Mentorat 24/7', 'Suport prioritar', 'Webinare exclusive']
            ]
        ];
        
        return view('services', [
            'courses' => $courses,
            'packages' => $packages
        ]);
    }

    public function admin()
    {
        return view('admin');
    }
}
