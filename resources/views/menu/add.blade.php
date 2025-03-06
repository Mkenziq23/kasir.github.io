@extends('layouts.main')

@section('container')
    <div class="container py-4">
        <h1 class="app-page-title text-center mb-4">Add New Menu</h1>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="/menu" method="post" enctype="multipart/form-data">
                            @csrf
                            <!-- Product Name -->
                            <div class="mb-3">
                                <label for="name-product" class="form-label">Nama Product</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name-product" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Modal and Price -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="modal" class="form-label">Modal</label>
                                        <input type="text" class="form-control @error('modal') is-invalid @enderror"
                                            id="modal" name="modal" value="{{ old('modal') }}" required>
                                        @error('modal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Harga Jual</label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                                            id="price" name="price" value="{{ old('price') }}" required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Category -->
                            <div class="mb-4">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select @error('category') is-invalid @enderror" id="category"
                                    name="category" required>
                                    <option selected disabled hidden>- Select Category -</option>
                                    <option value="makanan" @if (old('category') == 'makanan') selected @endif>Makanan
                                    </option>
                                    <option value="minuman" @if (old('category') == 'minuman') selected @endif>Minuman
                                    </option>
                                    <option value="camilan" @if (old('category') == 'camilan') selected @endif>Camilan
                                    </option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                @error('description')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                                <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                                <trix-editor input="description"></trix-editor>
                            </div>
                            <!-- Image Upload -->
                            <div class="mb-3">
                                <label class="form-label" for="img">Upload Image</label>
                                @error('image')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                                <div class="img-area mb-3">
                                    <img class="img-preview img-fluid mb-2" style="max-height: 200px; object-fit: cover;">
                                    <input type="file" id="img" class="form-control select-image" name="image">
                                    <div class="view-path-img mt-2" data-path="false">
                                        <h5>Upload Image</h5>
                                        <p>Image size must be less than <span>2MB</span></p>
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="text-center">
                                <button class="btn btn-primary w-100" type="submit">Add to Menu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Image Preview -->
    <script>
        const img = document.getElementById('img');
        const img_preview = document.querySelector('.img-preview');
        const view_path_img = document.querySelector('.view-path-img');

        img.addEventListener('change', function() {
            const files = img.files[0];
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function() {
                img_preview.src = this.result;
                img_preview.style.opacity = '1';
                view_path_img.innerHTML = `<h5>${files.name}</h5><p>click to change</p>`;
                view_path_img.setAttribute('data-path', 'true');
            });
        });
    </script>
    <script src="/js/formatmoney.js"></script>
@endsection
