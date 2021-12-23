@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Penetapan Kuota Dosen Pembimbing dan Penguji') }}
                    <a href="{{ route('jurusan.home') }}" class="btn btn-sm btn-danger float-end">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Dosen</th>
                                        <th class="text-end">P1</th>
                                        <th class="text-end">P2</th>
                                        <th class="text-end">Penguji</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($allocations as $allocation)
                                    <tr>
                                        <td><a href="{{ route('allocation.edit',$allocation) }}" class="btn btn-sm btn-primary">edit</a></td>
                                        <td>{{ $allocation->user->name }}</td>
                                        <td class="text-end">{{ $allocation->guide_1 }}</td>
                                        <td class="text-end">{{ $allocation->guide_2 }}</td>
                                        <td class="text-end">{{ $allocation->examinator }}</td>
                                    </tr>
                                    @empty
                                        Belum ada ajuan judul
                                    @endforelse
                                </tbody>
                            </table>
                            <a href="{{ route('allocation.create') }}" class="btn btn-sm btn-primary">+ Tambah Kuota</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
