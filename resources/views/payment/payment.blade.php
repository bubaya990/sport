@extends('layouts.app')

@section('title', 'Inscription à un Événement')

@section('content')
<div class="payment-container">
    <div class="payment-card">
        <div class="payment-header">
            <h1 class="payment-title">Inscription à un Événement</h1>
            <p class="payment-subtitle">Remplissez le formulaire ci-dessous pour vous inscrire à un événement</p>
        </div>

        <form action="{{ route('payment.process') }}" method="POST" class="payment-form" id="paymentForm">
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
                                data-price="{{ $activeEvent->prix }}"
                                data-description="{{ $activeEvent->description }}"
                                data-date="{{ $activeEvent->date->format('d/m/Y') }}">
                                {{ $activeEvent->titre }} - {{ number_format($activeEvent->prix, 0, ',', ' ') }} DA
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
                                <span class="event-price">💰 {{ number_format($event->prix, 0, ',', ' ') }} DA</span>
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

                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" name="email" id="email" class="form-input" 
                               value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telephone" class="form-label">Téléphone *</label>
                        <input type="tel" name="telephone" id="telephone" class="form-input" 
                               value="{{ old('telephone') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="adresse" class="form-label">Adresse complète *</label>
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
                        <label for="nationalite" class="form-label">Nationalité *</label>
                        <select name="nationalite" id="nationalite" class="form-select" required>
                            <option value="">Sélectionnez votre nationalité</option>
                            <option value="Algérie" {{ old('nationalite') == 'Algérie' ? 'selected' : '' }}>Algérie</option>
                            <option value="France" {{ old('nationalite') == 'France' ? 'selected' : '' }}>France</option>
                            <option value="Tunisie" {{ old('nationalite') == 'Tunisie' ? 'selected' : '' }}>Tunisie</option>
                            <option value="Maroc" {{ old('nationalite') == 'Maroc' ? 'selected' : '' }}>Maroc</option>
                            <option value="Autre" {{ old('nationalite') == 'Autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                    </div>
                </div>

                <!-- Wilaya field - only for Algerians -->
                <div class="form-group" id="wilaya-group" style="display: none;">
                    <label for="wilaya" class="form-label">Wilaya *</label>
                    <select name="wilaya" id="wilaya" class="form-select">
                        <option value="">Sélectionnez votre wilaya</option>
                        <option value="Adrar" {{ old('wilaya') == 'Adrar' ? 'selected' : '' }}>Adrar</option>
                        <option value="Chlef" {{ old('wilaya') == 'Chlef' ? 'selected' : '' }}>Chlef</option>
                        <option value="Laghouat" {{ old('wilaya') == 'Laghouat' ? 'selected' : '' }}>Laghouat</option>
                        <option value="Oum El Bouaghi" {{ old('wilaya') == 'Oum El Bouaghi' ? 'selected' : '' }}>Oum El Bouaghi</option>
                        <option value="Batna" {{ old('wilaya') == 'Batna' ? 'selected' : '' }}>Batna</option>
                        <option value="Béjaïa" {{ old('wilaya') == 'Béjaïa' ? 'selected' : '' }}>Béjaïa</option>
                        <option value="Biskra" {{ old('wilaya') == 'Biskra' ? 'selected' : '' }}>Biskra</option>
                        <option value="Béchar" {{ old('wilaya') == 'Béchar' ? 'selected' : '' }}>Béchar</option>
                        <option value="Blida" {{ old('wilaya') == 'Blida' ? 'selected' : '' }}>Blida</option>
                        <option value="Bouira" {{ old('wilaya') == 'Bouira' ? 'selected' : '' }}>Bouira</option>
                        <option value="Tamanrasset" {{ old('wilaya') == 'Tamanrasset' ? 'selected' : '' }}>Tamanrasset</option>
                        <option value="Tébessa" {{ old('wilaya') == 'Tébessa' ? 'selected' : '' }}>Tébessa</option>
                        <option value="Tlemcen" {{ old('wilaya') == 'Tlemcen' ? 'selected' : '' }}>Tlemcen</option>
                        <option value="Tiaret" {{ old('wilaya') == 'Tiaret' ? 'selected' : '' }}>Tiaret</option>
                        <option value="Tizi Ouzou" {{ old('wilaya') == 'Tizi Ouzou' ? 'selected' : '' }}>Tizi Ouzou</option>
                        <option value="Alger" {{ old('wilaya') == 'Alger' ? 'selected' : '' }}>Alger</option>
                        <option value="Djelfa" {{ old('wilaya') == 'Djelfa' ? 'selected' : '' }}>Djelfa</option>
                        <option value="Jijel" {{ old('wilaya') == 'Jijel' ? 'selected' : '' }}>Jijel</option>
                        <option value="Sétif" {{ old('wilaya') == 'Sétif' ? 'selected' : '' }}>Sétif</option>
                        <option value="Saïda" {{ old('wilaya') == 'Saïda' ? 'selected' : '' }}>Saïda</option>
                        <option value="Skikda" {{ old('wilaya') == 'Skikda' ? 'selected' : '' }}>Skikda</option>
                        <option value="Sidi Bel Abbès" {{ old('wilaya') == 'Sidi Bel Abbès' ? 'selected' : '' }}>Sidi Bel Abbès</option>
                        <option value="Annaba" {{ old('wilaya') == 'Annaba' ? 'selected' : '' }}>Annaba</option>
                        <option value="Guelma" {{ old('wilaya') == 'Guelma' ? 'selected' : '' }}>Guelma</option>
                        <option value="Constantine" {{ old('wilaya') == 'Constantine' ? 'selected' : '' }}>Constantine</option>
                        <option value="Médéa" {{ old('wilaya') == 'Médéa' ? 'selected' : '' }}>Médéa</option>
                        <option value="Mostaganem" {{ old('wilaya') == 'Mostaganem' ? 'selected' : '' }}>Mostaganem</option>
                        <option value="M'Sila" {{ old('wilaya') == 'M\'Sila' ? 'selected' : '' }}>M'Sila</option>
                        <option value="Mascara" {{ old('wilaya') == 'Mascara' ? 'selected' : '' }}>Mascara</option>
                        <option value="Ouargla" {{ old('wilaya') == 'Ouargla' ? 'selected' : '' }}>Ouargla</option>
                        <option value="Oran" {{ old('wilaya') == 'Oran' ? 'selected' : '' }}>Oran</option>
                        <option value="El Bayadh" {{ old('wilaya') == 'El Bayadh' ? 'selected' : '' }}>El Bayadh</option>
                        <option value="Illizi" {{ old('wilaya') == 'Illizi' ? 'selected' : '' }}>Illizi</option>
                        <option value="Bordj Bou Arréridj" {{ old('wilaya') == 'Bordj Bou Arréridj' ? 'selected' : '' }}>Bordj Bou Arréridj</option>
                        <option value="Boumerdès" {{ old('wilaya') == 'Boumerdès' ? 'selected' : '' }}>Boumerdès</option>
                        <option value="El Tarf" {{ old('wilaya') == 'El Tarf' ? 'selected' : '' }}>El Tarf</option>
                        <option value="Tindouf" {{ old('wilaya') == 'Tindouf' ? 'selected' : '' }}>Tindouf</option>
                        <option value="Tissemsilt" {{ old('wilaya') == 'Tissemsilt' ? 'selected' : '' }}>Tissemsilt</option>
                        <option value="El Oued" {{ old('wilaya') == 'El Oued' ? 'selected' : '' }}>El Oued</option>
                        <option value="Khenchela" {{ old('wilaya') == 'Khenchela' ? 'selected' : '' }}>Khenchela</option>
                        <option value="Souk Ahras" {{ old('wilaya') == 'Souk Ahras' ? 'selected' : '' }}>Souk Ahras</option>
                        <option value="Tipaza" {{ old('wilaya') == 'Tipaza' ? 'selected' : '' }}>Tipaza</option>
                        <option value="Mila" {{ old('wilaya') == 'Mila' ? 'selected' : '' }}>Mila</option>
                        <option value="Aïn Defla" {{ old('wilaya') == 'Aïn Defla' ? 'selected' : '' }}>Aïn Defla</option>
                        <option value="Naâma" {{ old('wilaya') == 'Naâma' ? 'selected' : '' }}>Naâma</option>
                        <option value="Aïn Témouchent" {{ old('wilaya') == 'Aïn Témouchent' ? 'selected' : '' }}>Aïn Témouchent</option>
                        <option value="Ghardaïa" {{ old('wilaya') == 'Ghardaïa' ? 'selected' : '' }}>Ghardaïa</option>
                        <option value="Relizane" {{ old('wilaya') == 'Relizane' ? 'selected' : '' }}>Relizane</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="sexe" class="form-label">Sexe *</label>
                        <select name="sexe" id="sexe" class="form-select" required>
                            <option value="">Sélectionnez votre sexe</option>
                            <option value="homme" {{ old('sexe') == 'homme' ? 'selected' : '' }}>Homme</option>
                            <option value="femme" {{ old('sexe') == 'femme' ? 'selected' : '' }}>Femme</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="taille_maillot" class="form-label">Taille de maillot *</label>
                        <select name="taille_maillot" id="taille_maillot" class="form-select" required>
                            <option value="">Sélectionnez votre taille</option>
                            <option value="S" {{ old('taille_maillot') == 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ old('taille_maillot') == 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ old('taille_maillot') == 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ old('taille_maillot') == 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ old('taille_maillot') == 'XXL' ? 'selected' : '' }}>XXL</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="club" class="form-label">Club (si applicable)</label>
                    <input type="text" name="club" id="club" class="form-input" 
                           value="{{ old('club') }}" placeholder="Nom de votre club">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="affilie_federation" class="form-label">Affilié à la Fédération *</label>
                        <select name="affilie_federation" id="affilie_federation" class="form-select" required>
                            <option value="">Sélectionnez une option</option>
                            <option value="oui" {{ old('affilie_federation') == 'oui' ? 'selected' : '' }}>OUI</option>
                            <option value="non" {{ old('affilie_federation') == 'non' ? 'selected' : '' }}>NON</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id="numero_licence_group" style="display: none;">
                        <label for="numero_licence" class="form-label">Numéro de licence *</label>
                        <input type="text" name="numero_licence" id="numero_licence" class="form-input" 
                               value="{{ old('numero_licence') }}" placeholder="Votre numéro de licence">
                    </div>
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
                            {{ number_format($event->prix, 0, ',', ' ') }} DA
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
    /* Your existing CSS styles remain the same */
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
        border: none;
        cursor: pointer;
        background: var(--primary);
        color: white;
    }

    .btn-payment:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
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
        const nationaliteSelect = document.getElementById('nationalite');
        const wilayaGroup = document.getElementById('wilaya-group');
        const wilayaSelect = document.getElementById('wilaya');
        const affilieFederationSelect = document.getElementById('affilie_federation');
        const numeroLicenceGroup = document.getElementById('numero_licence_group');
        const numeroLicenceInput = document.getElementById('numero_licence');
        const paymentForm = document.getElementById('paymentForm');
        
        // Get event details from selected option
        function loadEventDetails(eventId) {
            if (!eventId) {
                eventDetails.innerHTML = '';
                paymentPrice.textContent = '0 DA';
                return;
            }
            
            const selectedOption = eventSelect.options[eventSelect.selectedIndex];
            if (selectedOption && selectedOption.value) {
                const eventPrice = selectedOption.getAttribute('data-price');
                const eventDescription = selectedOption.getAttribute('data-description');
                const eventDate = selectedOption.getAttribute('data-date');
                const optionText = selectedOption.textContent;
                
                const titleMatch = optionText.match(/(.*?) - \d+/);
                const eventTitle = titleMatch ? titleMatch[1] : 'Événement';
                
                eventDetails.innerHTML = `
                    <div class="event-card-preview">
                        <h3>${eventTitle}</h3>
                        <p class="event-description">${eventDescription || 'Aucune description disponible.'}</p>
                        <div class="event-meta">
                            <span class="event-date">📅 ${eventDate}</span>
                            <span class="event-price">💰 ${parseInt(eventPrice).toLocaleString('fr-FR')} DA</span>
                        </div>
                    </div>
                `;
                
                paymentPrice.textContent = `${parseInt(eventPrice).toLocaleString('fr-FR')} DA`;
            }
        }
        
        // Handle nationality change - ONLY show wilaya for Algeria
        function handleNationaliteChange() {
            const nationalite = nationaliteSelect.value;
            
            if (nationalite === 'Algérie') {
                wilayaGroup.style.display = 'block';
                wilayaSelect.setAttribute('required', 'required');
            } else {
                wilayaGroup.style.display = 'none';
                wilayaSelect.removeAttribute('required');
                wilayaSelect.value = '';
            }
        }
        
        // Handle federation affiliation change
        function handleAffilieFederationChange() {
            const affilie = affilieFederationSelect.value;
            
            if (affilie === 'oui') {
                numeroLicenceGroup.style.display = 'block';
                numeroLicenceInput.setAttribute('required', 'required');
            } else {
                numeroLicenceGroup.style.display = 'none';
                numeroLicenceInput.removeAttribute('required');
                numeroLicenceInput.value = '';
            }
        }

        // Form submission handler
        function handleFormSubmit(event) {
            const nationalite = nationaliteSelect.value;
            const wilaya = wilayaSelect.value;
            const affilie = affilieFederationSelect.value;
            const numeroLicence = numeroLicenceInput.value;
            const typePaiement = document.querySelector('input[name="type_paiement"]:checked');

            // Validate payment method
            if (!typePaiement) {
                event.preventDefault();
                alert('Veuillez sélectionner une méthode de paiement.');
                return;
            }

            // Validate wilaya for Algerians
            if (nationalite === 'Algérie' && !wilaya) {
                event.preventDefault();
                alert('Veuillez sélectionner votre wilaya.');
                return;
            }

            // Validate license number if affiliated
            if (affilie === 'oui' && !numeroLicence) {
                event.preventDefault();
                alert('Veuillez saisir votre numéro de licence.');
                return;
            }
        }
        
        // Event listeners
        eventSelect.addEventListener('change', function() {
            loadEventDetails(this.value);
        });
        
        nationaliteSelect.addEventListener('change', handleNationaliteChange);
        
        affilieFederationSelect.addEventListener('change', handleAffilieFederationChange);
        
        paymentForm.addEventListener('submit', handleFormSubmit);
        
        // Initialize
        @if($event)
            loadEventDetails({{ $event->id }});
        @endif
        
        handleNationaliteChange();
        handleAffilieFederationChange();
    });
</script>
@endsection