@extends('layouts.main')

@section('container')
    <div class="container py-4">
        <h1 class="app-page-title text-center mb-4">All Menu's</h1>
        <div class="menu mb-4" data-aos="fade-up" data-aos-delay="200">
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#food" role="tab">
                        <h4 class="mb-0">Makanan</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#drink" role="tab">
                        <h4 class="mb-0">Minuman</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#dessert" role="tab">
                        <h4 class="mb-0">Camilan</h4>
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
            <!-- Makanan Tab -->
            <div class="tab-pane fade active show" id="food" role="tabpanel">
                <div class="row g-4">
                    @foreach ($makanan as $food)
                        <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
                            <div class="card h-100 border-0 card-menu shadow-sm">
                                <img src="{{ asset('storage/' . $food->picture) }}" alt="{{ $food->name }}"
                                    class="card-img-top img-fluid" style="object-fit: cover; height: 200px;">
                                <div class="card-body p-3">
                                    <h5 class="card-title text-primary text-capitalize">{{ $food->name }}</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="small mb-0">IDR <span
                                                class="nominal">{{ number_format($food->price, 0, ',', '.') }}</span></p>
                                        <div class="dropdown">
                                            <a href="#" class="text-decoration-none" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <input type="hidden" value="{{ $food->id }}" id="menu_id">
                                                {{-- <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#show" role="button">
                                                        <i class="fa-solid fa-eye mx-2"></i> View
                                                    </a>
                                                </li> --}}
                                                <li>
                                                    <a class="dropdown-item" href="/menu/{{ $food->id }}/edit">
                                                        <i class="fa-solid fa-pen-to-square mx-2"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li class="delete">
                                                    <form action="/menu/{{ $food->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item border-0 bg-transparent"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="fa-solid fa-trash-can mx-2 text-danger"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Minuman Tab -->
            <div class="tab-pane fade" id="drink" role="tabpanel">
                <div class="row g-4">
                    @foreach ($minuman as $drink)
                        <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
                            <div class="card h-100 border-0 card-menu shadow-sm">
                                <img src="{{ asset('storage/' . $drink->picture) }}" alt="{{ $drink->name }}"
                                    class="card-img-top img-fluid" style="object-fit: cover; height: 200px;">
                                <div class="card-body p-3">
                                    <h5 class="card-title text-primary text-capitalize">{{ $drink->name }}</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="small mb-0">IDR <span
                                                class="nominal">{{ number_format($drink->price, 0, ',', '.') }}</span></p>
                                        <div class="dropdown">
                                            <a href="#" class="text-decoration-none" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <input type="hidden" value="{{ $drink->id }}" id="menu_id">
                                                {{-- <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#show" role="button">
                                                        <i class="fa-solid fa-eye mx-2"></i> View
                                                    </a>
                                                </li> --}}
                                                <li>
                                                    <a class="dropdown-item" href="/menu/{{ $drink->id }}/edit">
                                                        <i class="fa-solid fa-pen-to-square mx-2"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li class="delete">
                                                    <form action="/menu/{{ $drink->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item border-0 bg-transparent"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="fa-solid fa-trash-can mx-2 text-danger"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Camilan Tab -->
            <div class="tab-pane fade" id="dessert" role="tabpanel">
                <div class="row g-4">
                    @foreach ($camilan as $item)
                        <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
                            <div class="card h-100 border-0 card-menu shadow-sm">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="{{ $item->name }}"
                                    class="card-img-top img-fluid" style="object-fit: cover; height: 200px;">
                                <div class="card-body p-3">
                                    <h5 class="card-title text-primary text-capitalize">{{ $item->name }}</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="small mb-0">IDR <span
                                                class="nominal">{{ number_format($item->price, 0, ',', '.') }}</span></p>
                                        <div class="dropdown">
                                            <a href="#" class="text-decoration-none" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <input type="hidden" value="{{ $item->id }}" id="menu_id">
                                                {{-- <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#show" role="button">
                                                        <i class="fa-solid fa-eye mx-2"></i> View
                                                    </a>
                                                </li> --}}
                                                <li>
                                                    <a class="dropdown-item" href="/menu/{{ $item->id }}/edit">
                                                        <i class="fa-solid fa-pen-to-square mx-2"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li class="delete">
                                                    <form action="/menu/{{ $item->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item border-0 bg-transparent"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="fa-solid fa-trash-can mx-2 text-danger"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Modal code is commented out --}}
    <!-- <div class="modal fade" id="show" tabindex="-1" aria-hidden="true">
             ... modal content ...
        </div> -->

    <script src="/js/jquery-3.6.3.min.js"></script>
    <script src="/js/show.js"></script>
@endsection
