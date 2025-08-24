@extends('layouts.app')

@section('title', 'Inscription Réussie')

@section('content')
<div class="success-container">
    <div class="success-card">
        <div class="success-icon">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22,4 12,14.01 9,11.01"></polyline>
            </svg>
        </div>
        
        <h1 class="success-title">Inscription Réussie!</h1>
        <p class="success-message">Votre inscription a été enregistrée avec succès. Voici les détails de votre paiement:</p>
        
        <div class="payment-details">
            <div class="detail-item">
                <span class="detail-label">Référence:</span>
                <span class="detail-value">{{ $paiement->transaction_id }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Événement:</span>
                <span class="detail-value">{{ $paiement->evenement->titre }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Participant:</span>
                <span class="detail-value">{{ $paiement->participant->prenom }} {{ $paiement->participant->nom }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Montant:</span>
                <span class="detail-value">{{ $paiement->montant }} DA</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Méthode de paiement:</span>
                <span class="detail-value">
                    @if($paiement->type == 'visa')
                        Carte Visa
                    @elseif($paiement->type == 'poste')
                        Poste Algérienne
                    @else
                        Carte Dor
                    @endif
                </span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Date de paiement:</span>
                <span class="detail-value">{{ $paiement->paid_at->format('d/m/Y H:i') }}</span>
            </div>
        </div>
        
        <div class="success-actions">
            <a href="{{ route('home') }}" class="btn btn-primary">
                Retour à l'accueil
            </a>
            <button onclick="window.print()" class="btn btn-outline">
                Imprimer le reçu
            </button>
        </div>
    </div>
</div>

<style>
    .success-container {
        max-width: 600px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .success-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        padding: 40px;
        text-align: center;
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #10b981, #059669);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        color: white;
    }

    .success-title {
        font-size: 2rem;
        font-weight: 700;
        color: #10b981;
        margin-bottom: 16px;
    }

    .success-message {
        color: #6b7280;
        margin-bottom: 32px;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .payment-details {
        background: #f9fafb;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 32px;
        text-align: left;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: #374151;
    }

    .detail-value {
        color: #6b7280;
        font-weight: 500;
    }

    .success-actions {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }

    @media (max-width: 480px) {
        .success-card {
            padding: 24px;
        }
        
        .success-title {
            font-size: 1.5rem;
        }
        
        .detail-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }
        
        .success-actions {
            flex-direction: column;
        }
        
        .success-actions .btn {
            width: 100%;
        }
    }
</style>
@endsection