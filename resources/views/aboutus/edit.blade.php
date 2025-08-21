@extends('layouts.app')

@section('title', 'Edit About Us')

@section('content')
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">✏️</div>
            <h2 class="section-title">Edit About Us</h2>
        </div>

        <form action="{{ route('aboutus.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" class="form-input large-input" id="company_name" name="company_name" 
                           value="{{ old('company_name', $aboutUs->company_name) }}" required>
                    @error('company_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-input large-input" id="email" name="email" 
                           value="{{ old('email', $aboutUs->email) }}" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-input large-textarea" id="description" name="description" rows="5" required>{{ old('description', $aboutUs->description) }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="mission" class="form-label">Mission</label>
                    <textarea class="form-input large-textarea" id="mission" name="mission" rows="4">{{ old('mission', $aboutUs->mission) }}</textarea>
                    @error('mission')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="vision" class="form-label">Vision</label>
                    <textarea class="form-input large-textarea" id="vision" name="vision" rows="4">{{ old('vision', $aboutUs->vision) }}</textarea>
                    @error('vision')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-input large-input" id="address" name="address" 
                       value="{{ old('address', $aboutUs->address) }}" required>
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-input large-input" id="phone" name="phone" 
                           value="{{ old('phone', $aboutUs->phone) }}" required>
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="whatsapp" class="form-label">WhatsApp</label>
                    <input type="text" class="form-input large-input" id="whatsapp" name="whatsapp" 
                           value="{{ old('whatsapp', $aboutUs->whatsapp) }}">
                    @error('whatsapp')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="map_link" class="form-label">Map Link</label>
                    <input type="url" class="form-input large-input" id="map_link" name="map_link" 
                           value="{{ old('map_link', $aboutUs->map_link) }}">
                    @error('map_link')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="facebook_url" class="form-label">Facebook</label>
                    <input type="url" class="form-input large-input" id="facebook_url" name="facebook_url" 
                           value="{{ old('facebook_url', $aboutUs->facebook_url) }}">
                    @error('facebook_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="instagram_url" class="form-label">Instagram</label>
                    <input type="url" class="form-input large-input" id="instagram_url" name="instagram_url" 
                           value="{{ old('instagram_url', $aboutUs->instagram_url) }}">
                    @error('instagram_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="twitter_url" class="form-label">Twitter</label>
                    <input type="url" class="form-input large-input" id="twitter_url" name="twitter_url" 
                           value="{{ old('twitter_url', $aboutUs->twitter_url) }}">
                    @error('twitter_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="linkedin_url" class="form-label">LinkedIn</label>
                    <input type="url" class="form-input large-input" id="linkedin_url" name="linkedin_url" 
                           value="{{ old('linkedin_url', $aboutUs->linkedin_url) }}">
                    @error('linkedin_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="main_image" class="form-label">Main Image</label>
                @if($aboutUs->main_image)
                <div class="image-preview-container">
                    <div class="current-image">
                        <img src="{{ $aboutUs->main_image_url }}" class="image-preview">
                        <div class="image-actions">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="keep_main_image" name="keep_main_image" checked>
                                <label class="form-check-label" for="keep_main_image">Keep current image</label>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <input type="file" class="form-input large-input" id="main_image" name="main_image" accept="image/*">
                @error('main_image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="gallery_images" class="form-label">Gallery Images</label>
                @if(count($aboutUs->gallery_urls) > 0)
                <div class="gallery-preview">
                    <h4>Current Gallery Images</h4>
                    <div class="image-grid">
                        @foreach($aboutUs->gallery_urls as $index => $image)
                        <div class="gallery-image-container">
                            <img src="{{ $image }}" class="gallery-preview-image">
                        </div>
                        @endforeach
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="keep_gallery" name="keep_gallery" checked>
                        <label class="form-check-label" for="keep_gallery">Keep current gallery images</label>
                    </div>
                </div>
                @endif
                <input type="file" class="form-input large-input" id="gallery_images" name="gallery_images[]" multiple accept="image/*">
                <p class="form-hint">You can select multiple images (JPEG, PNG, JPG, GIF, max 2MB each)</p>
                @error('gallery_images')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('gallery_images.*')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-large">Save Changes</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline btn-large">Cancel</a>
            </div>
        </form>
    </div>

    <style>
        .form-group {
            margin-bottom: 30px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            color: var(--text);
            font-weight: 600;
            font-size: 15px;
        }
        
        .form-input {
            width: 100%;
            padding: 15px 18px;
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid var(--card-border);
            border-radius: 10px;
            color: var(--text);
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }
        
        .large-input {
            padding: 16px 20px;
            font-size: 16px;
            min-height: 55px;
        }
        
        .large-textarea {
            padding: 18px 20px;
            font-size: 16px;
            min-height: 120px;
            line-height: 1.6;
        }
        
        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 200, 215, 0.25);
            transform: translateY(-2px);
        }
        
        .form-hint {
            color: var(--text-secondary);
            font-size: 13px;
            margin-top: 8px;
        }
        
        .form-actions {
            display: flex;
            gap: 20px;
            margin-top: 40px;
            padding-top: 25px;
            border-top: 1px solid var(--card-border);
        }
        
        .image-preview-container {
            margin-bottom: 20px;
        }
        
        .current-image {
            position: relative;
            display: inline-block;
        }
        
        .image-preview {
            width: 250px;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid var(--card-border);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .image-actions {
            margin-top: 15px;
        }
        
        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-check-input {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
        }
        
        .form-check-label {
            margin: 0;
            color: var(--text-secondary);
            font-size: 14px;
        }
        
        .gallery-preview {
            margin-bottom: 20px;
        }
        
        .gallery-preview h4 {
            margin-bottom: 15px;
            color: var(--text);
            font-size: 16px;
            font-weight: 600;
        }
        
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .gallery-image-container {
            position: relative;
        }
        
        .gallery-preview-image {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--card-border);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .gallery-preview-image:hover {
            transform: scale(1.05);
        }
        
        .text-danger {
            color: #f87171;
            font-size: 14px;
            margin-top: 8px;
            display: block;
            font-weight: 500;
        }
        
        /* Button styles to match the app */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 16px 32px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            border: none;
        }
        
        .btn-large {
            padding: 18px 36px;
            font-size: 17px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 200, 215, 0.4);
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            font-weight: 600;
        }
        
        .btn-outline:hover {
            background: rgba(0, 200, 215, 0.15);
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 200, 215, 0.2);
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 15px;
            }
            
            .form-actions .btn {
                width: 100%;
                justify-content: center;
            }
            
            .image-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }
            
            .large-input {
                padding: 14px 16px;
                font-size: 16px;
                min-height: 50px;
            }
            
            .large-textarea {
                padding: 16px;
                font-size: 16px;
                min-height: 110px;
            }
            
            .btn-large {
                padding: 16px 28px;
                font-size: 16px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Preview main image before upload
            const mainImageInput = document.getElementById('main_image');
            if (mainImageInput) {
                mainImageInput.addEventListener('change', function(e) {
                    if (document.getElementById('keep_main_image')) {
                        document.getElementById('keep_main_image').checked = false;
                    }
                    
                    if (e.target.files.length > 0) {
                        const preview = document.createElement('img');
                        preview.src = URL.createObjectURL(e.target.files[0]);
                        preview.className = 'image-preview';
                        
                        const container = document.querySelector('.current-image') || document.createElement('div');
                        container.className = 'current-image';
                        
                        const existingPreview = container.querySelector('img');
                        if (existingPreview) {
                            container.replaceChild(preview, existingPreview);
                        } else {
                            const actions = document.createElement('div');
                            actions.className = 'image-actions';
                            actions.innerHTML = `
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="keep_main_image" name="keep_main_image" checked>
                                    <label class="form-check-label" for="keep_main_image">Keep current image</label>
                                </div>
                            `;
                            
                            container.appendChild(preview);
                            container.appendChild(actions);
                            
                            if (!document.querySelector('.image-preview-container')) {
                                const previewContainer = document.createElement('div');
                                previewContainer.className = 'image-preview-container';
                                previewContainer.appendChild(container);
                                mainImageInput.parentNode.insertBefore(previewContainer, mainImageInput);
                            }
                        }
                    }
                });
            }
            
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