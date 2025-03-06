@extends('layouts.main')

@section('container')
    <div class="col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
        <div class="card card-activity">
            <div class="card-body">
                <h4 class="card-title mb-4">Activity Log</h4>
                <ul class="bullet-line-list">
                    @foreach ($data as $item)
                        <li class="mb-4">
                            <style>
                                .bullet-line-list li:nth-child({{ $loop->iteration }})::before {
                                    background-image: url('/storage/profile/{{ $item->user->picture }}');
                                    width: 40px;
                                    height: 40px;
                                    left: -50px;
                                    top: -2px;
                                    border: 4px solid #e9edfb;
                                    z-index: 2;
                                    background-size: cover;
                                    background-position: center;
                                    border-radius: 50%;
                                }

                                /* Ensure the activity log is responsive */
                                @media (max-width: 768px) {
                                    .bullet-line-list li {
                                        padding-left: 50px;
                                    }

                                    .card-title {
                                        font-size: 1.2rem;
                                    }
                                }
                            </style>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="user-img-wrapper me-3">
                                        <img src="/storage/profile/{{ $item->user->picture }}"
                                            class="img-fluid rounded-circle" alt="User Image"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <span class="text-light-green">{{ $item->user->name }} </span> &nbsp
                                        {{ $item->action }}
                                        <p class="small text-muted">{{ $item->user->level->level }}</p>
                                    </div>
                                </div>
                                <p class="text-muted small">{{ $item->created_at->diffForHumans() }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
