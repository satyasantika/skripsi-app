@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Kuota Pembimbing') }}
                    <a href="{{ route('user.index') }}" class="btn btn-sm btn-danger float-end">kembali</a>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>
                        <div class="col-md-8">
                            <b>{{ $user->name }}</b>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Akses Login') }}</label>
                        <div class="col-md-8">
                            <b>{{ $user->username }}</b>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Peran') }}</label>
                        <div class="col-md-8">
                            @forelse ($user->getRoleNames() as $role)
                                <a href="{{ route('user.role.remove',[$user,$role]) }}" class="btn btn-sm btn-outline-danger">unset</a>
                                {{ $role }}
                            @empty
                                belum ada peran
                            @endforelse
                            <br>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            + peran
                            </button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Set Role User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('user.role.assign',$user) }}" method="post">
                            <div class="modal-body">
                                @csrf
                                <select class="form-select" aria-label="Default select example" name='role'>
                                    @forelse ($roles as $setrole)
                                    <option value="{{ $setrole }}">{{ $setrole }}</option>
                                    @empty
                                    <option >Belum ada Role</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary">simpan</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
