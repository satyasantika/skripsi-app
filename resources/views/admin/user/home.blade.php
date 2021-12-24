@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Manajemen Akun') }}
                    <a href="{{ route('home') }}" class="btn btn-sm btn-danger float-end">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-auto">
                            <form action="{{ route('user.search') }}" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    {{-- <button class="btn btn-outline-secondary" type="button" id="button-addon1">Button</button> --}}
                                    <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" name="search">
                                    <input type="submit" class="form-control col-md-2" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="search">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nama</th>
                                        <th class="text-end">NIDN/NIM</th>
                                        <th class="text-end">WA</th>
                                        <th class="text-end">email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                    <tr>
                                        <td><a href="{{ route('user.edit',$user) }}" class="btn btn-sm btn-primary">edit</a></td>
                                        <td>{{ $user->name }}</td>
                                        <td class="text-end">{{ $user->username }}</td>
                                        <td class="text-end">{{ $user->phone }}</td>
                                        <td class="text-end">{{ $user->email }}</td>
                                    </tr>
                                    @empty
                                        <div class="alert alert-info">
                                            User tidak ditemukan
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">+ Tambah Kuota</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
