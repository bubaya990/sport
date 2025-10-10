@extends('layouts.app')

@section('title', 'Paiement Réussi')

@section('content')
<div class="payment-container">
    <div class="payment-card">
        <div class="payment-header">
            <h1 class="payment-title">✅ Paiement Réussi</h1>
            <p class="payment-subtitle">Votre inscription a été confirmée avec succès</p>
        </div>

        <div class="payment-success-content">
            <div class="success-icon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" fill="#10b981"/>
                    <path d="M8 12L11 15L16 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="success-message">
                <h2>Merci {{ $paiement->participant->prenom }} {{ $paiement->participant->nom }} !</h2>
                <p>Votre inscription à l'événement a été confirmée. Vous recevrez un email de confirmation sous peu.</p>
            </div>

            <div class="details-section">
                <h3 class="section-title">Détails de l'Inscription</h3>
                
                <div class="details-grid">
                    <div class="detail-item">
                        <span class="detail-label">Événement</span>
                        <span class="detail-value">{{ $paiement->evenement->titre }}</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Date</span>
                        <span class="detail-value">{{ $paiement->evenement->date->format('d/m/Y') }}</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Montant payé</span>
                        <span class="detail-value price">{{ number_format($paiement->montant, 0, ',', ' ') }} DA</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Méthode de paiement</span>
                        <span class="detail-value">{{ ucfirst($paiement->type) }}</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">ID de transaction</span>
                        <span class="detail-value transaction-id">{{ $paiement->transaction_id }}</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Statut</span>
                        <span class="detail-value status-confirmed">Confirmé</span>
                    </div>
                </div>
            </div>

            <div class="participant-info">
                <h3 class="section-title">Informations du Participant</h3>
                
                <div class="details-grid">
                    <div class="detail-item">
                        <span class="detail-label">Nom complet</span>
                        <span class="detail-value">{{ $paiement->participant->prenom }} {{ $paiement->participant->nom }}</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">{{ $paiement->participant->email }}</span>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Téléphone</span>
                        <span class="detail-value">{{ $paiement->participant->telephone }}</span>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('payment.index') }}" class="btn btn-primary">
                    <span class="btn-text">Retour à l'accueil</span>
                </a>
                
                <button onclick="window.print()" class="btn btn-secondary">
                    <span class="btn-text">Imprimer la confirmation</span>
                </button>
            </div>

            <div class="success-note">
                <p>📧 Un email de confirmation vous a été envoyé à <strong>{{ $paiement->participant->email }}</strong></p>
                <p>📱 Conservez cet écran ou imprimez-le pour présentation lors de l'événement</p>
            </div>
        </div>
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
        background: linear-gradient(135deg, #10b981, #059669);
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

    .payment-success-content {
        padding: 40px;
    }

    .success-icon {
        text-align: center;
        margin-bottom: 30px;
    }

    .success-message {
        text-align: center;
        margin-bottom: 40px;
    }

    .success-message h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 10px;
    }

    .success-message p {
        color: #6b7280;
        font-size: 1.1rem;
        line-height: 1.6;
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

    .details-section, .participant-info {
        margin-bottom: 40px;
        padding-bottom: 30px;
        border-bottom: 2px solid #f3f4f6;
    }

    .details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 768px) {
        .details-grid {
            grid-template-columns: 1fr;
        }
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 16px;
        background: #f8fafc;
        border-radius: 8px;
        border-left: 4px solid var(--primary);
    }

    .detail-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-value {
        font-size: 1.1rem;
        font-weight: 500;
        color: #1f2937;
    }

    .detail-value.price {
        color: #10b981;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .detail-value.transaction-id {
        font-family: 'Courier New', monospace;
        background: #f3f4f6;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    .detail-value.status-confirmed {
        color: #10b981;
        font-weight: 600;
        background: #d1fae5;
        padding: 4px 12px;
        border-radius: 20px;
        display: inline-block;
    }

    .action-buttons {
        display: flex;
        gap: 16px;
        justify-content: center;
        margin: 40px 0;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: #6b7280;
        color: white;
    }

    .btn-secondary:hover {
        background: #4b5563;
        transform: translateY(-2px);
    }

    .success-note {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        margin-top: 30px;
    }

    .success-note p {
        margin: 8px 0;
        color: #065f46;
        font-size: 0.95rem;
    }

    @media print {
        .action-buttons {
            display: none;
        }
        
        .payment-header {
            background: #10b981 !important;
            -webkit-print-color-adjust: exact;
        }
    }
</style>
@endsection