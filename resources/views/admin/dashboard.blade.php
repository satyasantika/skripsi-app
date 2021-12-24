@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Administrator') }}</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-auto">
                            <a href="{{ route('user.index') }}" class="btn btn-primary">Tabel Pengguna</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
