@extends('layout.admin')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          	<h3 class="content-header-title">Kode Kegiatan Prognosis</h3>
          	<div class="row breadcrumbs-top">
            	<div class="breadcrumb-wrapper col-12">
      				<ol class="breadcrumb">
        				<li class="breadcrumb-item"><a href="#">Beranda</a></li>
        				<li class="breadcrumb-item"><a href="#">Prognosis</a></li>
        				<li class="breadcrumb-item active"><a href="#">Kode Kegiatan Prognosis</a></li>
      				</ol>
            	</div>
          	</div>
        </div>
     </div>

    <div class="content-body">
       <!-- Tabs with Icons start -->
        <section id="tabs-with-icons">
          	<div class="row match-height">
            	<div class="col-xl-12 col-lg-12">
              		<div class="card">
                		<div class="card-content">
                  			<div class="card-body">
                    			<ul class="nav nav-tabs">
                      				<li class="nav-item">
                        				<a class="nav-link" href="{{ url('prognosis/kode-kegiatan') }}"><i class="la la-table"></i> Lihat Data</a>
                      				</li>
                      				<li class="nav-item">
                        				<a class="nav-link active" href="{{ url('prognosis/kode-kegiatan/create') }}"><i class="la la-list"></i> Tambah Data</a>
                      				</li>
                    			</ul>
                    			<div class="tab-content px-1 pt-1">
                      				<br />
                      				@if($var['method']=='edit')
	                                    {!! Form::model($listKodeKegiatan, ['method'=>'PATCH', 'url'=> 'prognosis/kode-kegiatan/'.$listKodeKegiatan->id.$var['url']['all'], 'id'=>'form-kode-kegiatan', 'class'=>'form form-horizontal']) !!}
	                                @elseif($var['method']=='create')
	                                    {!! Form::open(['id'=>'form-kode-kegiatan', 'method'=>'POST', 'url'=>'prognosis/kode-kegiatan', 'class'=>'form form-horizontal']) !!}
	                                @else
	                                    {!! Form::model($listKodeKegiatan, ['class'=>'form form-horizontal']) !!}
	                                @endif
                      					<div class="form-body">
                                            @if(Auth::user()->view == 1)
                                                <div class="form-group row">
                                                    {!! Form::label('kode_pengguna', 'Input Sebagai', ['class' => 'col-md-2 label-control']) !!}
                                                    <div class="col-md-10">
                                                        {!! Form::select('kode_pengguna', $listPengguna, null, ['class'=>'select2 form-control', 'placeholder'=>'Pilih User']) !!}
                                                    </div>
                                                </div>
                                            @endif
				                        	<div class="form-group row">
				                        		{!! Form::label('kode_program', 'Kode Program', ['class' => 'col-md-2 label-control']) !!}
				                          		<div class="col-md-4">
				                          			{!! Form::text('kode_program', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Kode Program', 'readonly'=>true]) !!}
				                          		</div>
				                          		{!! Form::label('uraian_program', 'Uraian Kode Program', ['class' => 'col-md-2 label-control']) !!}
				                          		<div class="col-md-4">
				                          			<div class="input-group">
				                          				{!! Form::text('uraian_program', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Uraian Kode Program', 'readonly'=>true]) !!}
				                          				<div class="input-group-append">
								                          	<a class="btn btn-primary" style="color: white;" data-toggle="modal" data-target="#modalKodeProgram" onclick="loadData()"><li class="la la-search"></li> Cari</a>
								                        </div>
				                          			</div>
				                          		</div>
				                        	</div>
				                        	<div class="form-group row">
				                        		{!! Form::label('kode_kegiatan', 'Kode Kegiatan', ['class' => 'col-md-2 label-control']) !!}
				                          		<div class="col-md-4">
				                          			{!! Form::text('kode_kegiatan', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Kode Kegiatan', 'maxlength'=>3]) !!}
				                          		</div>
				                          		{!! Form::label('uraian_kegiatan', 'Uraian Kode Kegiatan', ['class' => 'col-md-2 label-control']) !!}
				                          		<div class="col-md-4">
				                          			{!! Form::text('uraian_kegiatan', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Uraian Kode Kegiatan']) !!}
				                          		</div>
				                        	</div>
				                        	<div class="form-group row">
				                        		{!! Form::label('kode_organisasi', 'Kode Organisasi', ['class' => 'col-md-2 label-control']) !!}
				                          		<div class="col-md-4">
				                          			{!! Form::text('kode_organisasi', (isset($var['kode_organisasi'])?$var['kode_organisasi']:null), ['class'=>'form-control', 'placeholder'=>'Inputkan Kode Organisasi', 'readonly'=>true]) !!}
				                          		</div>
				                          		{!! Form::label('nama_organisasi', 'Nama Organisasi', ['class' => 'col-md-2 label-control']) !!}
				                          		<div class="col-md-4">
				                          			{!! Form::text('nama_organisasi', (isset($var['nama_organisasi'])?$var['nama_organisasi']:null), ['class'=>'form-control', 'placeholder'=>'Inputkan Nama Organisasi', 'readonly'=>true]) !!}
				                          		</div>
				                        	</div>
				                      	</div>
                  						<div class="form-actions">
                  							<div class="col-md-4 ml-auto">
	                  							@if($var['method']=='edit')
	                                                <button type="submit" class="btn btn-primary"><i class="ft-edit-3"></i> Update</button>
                                                    <button type="reset" class="btn btn-danger"><i class="ft-refresh-cw"></i> Reset</button>
	                                            @elseif($var['method']=='create')
	                                                <button type="submit" class="btn btn-primary"><i class="ft-save"></i> Simpan</button>
	                                                <button type="reset" class="btn btn-danger"><i class="ft-refresh-cw"></i> Reset</button>
	                                            @else
	                                                <a href="{{ url()->previous() }}" class="btn btn-info"><i class="ft-corner-up-left"></i> Kembali</a>
	                                            @endif
                                            </div>
                  						</div>
                    				{!! Form::close() !!}  
                    			</div>
                  			</div>
                		</div>
              		</div>
            	</div>
          	</div>
        </section>
        <!-- Tabs with Icons end -->
    </div>


    <!-- Modal -->
  	<div class="modal animated slideInDown text-left" id="modalKodeProgram" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    	<div class="modal-dialog modal-lg" role="document">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title" id="myModalLabel17">Pencarian Kode Program</h4>
      				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        				<span aria-hidden="true">&times;</span>
      				</button>
        		</div>
        		<div class="modal-body">
                    <form method="GET" action="" id="formCari">
                        <div class="input-group">
                            <input name="cari" id="cari" type="text" class="form-control" placeholder="Inputkan Pencarian">
                            <span class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="la la-search"></i> Cari</button>
                            </span>
                        </div>
                    </form>
                    <hr>
        			<div id="areaAKunModalKodeProgram"></div>
       	 		</div>
      		</div>
    	</div>
  </div>
@endsection

@section('javascript')
	<script type="text/javascript">
		function loadData(){
            var kodePengguna = ($('#kode_pengguna').val()!=''?$('#kode_pengguna').val():'');
            $("#areaAKunModalKodeProgram").load(encodeURI('{!! url('/prognosis/kode-kegiatan/kode-program?kodePengguna=') !!}'+kodePengguna));
        }

        $(document).ready(function() {  
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                //console.log($(this).attr('href').split('page='));
                var page = $(this).attr('href').split('page=')[1];
                var cari = $('#cari').val();
                var kodePengguna = ($('#kode_pengguna').val()!=''?$('#kode_pengguna').val():'');
                $("#areaAKunModalKodeProgram").load(encodeURI('{!! url('/prognosis/kode-kegiatan/kode-program') !!}?page='+page+'&cari='+cari+'&kodePengguna='+kodePengguna));
            });

            $(document).on('submit', '#formCari', function (e) {
                e.preventDefault();
                var cari = $('#cari').val();
                var kodePengguna = ($('#kode_pengguna').val()!=''?$('#kode_pengguna').val():'');
                $("#areaAKunModalKodeProgram").load(encodeURI('{!! url('/prognosis/kode-kegiatan/kode-program') !!}?cari='+cari+'&kodePengguna='+kodePengguna));
            });

            $(document).on('click', '#buttonPilih', function (e) {
                e.preventDefault();
                var id = $(this).attr('data-value');

                $.ajax({
                    method : 'post',
                    url : '{!! url('/prognosis/kode-kegiatan/kode-program') !!}',
                    data : 'id='+id,
                }).done(function (data) {
                    // console.log(data);
                    $("#cari").val("");
                    $("#kode_program").val(data.kdRekening);
                    $("#uraian_program").val(data.nmRekening);
                });
            });

            $('#kode_pengguna').change(function(){
                var kodePengguna = ($('#kode_pengguna').val()!=''?$('#kode_pengguna').val():'');
                $.ajax({
                    method : 'post',
                    url : '{!! url('/prognosis/kode-kegiatan/organisasi') !!}',
                    data : 'kodePengguna='+kodePengguna,
                }).done(function (data) {
                    // console.log(data);
                    $("#kode_program").val("");
                    $("#uraian_program").val("");
                    $("#kode_organisasi").val(data.kode_organisasi);
                    $("#nama_organisasi").val(data.nama_organisasi);
                });
            });

            $("#form-kode-kegiatan").validate({
                rules: {
                    kode_program: "required",
                    kode_kegiatan: "required",
                    uraian_kegiatan: "required",
                    kode_organisasi: "required",
                    nama_organisasi: "required"
                },
                messages: {
                    kode_program: "Kolom kode program harus diisi",
                    kode_kegiatan: "Kolom kode kegiatan harus diisi",
                    uraian_kegiatan: "Kolom uraian kode kegiatan harus diisi",
                    kode_organisasi: "Kolom kode organisasi harus diisi",
                    nama_organisasi: "Kolom nama organisasi harus diisi"
                }
            });
        });
    </script>
@endsection