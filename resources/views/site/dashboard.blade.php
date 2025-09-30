@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div id="dashboardContent">
    <!-- Hero Section with Full-Width Swiper -->
    <div class="hero-section">
        <div class="events-swiper">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @forelse($upcomingEvents as $event)
                    <div class="swiper-slide">
                        <div class="hero-event-card">
                            @if($event->images && count($event->images) > 0)
                            <img src="{{ asset('storage/'.$event->images[0]) }}" alt="{{ $event->titre }}" class="hero-bg-image">
                            @else
                            <div class="hero-bg-image placeholder"></div>
                            @endif
                            <div class="hero-content-overlay">
                                <div class="event-meta">
                                    <span class="event-date">{{ $event->date->format('M d, Y') }}</span>
                                    <span class="event-status {{ $event->status }}">{{ ucfirst($event->status) }}</span>
                                </div>
                                <h1 class="hero-title">{{ $event->titre }}</h1>
                                <p class="hero-description">{{ Str::limit($event->description, 150) }}</p>
                                <div class="event-details">
                                    @if($event->date)
                                    <span class="detail-item">⏰ {{ $event->date->format('h:i A') }}</span>
                                    @endif
                                    @if($event->lieu)
                                    <span class="detail-item">📍 {{ $event->lieu }}</span>
                                    @endif
                                </div>
                                <div class="hero-actions">
                                    @auth
                                    <a href="{{ route('evenements.show', $event->id) }}" class="btn btn-outline">See Details</a>
                                    @else
                                    <a href="{{ route('evenements.show', $event->id) }}" class="btn btn-outline">See Details</a>
                                    <a href="{{ route('payment.index', $event->id) }}" class="btn btn-primary">Inscription</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="swiper-slide">
                        <div class="no-events hero-event-card">
                            <div class="empty-state">
                                <div class="empty-icon">📅</div>
                                <h3>No upcoming events</h3>
                                <p>Check back later for new events</p>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>

    <!-- Past Experiences Section (Limited to 4 events) -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">📅</div>
            <h2 class="section-title">Recent Experiences</h2>
            @if($completedEvents->count() > 0)
            <a href="{{ route('evenements.index') }}?filter=completed" class="btn btn-outline btn-sm">
                View All
            </a>
            @endif
        </div>
        
        <div class="past-events-grid">
            @forelse($completedEvents as $event)
            <div class="past-event-card">
                @if($event->images && count($event->images) > 0)
                <img src="{{ asset('storage/'.$event->images[0]) }}" alt="{{ $event->titre }}" class="past-event-image">
                @else
                <div class="past-event-image placeholder">
                    <span class="placeholder-text">No Image</span>
                </div>
                @endif
                <div class="past-event-content">
                    <div class="event-meta">
                        <span class="event-date">{{ $event->date->format('M d, Y') }}</span>
                        <span class="event-status completed">Completed</span>
                    </div>
                    <h3 class="event-title">{{ $event->titre }}</h3>
                    <p class="event-description">{{ Str::limit($event->description, 100) }}</p>
                    <div class="event-actions">
                        <a href="{{ route('evenements.show', $event->id) }}" class="btn btn-outline">View Details</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="no-events">
                <div class="empty-state">
                    <div class="empty-icon">🏆</div>
                    <h3>No past experiences</h3>
                    <p>Your completed events will appear here</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Contact & Support Section -->
    <div class="section-card contact-section">
        <div class="section-header">
            <div class="section-icon">📞</div>
            <h2 class="section-title">Contact & Support</h2>
        </div>
        
        <div class="contact-container">
            <div class="contact-info">
                @if($aboutUs && $aboutUs->address)
                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <div>
                        <h4>Our Location</h4>
                        <p>{{ $aboutUs->address }}</p>
                    </div>
                </div>
                @endif
                
                <div class="contact-item">
                    <div class="contact-icon">📧</div>
                    <div>
                        <h4>Email Us</h4>
                        <a href="mailto:{{ $aboutUs->email ?? 'support@eventmanager.com' }}" class="contact-link">
                            {{ $aboutUs->email ?? 'support@eventmanager.com' }}
                        </a>
                    </div>
                </div>
                
                @if($aboutUs && $aboutUs->phone)
                <div class="contact-item">
                    <div class="contact-icon">📱</div>
                    <div>
                        <h4>Call Us</h4>
                        <a href="tel:{{ $aboutUs->phone }}" class="contact-link">{{ $aboutUs->phone }}</a>
                    </div>
                </div>
                @endif
                
                @if($aboutUs && $aboutUs->whatsapp)
                <div class="contact-item">
                    <div class="contact-icon whatsapp-icon">💬</div>
                    <div>
                        <h4>WhatsApp</h4>
                        <a href="https://wa.me/{{ $aboutUs->whatsapp }}" target="_blank" class="contact-link">
                            {{ $aboutUs->whatsapp }}
                        </a>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="social-links">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    @if($aboutUs && $aboutUs->facebook_url)
                    <a href="{{ $aboutUs->facebook_url }}" target="_blank" class="social-link facebook">f</a>
                    @endif
                    
                    @if($aboutUs && $aboutUs->twitter_url)
                    <a href="{{ $aboutUs->twitter_url }}" target="_blank" class="social-link twitter">𝕏</a>
                    @endif
                    
                    @if($aboutUs && $aboutUs->instagram_url)
                    <a href="{{ $aboutUs->instagram_url }}" target="_blank" class="social-link instagram">📷</a>
                    @endif
                    
                    @if($aboutUs && $aboutUs->linkedin_url)
                    <a href="{{ $aboutUs->linkedin_url }}" target="_blank" class="social-link linkedin">in</a>
                    @endif
                    
                    @if($aboutUs && $aboutUs->youtube_url)
                    <a href="{{ $aboutUs->youtube_url }}" target="_blank" class="social-link youtube">▶️</a>
                    @endif
                </div>
                
                @if($aboutUs && $aboutUs->map_link)
                <div class="map-link">
                    <a href="{{ $aboutUs->map_link }}" target="_blank" class="btn btn-outline map-btn">
                        📍 View on Map
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* Reset and Base Styles */
    * {
        box-sizing: border-box;
    }
    
    #dashboardContent {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }

    /* Button styles */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .btn-outline {
        background: transparent;
        color: white;
        border: 2px solid white;
    }

    .btn-outline:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .btn-primary {
        background: var(--primary, #007bff);
        color: white;
        border: 2px solid var(--primary, #007bff);
    }

    .btn-primary:hover {
        background: var(--primary-dark, #0056b3);
        transform: translateY(-2px);
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 12px;
    }

    /* Hero Section - Fixed */
    .hero-section {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        margin-top: -20px;
        margin-bottom: 0;
    }
    
    .events-swiper {
        width: 100%;
        height: 400px;
        position: relative;
    }
    
    .swiper-container {
        width: 100%;
        height: 100%;
        position: relative;
    }
    
    .swiper-wrapper {
        width: 100%;
        height: 100%;
    }
    
    .swiper-slide {
        width: 100%;
        height: 100%;
        position: relative;
    }
    
    .hero-event-card {
        width: 100%;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .hero-bg-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    
    .hero-bg-image.placeholder {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .hero-content-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 40px;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
        color: white;
        z-index: 2;
    }
    
    .event-meta {
        display: flex;
        gap: 16px;
        margin-bottom: 12px;
        align-items: center;
    }
    
    .event-date {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.9);
    }
    
    .event-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .event-status.scheduled {
        background: rgba(0, 200, 215, 0.2);
        color: #00c8d7;
    }
    
    .event-status.ongoing {
        background: rgba(245, 158, 11, 0.2);
        color: #f59e0b;
    }
    
    .event-status.completed {
        background: rgba(16, 185, 129, 0.2);
        color: #10b981;
    }
    
    .hero-title {
        margin: 0 0 16px;
        font-size: 36px;
        font-weight: 700;
        line-height: 1.2;
    }
    
    .hero-description {
        margin: 0 0 24px;
        font-size: 16px;
        max-width: 700px;
        line-height: 1.5;
        color: rgba(255, 255, 255, 0.9);
    }
    
    .event-details {
        display: flex;
        gap: 24px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }
    
    .detail-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.9);
    }
    
    .hero-actions {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }
    
    /* Swiper Navigation */
    .swiper-button-prev,
    .swiper-button-next {
        color: white;
        background: rgba(0, 0, 0, 0.5);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        transition: all 0.3s ease;
        margin-top: -25px;
    }
    
    .swiper-button-prev:after,
    .swiper-button-next:after {
        font-size: 20px;
        font-weight: bold;
    }
    
    .swiper-button-prev:hover,
    .swiper-button-next:hover {
        background: rgba(0, 0, 0, 0.8);
        transform: scale(1.1);
    }
    
    .swiper-pagination {
        bottom: 20px !important;
    }
    
    .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.5);
        opacity: 1;
        width: 10px;
        height: 10px;
    }
    
    .swiper-pagination-bullet-active {
        background: white;
    }
    
    /* Past Events Grid - Limited to 4 items */
    .past-events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        width: 100%;
    }

    /* Responsive grid for exactly 4 items */
    @media (min-width: 1200px) {
        .past-events-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 1199px) and (min-width: 768px) {
        .past-events-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 767px) {
        .past-events-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .past-event-card {
        border-radius: 12px;
        overflow: hidden;
        background: var(--secondary, #f8f9fa);
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .past-event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
    
    .past-event-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
    }
    
    .past-event-image.placeholder {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.6);
    }

    .placeholder-text {
        color: rgba(255, 255, 255, 0.6);
        font-size: 14px;
    }
    
    .past-event-content {
        padding: 16px;
    }

    .event-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }
    
    /* Contact Section */
    .contact-container {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        width: 100%;
    }
    
    .contact-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .contact-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .contact-item:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-3px);
    }
    
    .contact-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary-light, rgba(0, 123, 255, 0.1));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: var(--primary, #007bff);
    }
    
    .whatsapp-icon {
        background: rgba(37, 211, 102, 0.2);
        color: #25d366;
    }
    
    .contact-link {
        color: var(--primary, #007bff);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .contact-link:hover {
        color: var(--primary-dark, #0056b3);
        text-decoration: underline;
    }
    
    .social-icons {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .social-link:hover {
        transform: translateY(-3px) scale(1.1);
    }
    
    .facebook { background: #1877f2; }
    .twitter { background: #1da1f2; }
    .instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
    .linkedin { background: #2867B2; }
    .youtube { background: #ff0000; }
    
    /* Empty States */
    .no-events {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        background: var(--secondary, #f8f9fa);
    }
    
    .empty-state {
        text-align: center;
        padding: 40px;
    }
    
    .empty-icon {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    /* Text center utility */
    .text-center {
        text-align: center;
    }

    .mt-4 {
        margin-top: 16px;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            margin: 0 -15px;
            margin-top: -15px;
            width: calc(100% + 30px);
            left: -15px;
            right: -15px;
            margin-left: 0;
            margin-right: 0;
        }
        
        .events-swiper {
            height: 300px;
        }
        
        .hero-content-overlay {
            padding: 20px;
        }
        
        .hero-title {
            font-size: 24px;
            margin-bottom: 12px;
        }
        
        .hero-description {
            font-size: 14px;
            margin-bottom: 16px;
        }
        
        .event-details {
            gap: 12px;
            margin-bottom: 16px;
        }
        
        .hero-actions {
            flex-direction: column;
            gap: 10px;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
        
        .swiper-button-prev,
        .swiper-button-next {
            display: none;
        }
        
        .contact-info {
            grid-template-columns: 1fr;
        }
        
        .past-events-grid {
            grid-template-columns: 1fr;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
    }

    @media (max-width: 480px) {
        .events-swiper {
            height: 250px;
        }
        
        .hero-title {
            font-size: 20px;
        }
        
        .event-details {
            flex-direction: column;
            gap: 8px;
        }
        
        .event-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
    }
</style>

<!-- Swiper JS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Swiper with proper configuration
    const swiper = new Swiper('.swiper-container', {
        // Essential parameters
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        centeredSlides: true,
        
        // Autoplay
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        
        // Pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        
        // Navigation
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        
        // Effects - Using simple slide instead of fade to avoid issues
        effect: 'slide',
        speed: 600,
        
        // Prevent conflicts
        observer: true,
        observeParents: true,
        resistance: true,
        resistanceRatio: 0,
        
        // Touch interactions
        touchRatio: 1,
        touchAngle: 45,
        grabCursor: true,
        
        on: {
            init: function () {
                console.log('Swiper initialized successfully');
            },
            slideChange: function () {
                console.log('Slide changed to: ', this.activeIndex);
            }
        }
    });

    // Add hover effects to cards
    const cards = document.querySelectorAll('.past-event-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Handle image loading
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '1';
        });
        
        // Set initial opacity for smooth loading
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.3s ease';
        
        // If image is already loaded
        if (img.complete) {
            img.style.opacity = '1';
        }
    });
});
</script>
@endsection