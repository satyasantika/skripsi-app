@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Status Pengajuan Pembimbing') }}
                    <a href="{{ route('council.home') }}" class="btn btn-sm btn-danger float-end">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        {{-- <th></th> --}}
                                        <th>Mahasiswa</th>
                                        <th class="text-end">Ajuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($submissionlists as $submissionlist)
                                    @php
                                        $guides = App\Models\Guide::where('submission_id',$submissionlist->id)->get();
                                        // dd($submissionlist);
                                    @endphp
                                    <tr>
                                        {{-- <td><a href="{{ route('submissionlist.edit',$submissionlist) }}" class="btn btn-sm btn-primary">edit</a></td> --}}
                                        <td>{{ $submissionlist->user->name }}</td>
                                        <td>
                                            {{ $submissionlist->title }}
                                            <hr>
                                            @forelse ($guides as $guide)
                                                @php
                                                    $order = $guide->guide_group->guide_1 == 0 ? 2 : 1;
                                                @endphp
                                                <div>
                                                    Pembimbing {{ $order }}: <b>{{ $guide->guide_group->guide_allocation->user->name }}</b>
                                                    @if (is_null($guide->is_approve))
                                                    <span class="badge bg-warning">Menunggu respon...</span>
                                                    @elseif ($guide->is_approve)
                                                    <span class="badge bg-success">Ajuan Diterima</span>
                                                    @else
                                                    <span class="badge bg-danger">Ajuan Ditolak</span>
                                                    @endif
                                                </div>
                                            @empty
                                                <span class="badge bg-warning">Belum Mengajukan Pembimbing</span>
                                            @endforelse
                                        </td>
                                    </tr>
                                    @empty
                                        Belum ada ajuan judul
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
