@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
    <!-- Edit Event Form -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">✏️</div>
            <h2 class="section-title">Edit Event</h2>
        </div>

        <form action="{{ route('evenements.update', $evenement->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="titre" value="{{ old('titre', $evenement->titre) }}" class="form-input" required>
                @error('titre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4" class="form-input" required>{{ old('description', $evenement->description) }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="date" value="{{ old('date', $evenement->date->format('Y-m-d')) }}" class="form-input" required>
                    @error('date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date', $evenement->end_date ? $evenement->end_date->format('Y-m-d') : '') }}" class="form-input">
                    @error('end_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Price (DH)</label>
                    <input type="number" name="prix" value="{{ old('prix', $evenement->prix) }}" class="form-input" step="0.01" min="0">
                    @error('prix')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-input" required>
                        <option value="scheduled" {{ old('status', $evenement->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                        <option value="ongoing" {{ old('status', $evenement->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ old('status', $evenement->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            @if($evenement->images && count($evenement->images) > 0)
            <div class="form-group">
                <label>Current Images</label>
                <div class="image-preview">
                    @foreach($evenement->images as $image)
                        <div class="image-container">
                            <img src="{{ asset('storage/'.$image) }}">
                            <button type="button" class="btn btn-danger btn-small remove-image" onclick="removeImage(this, '{{ $image }}')">×</button>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="existing_images" id="existing_images" value="{{ json_encode($evenement->images) }}">
            </div>
            @endif

            <div class="form-group">
                <label>Add More Images</label>
                <input type="file" name="images[]" multiple class="form-input">
                <p class="form-hint">You can select multiple images (JPEG, PNG, JPG, GIF, max 2MB each)</p>
                @error('images')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('images.*')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Event</button>
                <a href="{{ route('evenements.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>

    <style>
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: var(--text);
            font-weight: 500;
            font-size: 14px;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 15px;
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid var(--card-border);
            border-radius: 8px;
            color: var(--text);
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 200, 215, 0.2);
        }
        
        textarea.form-input {
            min-height: 100px;
            resize: vertical;
        }
        
        .form-hint {
            color: var(--text-secondary);
            font-size: 12px;
            margin-top: 5px;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }
        
        .image-preview {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .image-container {
            position: relative;
            width: 80px;
            height: 80px;
        }
        
        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
        }
        
        .remove-image {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 20px;
            height: 20px;
            padding: 0;
            border-radius: 50%;
            font-size: 12px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .text-danger {
            color: #f87171;
            font-size: 12px;
            margin-top: 5px;
            display: block;
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
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 200, 215, 0.3);
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
        
        .btn-small {
            padding: 5px 10px;
            font-size: 12px;
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .form-actions .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <script>
        function removeImage(button, imagePath) {
            // Get the existing images input
            const existingImagesInput = document.getElementById('existing_images');
            let existingImages = [];
            
            if (existingImagesInput && existingImagesInput.value) {
                existingImages = JSON.parse(existingImagesInput.value);
            }
            
            // Add the image to removed_images array
            const removedInput = document.createElement('input');
            removedInput.type = 'hidden';
            removedInput.name = 'removed_images[]';
            removedInput.value = imagePath;
            document.querySelector('form').appendChild(removedInput);
            
            // Remove the image element
            button.parentElement.remove();
            
            // Update the existing_images field
            const updatedImages = existingImages.filter(img => img !== imagePath);
            
            if (updatedImages.length > 0) {
                existingImagesInput.value = JSON.stringify(updatedImages);
            } else {
                // If no images left, remove the input entirely
                existingImagesInput.remove();
            }
        }
        
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