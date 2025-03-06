@extends('layouts.main')

@section('container')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top: 7rem">
                <div class="card shadow-lg">
                    {{-- <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Edit Employee</h5>
                    </div> --}}
                    <div class="card-body">
                        <form action="/user/{{ $users->id }}" method="POST">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username', $users->username) }}" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $users->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $users->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="level_id" class="form-label">Role</label>
                                <select class="form-select @error('level_id') is-invalid @enderror" id="level_id"
                                    name="level_id" required>
                                    @if ($users->level_id == 1)
                                        <option value="1" selected>👑 Manager</option>
                                    @else
                                        <option value="2" @if (old('level_id', $users->level_id) == '2') selected @endif>👨‍💼
                                            Cashier</option>
                                        <option value="3" @if (old('level_id', $users->level_id) == '3') selected @endif>🛠 Admin
                                        </option>
                                    @endif
                                </select>
                                @error('level_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 text-white">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
