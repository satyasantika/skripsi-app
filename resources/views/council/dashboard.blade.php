@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard DBS') }}</div>
                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col-md-auto">
                            <a href="{{ route('guideallocation.index') }}" class="btn btn-primary">Penetapan Kuota Pembimbing</a>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-auto">
                            <a href="{{ route('guidegroup.index') }}" class="btn btn-primary">Penetapan Kelompok Pembimbing</a>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-auto">
                            <a href="{{ route('submissionlist.home') }}" class="btn btn-primary">List Ajuan Mahasiswa</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
