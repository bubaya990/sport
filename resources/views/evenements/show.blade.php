@extends('layouts.app')

@section('title', $evenement->titre)

@section('content')
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <h2 class="section-title">{{ $evenement->titre }}</h2>
            
            @if(auth()->check() && auth()->user()->role === 'admin')
                <div class="admin-actions">
                    <a href="{{ route('evenements.edit', $evenement->id) }}" 
                       class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <form action="{{ route('evenements.destroy', $evenement->id) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Are you sure you want to delete this event?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <div class="event-detail">
            @if($evenement->images && is_array($evenement->images) && count($evenement->images) > 0)
                <div class="event-main-image">
                    <img src="{{ asset('storage/'.$evenement->images[0]) }}" 
                         alt="{{ $evenement->titre }}"
                         class="detail-image">
                </div>
            @endif

            <div class="event-meta">
                <div class="event-status {{ $evenement->status }}">
                    {{ ucfirst($evenement->status) }}
                </div>
                
                <div class="event-date-info">
                    <div class="date-item">
                        <i class="fas fa-calendar-day"></i>
                        <span>Start: {{ $evenement->date->format('M d, Y H:i') }}</span>
                    </div>
                    @if($evenement->end_date)
                        <div class="date-item">
                            <i class="fas fa-calendar-check"></i>
                            <span>End: {{ $evenement->end_date->format('M d, Y H:i') }}</span>
                        </div>
                    @endif
                    <div class="date-item">
                        <i class="fas fa-tag"></i>
                        <span>Price: {{ $evenement->prix }} DH</span>
                    </div>
                </div>
            </div>

            <div class="event-description">
                <h3>Description</h3>
                <p>{{ $evenement->description }}</p>
            </div>

            @if($evenement->images && is_array($evenement->images) && count($evenement->images) > 1)
                <div class="event-gallery">
                    <h3>Gallery</h3>
                    <div class="image-grid">
                        @foreach(array_slice($evenement->images, 1) as $image)
                            <div class="gallery-image">
                                <img src="{{ asset('storage/'.$image) }}" 
                                     alt="{{ $evenement->titre }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="back-button">
                <a href="{{ route('evenements.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left me-1"></i> Back to Events
                </a>
            </div>
        </div>
    </div>

    <style>
        .event-detail {
            margin-top: 20px;
        }

        .event-main-image {
            margin-bottom: 30px;
        }

        .detail-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 12px;
        }

        .event-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .event-date-info {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .date-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            background: var(--card-bg);
            border-radius: 8px;
            border: 1px solid var(--card-border);
        }

        .date-item i {
            color: var(--primary);
        }

        .event-description {
            margin-bottom: 30px;
        }

        .event-description h3 {
            margin-bottom: 15px;
            color: var(--text);
        }

        .event-description p {
            line-height: 1.8;
            color: var(--text-secondary);
            white-space: pre-line;
        }

        .event-gallery {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .event-gallery h3 {
            margin-bottom: 15px;
            color: var(--text);
        }

        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .gallery-image img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .gallery-image img:hover {
            transform: scale(1.05);
        }

        .admin-actions {
            display: flex;
            gap: 10px;
        }

        .back-button {
            margin-top: 30px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .event-meta {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .event-date-info {
                flex-direction: column;
                width: 100%;
            }
            
            .date-item {
                width: 100%;
            }
            
            .image-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>
@endsection