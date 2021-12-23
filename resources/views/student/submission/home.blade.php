@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Usulan Penelitian Anda') }}
                    <a href="{{ route('submission.edit',$submission) }}" class="btn btn-sm btn-primary float-end">Edit</a>
                </div>
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
                        <div class="col-md-auto">
                            <a href="{{ route('guidesubmission.create',$submission) }}" class="btn btn-primary">Pilih Pembimbing</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <table class="table table-responsive">
                                <thead class="">
                                    <tr>
                                        <th></th>
                                        <th>Nama Dosen</th>
                                        <th>Status Ajuan</th>
                                        <th>Status Pembimbing</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($guidesubmissions as $guidesubmission)
                                    <tr>
                                        <td><a href="{{ route('guidesubmission.edit',$guidesubmission) }}" class="btn btn-sm btn-primary">edit</a></td>
                                        <td>{{ $guidesubmission->user->name }}</td>
                                        <td>@if ($guidesubmission->is_approve === NULL)
                                            <span class="badge badge-warning">Menunggu...</span>
                                            @elseif ($guidesubmission->is_approve === true)
                                            <span class="badge badge-success">Diterima</span>
                                            @else
                                            <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>{{ $guidesubmission->guide_order }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="bg-warning">
                                            belum ada ajuan pembimbing
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
