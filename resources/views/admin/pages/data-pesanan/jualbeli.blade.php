@extends('admin.partials.master')
@section('styles')
<style>
    img {
        height: auto;
        max-width: 100%;
    }

    .cell {
        display: table-cell;
    }

    .cell-fluid {
        width: 100%;
    }
</style>
@stop
@section('navbar')
@parent
@stop
@section('sidebar')
@parent
@stop
@section('page-title')
<div class="mb-2 content-header-left col-md-4 col-12">
    <h3 class="content-header-title">Pengajuan Akta Jual Beli</h3>
</div>
<div class="content-header-right col-md-8 col-12">
    <div class="breadcrumbs-top float-md-right">
        <div class="mr-1 breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a>
                </li>
                <li class="breadcrumb-item active">Jual Beli
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection
@section('content')
<section>
    <div class="row">
        <div class="col-4">
            <div class="card">
                <!-- <a class="btn btn-primary btn-lg" href="{{ route('jualbeli.create') }}">Ajukan Permohonan</a> -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">Semua Data Jual Beli</h4>
                        <div style="width: auto; overflow: auto">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="min-width: 50px;">No</th>
                                        <th style="min-width: 150px;">Nama</th>
                                        <th style="min-width: 150px;">Email</th>
                                        <th style="min-width: 150px;">Jenis Barang</th>
                                        <th style="min-width: 150px;">Keterangan</th>
                                        <th style="min-width: 150px;">KTP Pihak 1</th>
                                        <th style="min-width: 150px;">KK Pihak 2</th>
                                        <th style="min-width: 150px;">AKTA KWN</th>
                                        <th style="min-width: 150px;">NPWP</th>
                                        <th style="min-width: 150px;">SKBRI</th>
                                        <th style="min-width: 150px;">GANTI NAMA</th>
                                        <th style="min-width: 150px;">KTP Pihak 2</th>
                                        <th style="min-width: 150px;">KK Pihak 2</th>
                                        <th style="min-width: 150px;">Sertifikat Tanah</th>
                                        <th style="min-width: 150px;">SPT PBB</th>
                                        <th style="min-width: 150px;">File</th>
                                        <th style="min-width: 150px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($data as $key)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td class="cell">
                                            {{ $key->user->name }}
                                        </td>
                                        <td class="cell">
                                            {{ $key->user->email }}
                                        </td>
                                        <td class="cell">
											{{$key->jenis_barang}}											
										</td>
										<td class="cell">
											{{$key->keterangan}}
										</td>
                                        <td class="cell">
                                            <a href="{{ asset('asset/ktp/' . $key->ktp_pihak_satu) }}" target="_blank">File KTP Pihak 1</a>
                                        </td>
                                        <td class="cell">
                                            <a href="{{ asset('asset/kk/' . $key->kk_pihak_satu) }}" target="_blank">File KK Pihak 1</a>
                                        </td>
                                        <td class="cell">
                                            <a href="{{ asset('asset/akta_kawin/' . $key->akta_perkawinan) }}" target="_blank">File Akta Nikah</a>
                                        </td>
                                        <td>
                                            <a href="{{ asset('asset/npwp/' . $key->npwp) }}" target="_blank">File NPWP</a>
                                        </td>
                                        <td>
                                            <a href="{{ asset('asset/skbri/' . $key->skbri) }}" target="_blank">File SKBRI</a>
                                        </td>
                                        <td>
                                            <a href="{{ asset('asset/ganti_nama/' . $key->ganti_nama) }}" target="_blank">File Ganti Nama</a>
                                        </td>
                                        <td>
                                            <a href="{{ asset('asset/ktp/' . $key->ktp_pihak_dua) }}" target="_blank">File KTP Pihak 2</a>
                                        </td>
                                        <td>
                                            <a href="{{ asset('asset/kk/' . $key->kk_pihak_dua) }}" target="_blank">File KK Pihak 2</a>
                                        </td>
                                        <td>
                                            <a href="{{ asset('asset/sertifikat_tanah/' . $key->sertifikat_tanah) }}" target="_blank">Sertifikat Tanah</a>
                                        </td>
                                        <td>
                                            <a href="{{ asset('asset/spt_pbb/' . $key->spt_pbb) }}" target="_blank">SPT PBB</a>
                                        </td>
                                        <td>
											@if($key->encrypt =='0')
											<a class="btn btn-danger btn-sm" href="{{ route('rsa.jual.command.decyprt', $key->id) }}">Terenkripsi</a>
											@else
											<a class="btn btn-success btn-sm" href="{{ route('rsa.jual.command.encrpty', $key->id) }}">Terdekripsi</a>
											@endif
										</td>
                                        <td>
                                            @if($key->id != Auth::user()->id)
                                            <form action="{{ route('datapesanan.jualbeli.ubah-status', $key->id) }}" method="POST" hidden id="UpdateStatus">
                                                @csrf
                                            </form>
                                            <a href="{{ route('datapesanan.jualbeli.ubah-status', $key->id) }}" class="btn @if($key->status) btn-success @else btn-warning @endif btn-sm" onclick="
                                                event.preventDefault();
                                                document.getElementById('UpdateStatus').submit();">
                                                <i class="la la-check"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $key->id }}">
                                                <i class="la la-trash"></i>
                                            </button>
                                            <div class="modal fade" id="deleteModal{{ $key->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $key->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel{{ $key->id }}">Hapus Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin ingin menghapus Data?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="text-white btn btn-light" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-danger" onclick="
                                                                event.preventDefault();
                                                                document.getElementById('delete-form{{$key->id}}').submit();
                                                            ">Hapus</button>
                                                            	<form id="delete-form{{$key->id}}" action="{{ route('jualbeli.destroy', $key->id) }}" method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection