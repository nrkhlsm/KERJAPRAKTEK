@extends('pemohon.partials.master')
@section('navbar')
@parent
@stop
@section('sidebar')
@parent
@stop
@section('page-title')
<div class="mb-2 content-header-left col-md-4 col-12">
	<h3 class="content-header-title">Pengajuan Akta Perseroan Komanditer</h3>
</div>
<div class="content-header-right col-md-8 col-12">
	<div class="breadcrumbs-top float-md-right">
		<div class="mr-1 breadcrumb-wrapper">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a>
				</li>
				<li class="breadcrumb-item active">komanditer
				</li>
			</ol>
		</div>
	</div>
</div>
@endsection
@section('content')
<section>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-content">
					<div class="card-body">
						<h4 class="card-title">Persyaratan Pengajuan Akta Perseroan Komanditer</h4>
						<p class="card-text">Untuk mengajukan akta perseroan komanditer perlu diperhatikan persyaratan di bawah ini :</p>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							Scan KTP
						</li>
						<li class="list-group-item">
							Scan NPWP pribadi
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-content">
					<div class="card-body">
						<h4 class="card-title">Form Pengajuan Akta Perseroan Komanditer</h4>
						<form class="form" method="POST" enctype="multipart/form-data" action="{{ route('perseroancommanditer.update', $data->id) }}">
							@csrf
							@method('PUT')
							<div class="form-body">
								<div class="form-group">
									<label for="namaPT">Nama PT/CV</label>
									<input type="text" id="namaPT" class="form-control" name="nama_pt" value="{{ $data->nama_pt }}">
								</div>
								<div class="form-group">
									<label for="alamat">Alamat</label>
									<textarea name="alamat" class="form-control">{{ $data->alamat }}</textarea>
								</div>
								<div class="form-group">
									<label for="ScanKtp">Scan KTP </label>
									<input type="file" id="ScanKtp" class="form-control" name="ktp">
								</div>
								<div class="form-group">
									<label for="ScanKk">Scan NPWP Pribadi</label>
									<input type="file" id="ScanKk" class="form-control" name="npwp">
								</div>
							</div>
							<div class="form-actions center">
								<button type="submit" class="btn btn-outline-primary">Kirim</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection