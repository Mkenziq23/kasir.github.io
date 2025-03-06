@extends('layouts.main')

@section('container')
    <h1 class="app-page-title mb-3">All Employees</h1>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="/user/delete">
                        @csrf
                        <div class="card shadow-sm p-3">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>
                                                <input class="form-check-input" type="checkbox" id="select-all">
                                            </th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="align-middle">
                                                    @if ($user->level->id !== 1 && $user->level->id !== auth()->user()->id)
                                                        <input class="form-check-input user-checkbox" type="checkbox"
                                                            name="users[]" value="{{ $user->id }}">
                                                    @endif
                                                </td>
                                                <td class="align-middle d-flex align-items-center">
                                                    <div class="rounded-circle"
                                                        style="width: 40px; height: 40px; background-size: cover; background-position: center; background-image: url('{{ asset('storage/profile/' . $user->picture) }}');">
                                                    </div>
                                                    <div class="ms-3">
                                                        <span class="fw-bold">{{ $user->email }}</span>
                                                        <br>
                                                        <span class="text-muted small">Added:
                                                            {{ $user->created_at->format('d/m/Y') }}</span>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    {{ $user->username === auth()->user()->username ? $user->username . ' (You)' : $user->username }}
                                                </td>
                                                <td class="align-middle">{{ ucfirst($user->level->level) }}</td>
                                                <td class="align-middle">
                                                    <a href="/user/{{ $user->id }}/edit" class="btn btn-sm btn-warning">
                                                        <i class="fa-regular fa-pen-to-square"></i> Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <span class="text-muted">Selected: <span id="selected-count">0</span></span>
                                <button type="submit" class="btn btn-danger" id="delete-button" disabled>
                                    <i class="fa fa-trash"></i> Delete Selected
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.user-checkbox');
            const deleteButton = document.getElementById('delete-button');
            const selectedCount = document.getElementById('selected-count');

            function updateCount() {
                const checkedCount = document.querySelectorAll('.user-checkbox:checked').length;
                selectedCount.textContent = checkedCount;
                deleteButton.disabled = checkedCount === 0;
            }

            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = selectAll.checked);
                updateCount();
            });

            checkboxes.forEach(cb => cb.addEventListener('change', updateCount));

            deleteButton.addEventListener('click', function(event) {
                if (!confirm('Are you sure you want to delete ' + selectedCount.textContent +
                        ' selected employees?')) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
