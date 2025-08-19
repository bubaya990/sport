@extends('layouts.app')

@section('content')
<div class="about-container">
    <!-- Admin Edit Button -->
    @if(auth()->check() && auth()->user()->role === 'admin')
    <div class="admin-controls">
        <a href="{{ route('aboutus.edit') }}" class="btn btn-primary edit-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path d="m18.5 2.5 a2.83 2.83 0 0 1 4 4L13 16l-4 1 1-4L18.5 2.5z"></path>
            </svg>
            Edit About Us
        </a>
    </div>
    @endif
    
    <!-- Hero Section -->
    <div class="hero-section section-card">
        @if($aboutUs->main_image)
        <div class="hero-image-container">
            <img src="{{ $aboutUs->main_image_url }}" alt="{{ $aboutUs->company_name }}" class="hero-image">
            <div class="hero-overlay"></div>
        </div>
        @endif
        
        <div class="hero-content">
            <div class="company-badge">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9,22 9,12 15,12 15,22"></polyline>
                </svg>
                Company
            </div>
            <h1 class="hero-title">{{ $aboutUs->company_name }}</h1>
            <p class="hero-description">{{ $aboutUs->description }}</p>
        </div>
    </div>
    
    <!-- Mission & Vision -->
    <div class="mission-vision-grid">
        @if($aboutUs->mission)
        <div class="section-card mission-card">
            <div class="section-header">
                <div class="section-icon mission-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="m12 1 7 7-7 7-7-7z"></path>
                        <path d="m21 21-6-6m6 6v-4.8m0 4.8h-4.8"></path>
                    </svg>
                </div>
                <h2 class="section-title">Notre Mission</h2>
            </div>
            <p class="mission-text">{{ $aboutUs->mission }}</p>
        </div>
        @endif
        
        @if($aboutUs->vision)
        <div class="section-card vision-card">
            <div class="section-header">
                <div class="section-icon vision-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </div>
                <h2 class="section-title">Notre Vision</h2>
            </div>
            <p class="vision-text">{{ $aboutUs->vision }}</p>
        </div>
        @endif
    </div>
    
    <!-- Gallery Section -->
    @if(count($aboutUs->gallery_urls) > 0)
    <div class="section-card gallery-section">
        <div class="section-header">
            <div class="section-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21,15 16,10 5,21"></polyline>
                </svg>
            </div>
            <h2 class="section-title">Galerie</h2>
        </div>
        
        <div class="gallery-grid">
            @foreach($aboutUs->gallery_urls as $index => $image)
            <div class="gallery-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <a href="{{ $image }}" data-lightbox="gallery" class="gallery-link">
                    <img src="{{ $image }}" alt="Gallery Image {{ $index + 1 }}" class="gallery-image">
                    <div class="gallery-overlay">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                            <path d="M11 8v6"></path>
                            <path d="M8 11h6"></path>
                        </svg>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    
    <!-- Contact Section -->
    <div class="section-card contact-section">
        <div class="section-header">
            <div class="section-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
            </div>
            <h2 class="section-title">Contactez-nous</h2>
        </div>
        
        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info">
                <h3 class="contact-subtitle">Coordonnées</h3>
                <div class="contact-items">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">Adresse</span>
                            <span class="contact-value">{{ $aboutUs->address }}</span>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">Téléphone</span>
                            <a href="tel:{{ $aboutUs->phone }}" class="contact-value contact-link">{{ $aboutUs->phone }}</a>
                        </div>
                    </div>
                    
                    @if($aboutUs->whatsapp)
                    <div class="contact-item">
                        <div class="contact-icon whatsapp">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">WhatsApp</span>
                            <a href="https://wa.me/{{ $aboutUs->whatsapp }}" target="_blank" class="contact-value contact-link">{{ $aboutUs->whatsapp }}</a>
                        </div>
                    </div>
                    @endif
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">Email</span>
                            <a href="mailto:{{ $aboutUs->email }}" class="contact-value contact-link">{{ $aboutUs->email }}</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Social Links -->
            <div class="social-section">
                <h3 class="contact-subtitle">Réseaux Sociaux</h3>
                <div class="social-links">
                    @if($aboutUs->facebook_url)
                    <a href="{{ $aboutUs->facebook_url }}" target="_blank" class="social-link facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        Facebook
                    </a>
                    @endif
                    
                    @if($aboutUs->instagram_url)
                    <a href="{{ $aboutUs->instagram_url }}" target="_blank" class="social-link instagram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                        Instagram
                    </a>
                    @endif
                    
                    @if($aboutUs->twitter_url)
                    <a href="{{ $aboutUs->twitter_url }}" target="_blank" class="social-link twitter">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                        Twitter
                    </a>
                    @endif
                    
                    @if($aboutUs->linkedin_url)
                    <a href="{{ $aboutUs->linkedin_url }}" target="_blank" class="social-link linkedin">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                        LinkedIn
                    </a>
                    @endif
                </div>
                
                @if($aboutUs->map_link)
                <div class="map-link-container">
                    <a href="{{ $aboutUs->map_link }}" target="_blank" class="btn btn-outline map-btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        Voir sur la carte
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .about-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .admin-controls {
        position: fixed;
        top: 100px;
        right: 30px;
        z-index: 50;
    }

    .edit-btn {
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(0, 200, 215, 0.3);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    /* Hero Section */
    .hero-section {
        position: relative;
        min-height: 400px;
        overflow: hidden;
        margin-bottom: 40px;
        border-radius: 24px;
    }

    .hero-image-container {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s ease;
    }

    .hero-section:hover .hero-image {
        transform: scale(1.05);
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 200, 215, 0.3) 100%);
        z-index: 2;
    }

    .hero-content {
        position: relative;
        z-index: 3;
        padding: 60px 40px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: white;
    }

    .company-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: rgba(0, 200, 215, 0.2);
        border: 1px solid rgba(0, 200, 215, 0.3);
        border-radius: 50px;
        font-size: 14px;
        font-weight: 500;
        width: fit-content;
        margin-bottom: 24px;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 24px;
        background: linear-gradient(135deg, #ffffff 0%, var(--primary) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1.1;
    }

    .hero-description {
        font-size: 1.2rem;
        line-height: 1.6;
        opacity: 0.9;
        max-width: 600px;
    }

    /* Mission & Vision Grid */
    .mission-vision-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .mission-card, .vision-card {
        position: relative;
        overflow: hidden;
    }

    .mission-card::before, .vision-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        border-radius: 16px 16px 0 0;
    }

    .mission-icon {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .vision-icon {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    }

    .mission-text, .vision-text {
        font-size: 1.1rem;
        line-height: 1.7;
        color: var(--text-secondary);
    }

    /* Gallery Section */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .gallery-item {
        position: relative;
        aspect-ratio: 1;
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.4s ease;
    }

    .gallery-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .gallery-link {
        display: block;
        width: 100%;
        height: 100%;
        position: relative;
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .gallery-item:hover .gallery-image {
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 200, 215, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-overlay svg {
        color: white;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    }

    /* Contact Section */
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        margin-top: 30px;
    }

    .contact-subtitle {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 24px;
        color: var(--primary);
    }

    .contact-items {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 20px;
        background: rgba(0, 200, 215, 0.05);
        border-radius: 12px;
        border: 1px solid rgba(0, 200, 215, 0.1);
        transition: all 0.3s ease;
    }

    .contact-item:hover {
        background: rgba(0, 200, 215, 0.1);
        border-color: rgba(0, 200, 215, 0.2);
        transform: translateX(4px);
    }

    .contact-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
    }

    .contact-icon.whatsapp {
        background: linear-gradient(135deg, #25d366, #128c7e);
    }

    .contact-details {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .contact-label {
        font-size: 0.9rem;
        color: var(--text-secondary);
        font-weight: 500;
    }

    .contact-value {
        font-size: 1rem;
        color: var(--text);
        font-weight: 600;
    }

    .contact-link {
        color: var(--primary);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .contact-link:hover {
        color: var(--primary-light);
        text-decoration: underline;
    }

    /* Social Links */
    .social-links {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 30px;
    }

    .social-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        background: rgba(255, 255, 255, 0.05);
        color: var(--text);
    }

    .social-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .social-link.facebook {
        border-color: rgba(66, 103, 178, 0.3);
    }

    .social-link.facebook:hover {
        background: linear-gradient(135deg, #4267B2, #365899);
        border-color: #4267B2;
    }

    .social-link.instagram {
        border-color: rgba(225, 48, 108, 0.3);
    }

    .social-link.instagram:hover {
        background: linear-gradient(135deg, #E1306C, #C13584, #833AB4);
        border-color: #E1306C;
    }

    .social-link.twitter {
        border-color: rgba(29, 161, 242, 0.3);
    }

    .social-link.twitter:hover {
        background: linear-gradient(135deg, #1DA1F2, #0d8bd9);
        border-color: #1DA1F2;
    }

    .social-link.linkedin {
        border-color: rgba(40, 103, 178, 0.3);
    }

    .social-link.linkedin:hover {
        background: linear-gradient(135deg, #2867B2, #1e5085);
        border-color: #2867B2;
    }

    .map-link-container {
        margin-top: 20px;
    }

    .map-btn {
        width: 100%;
        padding: 16px;
        border-radius: 12px;
        font-weight: 600;
        background: rgba(0, 200, 215, 0.1);
        border: 2px solid rgba(0, 200, 215, 0.3);
        color: var(--primary);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .map-btn:hover {
        background: rgba(0, 200, 215, 0.2);
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 200, 215, 0.2);
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .section-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .section-card:nth-child(2) { animation-delay: 0.1s; }
    .section-card:nth-child(3) { animation-delay: 0.2s; }
    .section-card:nth-child(4) { animation-delay: 0.3s; }
    .section-card:nth-child(5) { animation-delay: 0.4s; }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .about-container {
            padding: 15px;
        }

        .admin-controls {
            top: 80px;
            right: 15px;
        }

        .hero-title {
            font-size: 2.8rem;
        }

        .mission-vision-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .contact-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }
    }

    @media (max-width: 768px) {
        .hero-content {
            padding: 40px 20px;
            text-align: center;
        }

        .hero-title {
            font-size: 2.2rem;
            margin-bottom: 16px;
        }

        .hero-description {
            font-size: 1rem;
        }

        .mission-vision-grid {
            grid-template-columns: 1fr;
        }

        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
        }

        .contact-item {
            padding: 16px;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
        }

        .social-links {
            gap: 10px;
        }

        .social-link {
            padding: 12px 16px;
            font-size: 0.9rem;
        }

        .section-card {
            padding: 20px;
        }

        .admin-controls {
            position: static;
            margin-bottom: 20px;
        }

        .edit-btn {
            padding: 10px 20px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        .about-container {
            padding: 10px;
        }

        .hero-title {
            font-size: 1.8rem;
        }

        .hero-description {
            font-size: 0.95rem;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .section-icon {
            width: 40px;
            height: 40px;
        }

        .section-title {
            font-size: 1.4rem;
        }

        .gallery-grid {
            grid-template-columns: 1fr 1fr;
        }

        .contact-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .contact-details {
            width: 100%;
        }
    }

    /* Smooth scrolling and focus states */
    html {
        scroll-behavior: smooth;
    }

    .btn:focus,
    .social-link:focus,
    .contact-link:focus {
        outline: 2px solid var(--primary);
        outline-offset: 2px;
    }

    /* Loading animation for images */
    .gallery-image,
    .hero-image {
        background: linear-gradient(90deg, 
            rgba(0, 200, 215, 0.1) 0%, 
            rgba(0, 200, 215, 0.2) 50%, 
            rgba(0, 200, 215, 0.1) 100%);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .gallery-image[src],
    .hero-image[src] {
        animation: none;
        background: none;
    }

    /* Enhanced hover effects */
    .section-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        border-color: rgba(0, 200, 215, 0.25);
    }

    /* Glowing border animation */
    .hero-section::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, 
            var(--primary), 
            var(--primary-dark), 
            var(--primary), 
            var(--primary-dark));
        border-radius: 26px;
        z-index: -1;
        background-size: 400% 400%;
        animation: gradientShift 4s ease infinite;
        opacity: 0.3;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Accessibility improvements */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
        
        .gallery-image,
        .hero-image {
            transform: none !important;
        }
    }

    /* Print styles */
    @media print {
        .admin-controls,
        .social-links,
        .map-link-container {
            display: none;
        }
        
        .section-card {
            break-inside: avoid;
            box-shadow: none;
            border: 1px solid #ddd;
        }
    }
</style>
@endpush

@push('scripts')
<!-- Lightbox CSS & JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced lightbox configuration
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'albumLabel': 'Image %1 sur %2',
        'fadeDuration': 300,
        'imageFadeDuration': 300
    });

    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all section cards
    document.querySelectorAll('.section-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });

    // Observe gallery items
    document.querySelectorAll('.gallery-item').forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = `opacity 0.5s ease ${index * 0.1}s, transform 0.5s ease ${index * 0.1}s`;
        observer.observe(item);
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add loading states for images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        if (!img.complete) {
            img.addEventListener('load', function() {
                this.style.opacity = '1';
            });
            img.style.opacity = '0';
            img.style.transition = 'opacity 0.3s ease';
        }
    });

    // Enhanced contact item interactions
    document.querySelectorAll('.contact-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(8px) scale(1.02)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0) scale(1)';
        });
    });

    // Social link enhanced hover effects
    document.querySelectorAll('.social-link').forEach(link => {
        link.addEventListener('mouseenter', function() {
            const icon = this.querySelector('svg');
            if (icon) {
                icon.style.transform = 'scale(1.2) rotate(5deg)';
                icon.style.transition = 'transform 0.3s ease';
            }
        });
        
        link.addEventListener('mouseleave', function() {
            const icon = this.querySelector('svg');
            if (icon) {
                icon.style.transform = 'scale(1) rotate(0deg)';
            }
        });
    });

    // Parallax effect for hero section
    window.addEventListener('scroll', function() {
        const heroImage = document.querySelector('.hero-image');
        if (heroImage) {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            heroImage.style.transform = `translateY(${rate}px)`;
        }
    });

    // Add ripple effect to buttons
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            `;
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 600);
        });
    });
});
</script>
@endpush