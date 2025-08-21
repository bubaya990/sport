@extends('layouts.app')

@section('title', $evenement->titre)

@section('content')
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <h2 class="section-title">{{ $evenement->titre }}</h2>
            
            <!-- Back button moved to top-right -->
            <div class="top-actions">
                <a href="{{ route('evenements.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Back to Events
                </a>
                
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <div class="admin-actions">
                        <a href="{{ route('evenements.edit', $evenement->id) }}" 
                           class="btn btn-outline">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('evenements.destroy', $evenement->id) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this event?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                @endif
            </div>
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
                <div class="event-status status-{{ $evenement->status }}">
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

        .event-status {
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 12px;
            font-weight: 600;
        }

        .status-scheduled {
            background: rgba(0, 200, 215, 0.2);
            color: var(--primary);
        }

        .status-ongoing {
            background: rgba(245, 158, 11, 0.2);
            color: var(--warning);
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.2);
            color: var(--success);
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

        /* Top actions container */
        .top-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-left: auto;
        }

        .admin-actions {
            display: flex;
            gap: 10px;
        }

        /* Button styles to match the app */
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

        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: rgba(0, 200, 215, 0.1);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626, var(--danger));
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
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
            
            .top-actions {
                flex-direction: column;
                width: 100%;
                margin-top: 15px;
                margin-left: 0;
            }
            
            .admin-actions {
                flex-direction: column;
                width: 100%;
            }
            
            .admin-actions .btn,
            .top-actions .btn {
                width: 100%;
                justify-content: center;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add ripple effect to buttons
            document.querySelectorAll('.btn').forEach(button => {
                button.addEventListener('click', function(e) {
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
        });
    </script>
@endsection