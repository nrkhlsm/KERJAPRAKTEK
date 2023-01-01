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
    <h3 class="content-header-title">Semua Data User</h3>
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
                        <h4 class="card-title">Semua Data User</h4>
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
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
                                        {{ $key->name }}
                                    </td>
                                    <td class="cell">
                                        {{ $key->email }}
                                    </td>
                                    <td class="cell">
                                        {{ $key->roles->first()->name }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $key->id }}" @if($key->id == Auth::user()->id) {{ __('disabled') }} @endif>
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
                                                        <form id="delete-form{{$key->id}}" action="{{ route('user.destroy', $key->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection