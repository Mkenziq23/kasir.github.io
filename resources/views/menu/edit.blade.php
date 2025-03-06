@extends('layouts.main')

@section('container')
    <h1 class="app-page-title mb-4">Edit Menu</h1>
    <form class="settings-form" action="/menu/{{ $menu->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row g-4">
            @error('picture')
                <p class="small text-danger">{{ $message }}</p>
            @enderror
            <div class="col-12 col-md-4 d-flex flex-column align-items-center">
                <div class="card shadow-sm p-3 text-center w-100">
                    <img src="{{ asset('storage/' . $menu->picture) }}" alt="Menu Image"
                        class="img-fluid rounded picture-preview mb-3">
                    <input type="file" id="select-picture" name="picture" class="form-control">
                    <div class="black-screen mt-2 text-muted">
                        <p>{{ $menu->picture }} <span class="text-primary fw-bold">click to change</span></p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="card shadow-sm p-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Produk</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" value="{{ old('name', $menu->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="modal" class="form-label fw-semibold">Modal</label>
                            <input type="text" class="form-control @error('modal') is-invalid @enderror" id="modal"
                                name="modal" value="{{ old('modal', $menu->modal) }}" required>
                            @error('modal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label fw-semibold">Harga Jual</label>
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                id="price" value="{{ old('price', $menu->price) }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label fw-semibold">Kategori</label>
                            <select class="form-select" name="category" id="category">
                                <option value="makanan"
                                    {{ old('category', $menu->category) == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="minuman"
                                    {{ old('category', $menu->category) == 'minuman' ? 'selected' : '' }}>Minuman</option>
                                <option value="camilan"
                                    {{ old('category', $menu->category) == 'camilan' ? 'selected' : '' }}>Camilan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Deskripsi</label>
                            @error('description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                            <input id="description" type="hidden" name="description"
                                value="{{ old('description', $menu->description) }}">
                            <trix-editor input="description"></trix-editor>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary w-100 me-2">Save Changes</button>
                            <a href="/menu/" class="btn btn-danger w-100 text-white">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        const select_picture = document.getElementById('select-picture');
        const picture_preview = document.querySelector('.picture-preview');
        const black_screen = document.querySelector('.black-screen');

        select_picture.addEventListener('change', function() {
            const files = select_picture.files[0];
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function() {
                picture_preview.src = this.result;
                black_screen.innerHTML =
                    `<p>${files.name} <span class="text-primary fw-bold">click to change</span></p>`;
            });
        });
    </script>

    <script src="/js/formatmoney.js"></script>
@endsection
