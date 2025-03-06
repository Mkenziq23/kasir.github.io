@extends('layouts.main')

@section('container')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $menu->name }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('storage/' . $menu->picture) }}" class="img-fluid d-block mx-auto mb-3"
                        alt="{{ $menu->name }}">
                    <p><strong>Price:</strong> IDR {{ number_format($menu->price, 0, ',', '.') }}</p>
                    <p><strong>Description:</strong> {{ $menu->description }}</p>
                    <p><strong>Added on:</strong> {{ $menu->created_at->diffForHumans() }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
