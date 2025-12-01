@extends('layouts.dashboard')

@section('title', 'Edit About Section')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit About Section</h2>
        <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.about.update', $about) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $about->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">About Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($about->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $about->image) }}" alt="Current" 
                                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description *</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="3" required>{{ old('description', $about->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="additional_text" class="form-label">Additional Text</label>
                    <textarea class="form-control @error('additional_text') is-invalid @enderror" 
                              id="additional_text" name="additional_text" rows="3">{{ old('additional_text', $about->additional_text) }}</textarea>
                    @error('additional_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Features</label>
                    <div id="features-container">
                        @if($about->features && count($about->features) > 0)
                            @foreach($about->features as $feature)
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="features[]" value="{{ $feature }}" placeholder="Enter feature">
                                    <button type="button" class="btn btn-outline-danger remove-feature">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="features[]" placeholder="Enter feature">
                                <button type="button" class="btn btn-outline-danger remove-feature" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-feature">
                        <i class="bi bi-plus-circle me-1"></i>Add Feature
                    </button>
                </div>

                <div class="mb-3">
                    <label for="video_url" class="form-label">Video URL (YouTube)</label>
                    <input type="url" class="form-control @error('video_url') is-invalid @enderror" 
                           id="video_url" name="video_url" value="{{ old('video_url', $about->video_url) }}" 
                           placeholder="https://www.youtube.com/watch?v=...">
                    @error('video_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                               {{ old('is_active', $about->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-save me-2"></i>Update About Section
                    </button>
                    <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.getElementById('add-feature').addEventListener('click', function() {
        const container = document.getElementById('features-container');
        const newFeature = document.createElement('div');
        newFeature.className = 'input-group mb-2';
        newFeature.innerHTML = `
            <input type="text" class="form-control" name="features[]" placeholder="Enter feature">
            <button type="button" class="btn btn-outline-danger remove-feature">
                <i class="bi bi-trash"></i>
            </button>
        `;
        container.appendChild(newFeature);
        
        // Add remove functionality
        newFeature.querySelector('.remove-feature').addEventListener('click', function() {
            newFeature.remove();
        });
    });

    // Add remove functionality to existing features
    document.querySelectorAll('.remove-feature').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.input-group').remove();
        });
    });
</script>
@endsection
@endsection
