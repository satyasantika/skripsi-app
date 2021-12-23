@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Usulan Judul') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('submission.update',$submission) }}">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <div class="form-floating">
                                <textarea class="form-control col-md-12" placeholder="Leave a comment here" id="title" style="height: 100px" name="title" required autofocus>{{ $submission->title }}</textarea>
                                <label for="title" class="col-md-4 col-form-label text-md-right">&nbsp;&nbsp;Usulan Judul Penelitian</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <span class="text-muted">tempelkan link lengkap dokumen usulan (jika ada/ jika diminta dosen)</span>
                            <div class="form-floating">
                                <textarea class="form-control col-md-12" placeholder="Tambahkan link suplemen usulan" id="document" style="height: 100px" name="document" >{{ $submission->document }}</textarea>
                                <label for="document" class="col-md-4 col-form-label text-md-right">&nbsp;&nbsp;Link tambahan</label>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <form action="{{ route('submission.destroy',$submission) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger float-end">
                            {{ __('Hapus') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
