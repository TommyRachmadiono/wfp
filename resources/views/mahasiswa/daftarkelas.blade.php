@extends('templates.mastermhs')
@section('content')
<div class="container">
	<div class="panel panel-primary" style="margin-top: 6%">
		<div class="panel-heading">
			<h3 class="panel-title">Daftar Kelas Matakuliah
				<a class="anchorjs-link" href="#panel-title">
					<span class="anchorjs-icon"></span>
				</a>
			</h3>
		</div>
		<div class="panel-body">
			@if($fpps->count()==0)
			<h4 class="red">Tidak ada perwalian yang buka saat ini</h4>
			@else
			<hr>
			<form id="form_input_matkul" action="{{url('carimk')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

				<div class="form-group">
					<label class="control-label col-md-4 col-sm-4 col-xs-4" for="last-name">Kode MK <span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-3">
						@if(isset($jadwalmatkul))
							@if($jadwalmatkul->count()>0)
							<input type="text" id="kodemk" name="kodemk" required="required" class="form-control" value="{{$jadwalmatkul[0]->kode}}">
							@else
							<input type="text" id="kodemk" name="kodemk" required="required" class="form-control">
							@endif
						@else
						<input type="text" id="kodemk" name="kodemk" required="required" class="form-control">
						@endif						
					</div>
					<button id="btnCari" type="submit" class="btn btn-success">Cari</button>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4 col-sm-4 col-xs-4" for="last-name">Nama MK <span class="required">:</span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						@if(isset($namamk))
						@if($namamk->count()>0)
						<h5>{{$namamk[0]->nama}}</h5>
						@else
						<h5 class="red">{{'Kode MK tidak ditemukan'}}</h5>
						@endif
						@else
						-
						@endif
					</div>
					@if(isset($error))
					<div class="row" style="text-align: center;">
						<h5 class="col-md-12 red">KP tidak ditemukan</h5>
					</div>
					@endif
				</div>
				<hr>
			</form>
			@endif

			<!-- list kelas -->
			@if(isset($namamk))
			@if($namamk->count()>0)
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="text-align: center;">Kode Mata Kuliah</th>
						<th style="text-align: center;">Mata Kuliah</th>
						<th style="text-align: center;">SKS</th>
						<th style="text-align: center;">Hari</th>
						<th style="text-align: center;">Jam</th>
						<th style="text-align: center;">KP</th>
						<th style="text-align: center;">Ruang</th>
						<th style="text-align: center;">Kapasitas</th>
						<th style="text-align: center;">Sisa Kapasitas</th>
						<th style="text-align: center;">Dosen</th>
					</tr>
				</thead>
				<tbody>
					@foreach($jadwalmatkul as $post)
					<tr>
						<th style="text-align: center;">{{$post->kode}}</th>
						<th style="text-align: center;">{{$post->nama}}</th>
						<th style="text-align: center;">{{$post->sks}}</th>
						<th style="text-align: center;">{{$post->hari}}</th>
						<th style="text-align: center;">{{$post->jam_masuk .' - '. $post->jam_keluar}}</th>
						<th style="text-align: center;">{{$post->kp}}</th>
						<th style="text-align: center;">{{$post->ruang}}</th>
						<th style="text-align: center;">{{$post->kapasitas}}</th>
						<th style="text-align: center;">{{$post->kapasitas - $post->jml_mhs}}</th>
						<th style="text-align: center;">{{$post->nama_dosen}}</th>
					</tr>
					@endforeach
				</tbody>
			</table>
			<hr>
			<form id="form_input_matkul" action="{{action('DaftarKelasController@store')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
					<input type="hidden" name="kodemk" value="{{$jadwalmatkul[0]->kode}}">
					<label class="control-label col-md-4 col-sm-4 col-xs-4" for="last-name">Pilih KP <span class="required">*</span>
					</label>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<input type="text" id="kp" name="kp" required="required" class="form-control ">
					</div>
				
				@if(isset($idmk))
				<input type="hidden" value="{{$idmk}}" name="idmk">
				@endif
				
						<button type="submit" class="btn btn-success">Input</button>
					</div>
				</div>
				<hr>
			</form>
			@endif
			@endif
		</div>
	</div>

</div>
@endsection