@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Usulan Pembimbing') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('guidesubmission.update',$guidesubmission) }}">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Pilih Pembimbing') }}</label>

                            <div class="col-md-6">
                                <select id="title" name="lecture_id" class="form-select" aria-label="Default select example" required>
                                    @foreach ($lectures as $dosen)
                                        <option value="{{ $dosen->id }}" {{ $dosen->id === $guidesubmission->lecture_id ? 'selected' : '' }}>{{ $dosen->name }}</option>
                                    @endforeach
                                </select>
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
                    <form action="{{ route('guidesubmission.destroy',$guidesubmission) }}" method="post">
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