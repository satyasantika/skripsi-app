@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Usulan Penelitian Anda') }}</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Judul Penelitian') }}</label>
                        <div class="col-md-6">
                            {{ $submission->title }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Link Dokumen Pendukung') }}</label>
                        <div class="col-md-6">
                            <a href="{{ $submission->document ?? "" }}">{{ $submission->document ?? "belum ada" }}</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-right"></label>
                        <div class="col-md-6">
                            <a href="{{ route('submission.edit',$submission) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
