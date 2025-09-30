<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Baya</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <style>
        :root {
            --primary: #00c8d7;
            --primary-light: rgba(0, 200, 215, 0.1);
            --primary-dark: #0095a8;
            --secondary: #1e293b;
            --secondary-light: #334155;
            --secondary-dark: #0f172a;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #f1f5f9;
            --dark: #374668ff;
            --darker: #020617;
            --text: #e2e8f0;
            --text-secondary: #94a3b8;
            --card-bg: rgba(30, 41, 59, 0.6);
            --card-border: rgba(255, 255, 255, 0.7); /* Much lighter white */
            --card-border-grey-blue: rgba(230, 240, 255, 0.8); /* Much lighter grey-blue */
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Figtree', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--darker);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        /* Main Layout - Stays fixed */
        .main {
            flex-grow: 1;
            padding: 20px;
            background: linear-gradient(135deg, #404e68ff 0%, #4d6691ff 50%, #374151 100%);
            width: 100%;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        /* Top Navigation */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
            background: rgba(30, 41, 59, 0.7);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
            -webkit-backup-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            width: 100%;
        }

        .top-nav.scrolled {
            background: rgba(30, 41, 59, 0.9);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
        }

        .nav-logo {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-logo:hover {
            transform: scale(1.05);
        }

        .nav-search {
            flex: 1;
            max-width: 500px;
            margin: 0 20px;
        }

        .search-input {
            width: 100%;
            padding: 10px 15px;
            border-radius: 25px;
            border: none;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            background: rgba(255, 255, 255, 0.2);
            outline: none;
            box-shadow: 0 0 0 2px var(--primary-light);
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        /* Section Card - Thinner borders */
        .section-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            margin: 24px 0;
            border: 2px solid var(--card-border); /* Thinner border */
            backdrop-filter: blur(8px);
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        /* Enhanced border effect - Thinner */
        .section-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 18px;
            border: 1px solid var(--card-border-grey-blue); /* Thinner */
            pointer-events: none;
            z-index: 1;
            opacity: 0.9;
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 28px;
            gap: 16px;
        }

        .section-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.6); /* Thinner */
        }

        .section-title {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            flex: 1;
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 200, 215, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.7); /* Thinner */
            color: var(--primary);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.9);
        }

        /* Main Content */
        .main-content {
            width: 100%;
            max-width: 100%;
            position: relative;
            z-index: 1;
        }

        /* Card Styles for Big Cards - Thinner borders */
        /* ONLY apply to hero cards (big cards in swiper) */
        .hero-event-card {
            border: 2px solid rgba(255, 255, 255, 0.8) !important; /* Thinner border */
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.4);
        }

        /* Enhanced border effect for hero cards only - Thinner */
        .hero-event-card::after {
            content: '';
            position: absolute;
            top: -1px;
            left: -1px;
            right: -1px;
            bottom: -1px;
            border-radius: 17px;
            border: 1px solid rgba(240, 248, 255, 0.9); /* Thinner */
            pointer-events: none;
            z-index: 2;
        }

        /* Hover effects for hero cards only */
        .hero-event-card:hover {
            border-color: rgba(255, 255, 255, 0.9) !important;
            transform: scale(1.02);
        }

        /* PAST EVENT CARDS - KEEP ORIGINAL STYLE (NO BORDERS) */
        .past-event-card {
            /* NO BORDER - Keep original style */
            border: none !important;
            border-radius: 12px;
            overflow: hidden;
            background: var(--secondary, #f8f9fa);
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .past-event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            /* NO border change on hover */
        }

        /* Contact items with thinner borders */
        .contact-item {
            border: 1px solid rgba(255, 255, 255, 0.6) !important; /* Thinner */
            border-radius: 12px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.05);
        }

        .contact-item:hover {
            border-color: rgba(255, 255, 255, 0.8) !important;
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.08);
        }

        /* Social links with thinner borders */
        .social-link {
            border: 1px solid rgba(255, 255, 255, 0.6) !important; /* Thinner */
            transition: all 0.3s ease;
        }

        .social-link:hover {
            border-color: rgba(255, 255, 255, 0.9) !important;
            transform: translateY(-3px) scale(1.1);
        }

        /* Ripple Effect */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Prevent body scrolling when sidebar is open */
        body.sidebar-open {
            overflow: hidden;
        }

        /* Glow effect on hover */
        .section-card:hover,
        .hero-event-card:hover {
            box-shadow: 0 10px 40px rgba(255, 255, 255, 0.2);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main {
                padding-top: 20px;
            }
            
            .top-nav {
                padding: 12px 16px;
            }
            
            .section-card {
                border-width: 2px;
            }
            
            .hero-event-card {
                border-width: 2px !important;
            }
        }

        @media (max-width: 768px) {
            .top-nav {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }
            
            .nav-search {
                width: 100%;
                margin: 10px 0;
            }
            
            .section-card {
                padding: 16px;
                border-width: 1px;
            }
            
            .section-card::before {
                border-radius: 17px;
                top: -1px;
                left: -1px;
                right: -1px;
                bottom: -1px;
            }
            
            .hero-event-card {
                border-width: 1px !important;
            }
            
            .contact-item {
                border-width: 1px !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Include your sidebar layout -->
    @include('layouts.sidebar')
    
    <div class="main" id="mainContent">
        <!-- Top Navigation Bar -->
        <nav class="top-nav" id="topNav">
            <a href="{{ url('/') }}" class="nav-logo">Baya</a>
        </nav>

        <!-- Page Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('topNav');
            if (window.scrollY > 10) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // Button ripple effect
        document.querySelectorAll('.btn:not([href])').forEach(button => {
            button.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const ripple = document.createElement('span');
                ripple.classList.add('ripple');
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Initialize Swiper if present
        if (document.querySelector('.swiper-container')) {
            new Swiper('.swiper-container', {
                loop: true,
                autoplay: { delay: 5000 },
                pagination: { 
                    el: '.swiper-pagination',
                    clickable: true 
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                }
            });
        }

        // Add enhanced hover effects to hero cards and contact items only
        document.addEventListener('DOMContentLoaded', function() {
            const heroCards = document.querySelectorAll('.hero-event-card, .contact-item, .section-card');
            heroCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Past event cards keep their original hover effect
            const pastCards = document.querySelectorAll('.past-event-card');
            pastCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>