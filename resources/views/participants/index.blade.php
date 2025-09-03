@extends('layouts.app')

@section('title', 'Liste des Participants')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .container {
        max-width: 1400px;
        margin: 20px auto;
        padding: 20px;
    }
    
    .page-title {
        color: var(--primary);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--primary);
    }
    
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 25px;
        border: none;
    }
    
    .card-header {
        background-color: var(--primary);
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 15px 20px;
        font-weight: 600;
    }
    
    .filter-section {
        padding: 20px;
        background-color: var(--card-bg);
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 25px;
        border: 1px solid var(--card-border);
    }
    
    .filter-title {
        font-size: 18px;
        color: var(--primary);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
    
    .filter-title i {
        margin-right: 10px;
    }
    
    .filter-group {
        margin-bottom: 15px;
    }
    
    .filter-label {
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text);
    }
    
    .btn-filter {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        transition: all 0.3s;
    }
    
    .btn-filter:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
    }
    
    .table-container {
        overflow-x: auto;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: var(--card-bg);
    }
    
    th {
        background-color: var(--primary);
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    
    td {
        padding: 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--text);
    }
    
    tr:nth-child(even) {
        background-color: rgba(30, 41, 59, 0.5);
    }
    
    tr:hover {
        background-color: rgba(0, 200, 215, 0.1);
    }
    
    .badge {
        padding: 6px 10px;
        border-radius: 20px;
        font-weight: 500;
    }
    
    .badge-male {
        background-color: rgba(0, 200, 215, 0.3);
        color: var(--primary);
    }
    
    .badge-female {
        background-color: rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }
    
    .badge-size {
        background-color: rgba(139, 92, 246, 0.3);
        color: #8b5cf6;
        font-weight: 700;
    }
    
    .pagination {
        margin-top: 20px;
        justify-content: center;
    }
    
    .page-link {
        color: var(--primary);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 8px 16px;
        background-color: var(--card-bg);
    }
    
    .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    
    .btn-action {
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 14px;
    }
    
    .results-count {
        color: var(--text-secondary);
        font-style: italic;
        margin-bottom: 15px;
    }
    
    .search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .search-input {
        flex: 1;
        padding: 10px 15px;
        border-radius: 25px;
        border: none;
        background: rgba(255, 255, 255, 0.1);
        color: var(--text);
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .search-input:focus {
        background: rgba(255, 255, 255, 0.2);
        outline: none;
        box-shadow: 0 0 0 2px var(--primary-light);
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        th, td {
            padding: 10px;
        }
        
        .filter-section {
            padding: 15px;
        }
        
        .search-form {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1 class="page-title"><i class="fas fa-users"></i> Liste des Participants</h1>
    
    <!-- Search Form -->
    <form class="search-form" id="searchForm" method="GET" action="{{ route('participants.index') }}">
        <input type="text" class="search-input" name="search" id="globalSearch" 
               placeholder="Rechercher un participant..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-filter">
            <i class="fas fa-search"></i> Rechercher
        </button>
    </form>
    
    <!-- Filters Section -->
    <div class="filter-section">
        <h3 class="filter-title"><i class="fas fa-filter"></i> Filtres</h3>
        
        <form method="GET" action="{{ route('participants.index') }}" id="filterForm">
            <div class="row">
                <div class="col-md-3">
                    <div class="filter-group">
                        <div class="filter-label">Tranche d'âge</div>
                        <select class="form-select" name="age_range" id="ageFilter">
                            <option value="">Tous les âges</option>
                            <option value="18-23" {{ request('age_range') == '18-23' ? 'selected' : '' }}>18-23 ans</option>
                            <option value="24-39" {{ request('age_range') == '24-39' ? 'selected' : '' }}>24-39 ans</option>
                            <option value="40-49" {{ request('age_range') == '40-49' ? 'selected' : '' }}>40-49 ans</option>
                            <option value="50-59" {{ request('age_range') == '50-59' ? 'selected' : '' }}>50-59 ans</option>
                            <option value="60+" {{ request('age_range') == '60+' ? 'selected' : '' }}>60+ ans</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="filter-group">
                        <div class="filter-label">Sexe</div>
                        <select class="form-select" name="sexe" id="sexFilter">
                            <option value="">Tous</option>
                            <option value="homme" {{ request('sexe') == 'homme' ? 'selected' : '' }}>Homme</option>
                            <option value="femme" {{ request('sexe') == 'femme' ? 'selected' : '' }}>Femme</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="filter-group">
                        <div class="filter-label">Taille</div>
                        <select class="form-select" name="size" id="sizeFilter">
                            <option value="">Toutes</option>
                            <option value="XS" {{ request('size') == 'XS' ? 'selected' : '' }}>XS</option>
                            <option value="S" {{ request('size') == 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ request('size') == 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ request('size') == 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ request('size') == 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ request('size') == 'XXL' ? 'selected' : '' }}>XXL</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="filter-group">
                        <div class="filter-label">Ville</div>
                        <select class="form-select" name="ville" id="villeFilter">
                            <option value="">Toutes les villes</option>
                            @foreach($villes as $ville)
                                <option value="{{ $ville }}" {{ request('ville') == $ville ? 'selected' : '' }}>{{ $ville }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="filter-group">
                        <div class="filter-label">Actions</div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-filter w-100" id="applyFilters">
                                <i class="fas fa-check"></i> Appliquer
                            </button>
                            <a href="{{ route('participants.index') }}" class="btn btn-outline-secondary w-100" id="resetFilters">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <div class="results-count">Affichage de {{ $participants->total() }} participants</div>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Ville</th>
                    <th>Date Naissance</th>
                    <th>Âge</th>
                    <th>Sexe</th>
                    <th>Taille</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($participants as $participant)
                    <tr>
                        <td>{{ $participant->id }}</td>
                        <td>{{ $participant->nom }}</td>
                        <td>{{ $participant->prenom }}</td>
                        <td>{{ $participant->email ?? 'N/A' }}</td>
                        <td>{{ $participant->telephone ?? 'N/A' }}</td>
                        <td>{{ $participant->ville ?? 'N/A' }}</td>
                        <td>
                            @if($participant->date_naissance)
                                {{ \Carbon\Carbon::parse($participant->date_naissance)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($participant->date_naissance)
                                {{ \Carbon\Carbon::parse($participant->date_naissance)->age }} ans
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($participant->sexe == 'homme')
                                <span class="badge badge-male">Homme</span>
                            @elseif($participant->sexe == 'femme')
                                <span class="badge badge-female">Femme</span>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($participant->size)
                                <span class="badge badge-size">{{ $participant->size }}</span>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="action-buttons">
                            <a href="{{ route('participants.show', $participant->id) }}" class="btn btn-primary btn-action"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-success btn-action"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('participants.destroy', $participant->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce participant?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">Aucun participant trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item {{ $participants->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $participants->previousPageUrl() }}" tabindex="-1">Précédent</a>
            </li>
            @for ($i = 1; $i <= $participants->lastPage(); $i++)
                <li class="page-item {{ $participants->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $participants->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ !$participants->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $participants->nextPageUrl() }}">Suivant</a>
            </li>
        </ul>
    </nav>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const applyFilters = document.getElementById('applyFilters');
        const resetFilters = document.getElementById('resetFilters');
        const ageFilter = document.getElementById('ageFilter');
        const sexFilter = document.getElementById('sexFilter');
        const sizeFilter = document.getElementById('sizeFilter');
        const villeFilter = document.getElementById('villeFilter');
        const globalSearch = document.getElementById('globalSearch');
        const searchForm = document.getElementById('searchForm');
        
        // Auto-submit filters when changed
        document.getElementById('ageFilter').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
        
        document.getElementById('sexFilter').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
        
        document.getElementById('sizeFilter').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
        
        document.getElementById('villeFilter').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
        
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('filterForm').submit();
        });
    });
</script>
@endpush