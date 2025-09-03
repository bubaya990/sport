@extends('layouts.app')

@section('title', 'Détails du Participant')

@section('content')
<div class="container">
    <div class="header-section">
        <a href="{{ route('participants.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
        <h1 class="page-title"><i class="fas fa-user-circle"></i> Détails du Participant</h1>
    </div>

    <div class="participant-card">
        <div class="card-header-section">
            <div class="participant-avatar">
                @if($participant->sexe == 'homme')
                    <i class="fas fa-male"></i>
                @elseif($participant->sexe == 'femme')
                    <i class="fas fa-female"></i>
                @else
                    <i class="fas fa-user"></i>
                @endif
            </div>
            <div class="participant-name">
                <h2>{{ $participant->prenom }} {{ $participant->nom }}</h2>
                <p class="participant-id">ID: #{{ $participant->id }}</p>
            </div>
        </div>

        <div class="card-body-section">
            <div class="info-grid">
                <!-- Personal Information -->
                <div class="info-group">
                    <h3 class="info-title">
                        <i class="fas fa-id-card"></i> Informations Personnelles
                    </h3>
                    <div class="info-items">
                        <div class="info-item">
                            <span class="info-label">Nom complet</span>
                            <span class="info-value">{{ $participant->prenom }} {{ $participant->nom }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Sexe</span>
                            <span class="info-value">
                                @if($participant->sexe == 'homme')
                                    <span class="badge male-badge">
                                        <i class="fas fa-mars"></i> Homme
                                    </span>
                                @elseif($participant->sexe == 'femme')
                                    <span class="badge female-badge">
                                        <i class="fas fa-venus"></i> Femme
                                    </span>
                                @else
                                    <span class="badge unknown-badge">N/A</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Date de naissance</span>
                            <span class="info-value">
                                {{ $participant->date_naissance ? \Carbon\Carbon::parse($participant->date_naissance)->format('d/m/Y') : 'Non spécifiée' }}
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Âge</span>
                            <span class="info-value">
                                {{ $participant->date_naissance ? \Carbon\Carbon::parse($participant->date_naissance)->age . ' ans' : 'N/A' }}
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Taille</span>
                            <span class="info-value">
                                @if($participant->size)
                                    <span class="badge size-badge">{{ $participant->size }}</span>
                                @else
                                    Non spécifiée
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="info-group">
                    <h3 class="info-title">
                        <i class="fas fa-address-book"></i> Coordonnées
                    </h3>
                    <div class="info-items">
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value">
                                @if($participant->email)
                                    <a href="mailto:{{ $participant->email }}" class="email-link">
                                        <i class="fas fa-envelope"></i> {{ $participant->email }}
                                    </a>
                                @else
                                    Non spécifié
                                @endif
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Téléphone</span>
                            <span class="info-value">
                                @if($participant->telephone)
                                    <a href="tel:{{ $participant->telephone }}" class="phone-link">
                                        <i class="fas fa-phone"></i> {{ $participant->telephone }}
                                    </a>
                                @else
                                    Non spécifié
                                @endif
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Adresse</span>
                            <span class="info-value">
                                {{ $participant->adresse ?? 'Non spécifiée' }}
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Ville</span>
                            <span class="info-value">
                                {{ $participant->ville ?? 'Non spécifiée' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer-section">
            <div class="action-buttons">
                <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-edit">
                    <i class="fas fa-edit"></i> Modifier
                </a>
                <form action="{{ route('participants.destroy', $participant->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce participant?')">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 1000px;
        margin: 20px auto;
        padding: 20px;
    }

    .header-section {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        padding: 10px 15px;
        background: var(--primary-light);
        color: var(--primary);
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background: var(--primary);
        color: white;
        transform: translateX(-3px);
    }

    .page-title {
        color: var(--primary);
        margin: 0;
        font-size: 28px;
        font-weight: 600;
    }

    .participant-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-header-section {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 30px;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .participant-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
    }

    .participant-name h2 {
        margin: 0;
        font-size: 28px;
        font-weight: 600;
    }

    .participant-id {
        margin: 5px 0 0 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .card-body-section {
        padding: 30px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .info-group {
        background: #f8fafc;
        border-radius: 12px;
        padding: 25px;
    }

    .info-title {
        color: var(--primary);
        margin: 0 0 20px 0;
        font-size: 18px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-items {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 12px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #64748b;
        min-width: 120px;
    }

    .info-value {
        text-align: right;
        color: #1e293b;
        flex: 1;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .male-badge {
        background: rgba(0, 200, 215, 0.15);
        color: var(--primary);
        border: 1px solid rgba(0, 200, 215, 0.3);
    }

    .female-badge {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .unknown-badge {
        background: rgba(148, 163, 184, 0.15);
        color: #64748b;
        border: 1px solid rgba(148, 163, 184, 0.3);
    }

    .size-badge {
        background: rgba(139, 92, 246, 0.15);
        color: #8b5cf6;
        border: 1px solid rgba(139, 92, 246, 0.3);
        font-weight: 700;
    }

    .email-link, .phone-link {
        color: var(--primary);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .email-link:hover, .phone-link:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    .card-footer-section {
        padding: 25px 30px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .btn {
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-edit {
        background: var(--primary);
        color: white;
    }

    .btn-edit:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .btn-delete:hover {
        background: #dc2626;
        transform: translateY(-2px);
    }

    .delete-form {
        margin: 0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .header-section {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .card-header-section {
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }
        
        .participant-avatar {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }
        
        .info-item {
            flex-direction: column;
            gap: 5px;
        }
        
        .info-label, .info-value {
            text-align: left;
            width: 100%;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn {
            justify-content: center;
        }
    }
</style>
@endsection