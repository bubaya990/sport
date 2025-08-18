<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

        <!-- Inline Styles to Maintain Design -->
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
                --dark: #0f172a;
                --darker: #020617;
                --text: #e2e8f0;
                --text-secondary: #94a3b8;
                --card-bg: rgba(30, 41, 59, 0.6);
                --card-border: rgba(0, 200, 215, 0.15);
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
            }

            /* Main Layout */
            .main {
                flex-grow: 1;
                padding: 20px;
                background: linear-gradient(135deg, #1a2332 0%, #2d3748 50%, #374151 100%);
                width: 100%;
                margin-left: 250px;
                transition: margin-left 0.3s ease;
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
                -webkit-backdrop-filter: blur(10px);
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

            /* Section Card */
            .section-card {
                background: var(--card-bg);
                border-radius: 16px;
                padding: 24px;
                margin: 24px 0;
                border: 1px solid var(--card-border);
                backdrop-filter: blur(8px);
                transition: all 0.3s ease;
                width: 100%;
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
                border: 1px solid var(--primary);
                color: var(--primary);
            }

            .btn-outline:hover {
                background: rgba(0, 200, 215, 0.1);
            }

            /* Main Content */
            .main-content {
                width: 100%;
                max-width: 100%;
                position: relative;
                z-index: 1;
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

            /* Responsive */
            @media (max-width: 1024px) {
                .main {
                    margin-left: 0;
                    padding-top: 80px;
                }
                
                .top-nav {
                    padding: 12px 16px;
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
                }
            }
        </style>
        @stack('styles')
    </head>
    <body>
        @include('layouts.sidebar')
        
        <div class="main">
            <!-- Top Navigation Bar -->
            <nav class="top-nav" id="topNav">
                <a href="{{ url('/') }}" class="nav-logo">{{ config('app.name', 'My App') }}</a>
            
                <div class="nav-search">
                    <input type="text" class="search-input" placeholder="Search...">
                </div>
                
                <div class="nav-user">
                    @auth
                        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                    @endauth
                </div>
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

            // Button ripple effect (fixed to not break navigation)
            document.addEventListener('DOMContentLoaded', function() {
                // Target only buttons without href attributes
                document.querySelectorAll('.btn:not([href])').forEach(button => {
                    button.addEventListener('click', function(e) {
                        // Create ripple effect
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
            });
        </script>
        
        @stack('scripts')
    </body>
</html>