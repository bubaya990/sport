@extends('layouts.app')

@section('title', 'Inscription à un Événement')

@section('content')
<div class="payment-container">
    <div class="payment-card">
        <div class="payment-header">
            <h1 class="payment-title">Inscription à un Événement</h1>
            <p class="payment-subtitle">Remplissez le formulaire ci-dessous pour vous inscrire à un événement</p>
        </div>

        <form action="{{ route('payment.process') }}" method="POST" class="payment-form">
            @csrf
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="error-list">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-section">
                <h2 class="section-title">Sélection de l'Événement</h2>
                
                <div class="form-group">
                    <label for="evenement_id" class="form-label">Événement *</label>
                    <select name="evenement_id" id="evenement_id" class="form-select" required>
                        <option value="">Sélectionnez un événement</option>
                        @foreach($activeEvents as $activeEvent)
                            <option value="{{ $activeEvent->id }}" 
                                {{ $event && $event->id == $activeEvent->id ? 'selected' : '' }}
                                data-price="{{ $activeEvent->prix }}">
                                {{ $activeEvent->titre }} - {{ $activeEvent->prix }} DA
                                ({{ $activeEvent->date->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="event-details" id="eventDetails">
                    @if($event)
                        <div class="event-card-preview">
                            <h3>{{ $event->titre }}</h3>
                            <p class="event-description">{{ $event->description }}</p>
                            <div class="event-meta">
                                <span class="event-date">📅 {{ $event->date->format('d M Y') }}</span>
                                <span class="event-price">💰 {{ $event->prix }} DA</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title">Informations Personnelles</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="nom" class="form-label">Nom *</label>
                        <input type="text" name="nom" id="nom" class="form-input" 
                               value="{{ old('nom') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="prenom" class="form-label">Prénom *</label>
                        <input type="text" name="prenom" id="prenom" class="form-input" 
                               value="{{ old('prenom') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="telephone" class="form-label">Téléphone *</label>
                    <input type="tel" name="telephone" id="telephone" class="form-input" 
                           value="{{ old('telephone') }}" required>
                </div>

                <div class="form-group">
                    <label for="adresse" class="form-label">Adresse *</label>
                    <textarea name="adresse" id="adresse" class="form-textarea" 
                              required>{{ old('adresse') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="date_naissance" class="form-label">Date de Naissance *</label>
                        <input type="date" name="date_naissance" id="date_naissance" 
                               class="form-input" value="{{ old('date_naissance') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="ville" class="form-label">Ville *</label>
                        <input type="text" name="ville" id="ville" class="form-input" 
                               value="{{ old('ville') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="profession" class="form-label">Profession *</label>
                    <input type="text" name="profession" id="profession" class="form-input" 
                           value="{{ old('profession') }}" required>
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title">Méthode de Paiement</h2>
                
                <div class="payment-methods">
                    <label class="payment-method">
                        <input type="radio" name="type_paiement" value="visa" 
                               {{ old('type_paiement') == 'visa' ? 'checked' : '' }} required>
                        <div class="method-card">
                            <div class="method-icon">💳</div>
                            <div class="method-info">
                                <h4>Carte Visa</h4>
                                <p>Paiement sécurisé par carte bancaire</p>
                            </div>
                        </div>
                    </label>
                    
                    <label class="payment-method">
                        <input type="radio" name="type_paiement" value="poste" 
                               {{ old('type_paiement') == 'poste' ? 'checked' : '' }}>
                        <div class="method-card">
                            <div class="method-icon">🏣</div>
                            <div class="method-info">
                                <h4>Poste Algérienne</h4>
                                <p>Paiement via les services postaux</p>
                            </div>
                        </div>
                    </label>
                    
                    <label class="payment-method">
                        <input type="radio" name="type_paiement" value="carte_dor" 
                               {{ old('type_paiement') == 'carte_dor' ? 'checked' : '' }}>
                        <div class="method-card">
                            <div class="method-icon">🪪</div>
                            <div class="method-info">
                                <h4>Carte Dor</h4>
                                <p>Paiement avec carte de crédit locale</p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-payment">
                    <span class="btn-text">Procéder au Paiement</span>
                    <span class="btn-price" id="paymentPrice">
                        @if($event)
                            {{ $event->prix }} DA
                        @else
                            0 DA
                        @endif
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .payment-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .payment-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .payment-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 40px;
        text-align: center;
    }

    .payment-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .payment-subtitle {
        opacity: 0.9;
        font-size: 1.1rem;
    }

    .payment-form {
        padding: 40px;
    }

    .form-section {
        margin-bottom: 40px;
        padding-bottom: 30px;
        border-bottom: 2px solid #f3f4f6;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::before {
        content: "";
        width: 8px;
        height: 24px;
        background: var(--primary);
        border-radius: 4px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
    }

    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 200, 215, 0.1);
    }

    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }

    .event-details {
        margin-top: 20px;
    }

    .event-card-preview {
        background: #f8fafc;
        padding: 20px;
        border-radius: 12px;
        border-left: 4px solid var(--primary);
    }

    .event-card-preview h3 {
        margin: 0 0 10px;
        color: var(--primary-dark);
    }

    .event-description {
        margin: 0 0 15px;
        color: #6b7280;
        line-height: 1.5;
    }

    .event-meta {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .event-date, .event-price {
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
    }

    .payment-methods {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .payment-method {
        cursor: pointer;
    }

    .payment-method input {
        display: none;
    }

    .payment-method input:checked + .method-card {
        border-color: var(--primary);
        background: rgba(0, 200, 215, 0.05);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 200, 215, 0.15);
    }

    .method-card {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .method-card:hover {
        border-color: var(--primary-light);
    }

    .method-icon {
        font-size: 2rem;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .method-info h4 {
        margin: 0 0 4px;
        color: #1f2937;
    }

    .method-info p {
        margin: 0;
        color: #6b7280;
        font-size: 0.9rem;
    }

    .form-actions {
        text-align: center;
        margin-top: 40px;
    }

    .btn-payment {
        display: inline-flex;
        align-items: center;
        gap: 20px;
        padding: 16px 32px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .btn-price {
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
    }

    .alert {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #dc2626;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
    }

    .error-list {
        margin: 0;
        padding-left: 20px;
    }

    .error-list li {
        margin-bottom: 4px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const eventSelect = document.getElementById('evenement_id');
        const eventDetails = document.getElementById('eventDetails');
        const paymentPrice = document.getElementById('paymentPrice');
        
        // Get event details via AJAX
        function loadEventDetails(eventId) {
            if (!eventId) {
                eventDetails.innerHTML = '';
                paymentPrice.textContent = '0 DA';
                return;
            }
            
            fetch(`/api/events/${eventId}`)
                .then(response => response.json())
                .then(event => {
                    eventDetails.innerHTML = `
                        <div class="event-card-preview">
                            <h3>${event.titre}</h3>
                            <p class="event-description">${event.description}</p>
                            <div class="event-meta">
                                <span class="event-date">📅 ${new Date(event.date).toLocaleDateString('fr-FR', { 
                                    day: 'numeric', 
                                    month: 'long', 
                                    year: 'numeric' 
                                })}</span>
                                <span class="event-price">💰 ${event.prix} DA</span>
                            </div>
                        </div>
                    `;
                    
                    paymentPrice.textContent = `${event.prix} DA`;
                })
                .catch(error => {
                    console.error('Error loading event details:', error);
                    eventDetails.innerHTML = '<p class="text-danger">Erreur lors du chargement des détails</p>';
                });
        }
        
        // Event selection change
        eventSelect.addEventListener('change', function() {
            loadEventDetails(this.value);
        });
        
        // Initialize if event is preselected
        @if($event)
            loadEventDetails({{ $event->id }});
        @endif
    });
</script>
@endsection