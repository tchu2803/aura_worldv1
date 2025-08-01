@extends('admins.layouts.default')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Chỉnh sửa Banner</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" value="{{ old('title', $banner->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="4">{{ old('description', $banner->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="link" class="form-label">Link</label>
                                        <input type="url" class="form-control @error('link') is-invalid @enderror" 
                                               id="link" name="link" value="{{ old('link', $banner->link) }}" 
                                               placeholder="https://example.com">
                                        @error('link')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                                                <select class="form-select @error('status') is-invalid @enderror" 
                                                        id="status" name="status" required>
                                                    <option value="">Chọn trạng thái</option>
                                                    <option value="active" {{ old('status', $banner->status) == 'active' ? 'selected' : '' }}>Hoạt động</option>
                                                    <option value="inactive" {{ old('status', $banner->status) == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="type" class="form-label">Loại banner <span class="text-danger">*</span></label>
                                                <select class="form-select @error('type') is-invalid @enderror" 
                                                        id="type" name="type" required>
                                                    <option value="">Chọn loại banner</option>
                                                    <option value="main" {{ old('type', $banner->type) == 'main' ? 'selected' : '' }}>Banner chính (Carousel)</option>
                                                    <option value="secondary" {{ old('type', $banner->type) == 'secondary' ? 'selected' : '' }}>Banner phụ (Dưới trang)</option>
                                                </select>
                                                @error('type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="sort_order" class="form-label">Thứ tự hiển thị</label>
                                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                                       id="sort_order" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" 
                                                       min="0">
                                                @error('sort_order')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Ảnh banner</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                               id="image" name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            Để trống nếu không muốn thay đổi ảnh. Định dạng: JPG, JPEG, PNG, WEBP. Kích thước tối đa: 2MB
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Ảnh hiện tại</label>
                                        <div class="border rounded p-2 text-center">
                                            @if($banner->image)
                                                <img src="{{ asset('storage/' . $banner->image) }}" 
                                                     alt="{{ $banner->title }}" 
                                                     class="img-fluid" 
                                                     style="max-height: 200px;">
                                            @else
                                                <p class="text-muted">Không có ảnh</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Xem trước ảnh mới</label>
                                        <div id="image-preview" class="border rounded p-2 text-center" style="min-height: 200px;">
                                            <p class="text-muted">Ảnh mới sẽ hiển thị ở đây</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('banners.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Cập nhật Banner
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('image-preview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="img-fluid" style="max-height: 200px;">`;
        }
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = '<p class="text-muted">Ảnh mới sẽ hiển thị ở đây</p>';
    }
});
</script>
@endsection 