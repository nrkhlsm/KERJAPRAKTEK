@extends('pemohon.partials.master')
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
        <div class="col-12">
        <div class="card">
				<div class="card-content">
					<div class="card-body">
						<h4 class="card-title">Persyaratan Pengajuan Akta Jual Beli</h4>
						<p class="card-text">Untuk mengajukan akta jual beli perlu diperhatikan persyaratan di bawah ini :</p>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							Scan KTP untuk pihak penjual dan pembeli
						</li>
						<li class="list-group-item">
							Scan Kartu Keluarga untuk pihak penjual dan pembeli
						</li>
						<li class="list-group-item">
							Scan akta Perkawinan
						</li>
						<li class="list-group-item">
							Scan NPWP 
						</li>
						<li class="list-group-item">
                            Jika Keturunan Tionghoa melampirkan surat keterangan berkewarganegaraan indonesia
                        </li>
                        <li class="list-group-item">
                            Ganti nama (jika ada)
                        </li>
                        <li class="list-group-item">
                            Scan sertifikat tanah dan SPT PBB
                    
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
                        <h4 class="card-title">Form Pengajuan Akta Jual Beli</h4>
                        <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('jualbeli.update', $data->id) }}">
                        @csrf
                        @method('PUT')
							<div class="form-body">
								<div class="form-group">
									<label for="JenisBarang">Jenis Barang</label>
									<input type="text" id="JenisBarang" class="form-control" name="jenis_barang" required>
								</div>
								<div class="form-group">
									<label for="keterangan">Keterangan</label>
									<textarea name="keterangan" class="form-control" required></textarea>
								</div>
								<div class="form-group">
									<label for="ScanKtp">Scan KTP pihak satu</label>
									<input type="file" id="ScanKtp" class="form-control" name="ktp_pihak_satu">
								</div>
								<div class="form-group">
									<label for="ScanKk">Scan KK pihak satu</label>
									<input type="file" id="ScanKk" class="form-control" name="kk_pihak_satu">
								</div>
								<div class="form-group">
									<label for="AktaPerkawinan">Akta Perkawinan</label>
									<input type="file" id="AktaPerkawinan" class="form-control" name="akta_perkawinan">
								</div>

								<div class="form-group">
									<label for="NPWp">NPWP</label>
									<input type="file" id="NPWP" class="form-control" name="npwp">
								</div>
                                <div class="form-group">
									<label for="SKBRI">SKBRI</label>
									<input type="file" id="NPWP" class="form-control" name="skbri">
                                </div>
                                <div class="form-group">
									<label for="GantiNAma">ganti nama</label>
									<input type="file" id="GantiNAma" class="form-control" name="ganti_nama">
                                </div>
                                <div class="form-group">
									<label for="ScanKtpdua">Scan KTP pihak dua</label>
									<input type="file" id="ScanKtpdua" class="form-control" name="ktp_pihak_dua">
                                </div>
                                <div class="form-group">
									<label for="ScanKkdua">Scan KK pihak dua</label>
									<input type="file" id="ScanKkdua" class="form-control" name="kk_pihak_dua">
                                </div>
                                <div class="form-group">
									<label for="SertifikatTanah">sertifikat tanah</label>
									<input type="file" id="SertifikatTanah" class="form-control" name="sertifikat_tanah">
                                </div>
                                <div class="form-group">
									<label for="Sptpbb">Spt pbb</label>
									<input type="file" id="Sptpbb" class="form-control" name="spt_pbb">
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