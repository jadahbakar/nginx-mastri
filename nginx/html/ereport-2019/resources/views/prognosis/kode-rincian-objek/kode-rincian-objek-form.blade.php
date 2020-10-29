@extends('layout.admin')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          	<h3 class="content-header-title">Kode Rincian Objek Prognosis</h3>
          	<div class="row breadcrumbs-top">
            	<div class="breadcrumb-wrapper col-12">
      				<ol class="breadcrumb">
        				<li class="breadcrumb-item"><a href="#">Beranda</a></li>
        				<li class="breadcrumb-item"><a href="#">Prognosis</a></li>
        				<li class="breadcrumb-item active"><a href="#">Kode Rincian Objek Prognosis</a></li>
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
                        				<a class="nav-link" href="{{ url('prognosis/kode-rincian-objek') }}"><i class="la la-table"></i> Lihat Data</a>
                      				</li>
                      				<li class="nav-item">
                        				<a class="nav-link active" href="{{ url('prognosis/kode-rincian-objek/create') }}"><i class="la la-list"></i> Tambah Data</a>
                      				</li>
                    			</ul>
                    			<div class="tab-content px-1 pt-1">
                      				<br />
                      				@if($var['method']=='edit')
	                                    {!! Form::model($listKodeAkunPrognosis, ['method'=>'PATCH', 'url'=> 'prognosis/kode-rincian-objek/'.$listKodeAkunPrognosis->kdRekening.$var['url']['all'], 'id'=>'form-kode-rincian-objek', 'class'=>'form form-horizontal']) !!}
	                                @elseif($var['method']=='create')
	                                    {!! Form::open(['id'=>'form-kode-rincian-objek', 'method'=>'POST', 'url'=>'prognosis/kode-rincian-objek', 'class'=>'form form-horizontal']) !!}
	                                @else
	                                    {!! Form::model($listKodeKegiatan, ['class'=>'form form-horizontal']) !!}
	                                @endif
                      					<div class="form-body">
                                            @if(Auth::user()->view == 1)
                                                <div class="form-group row">
                                                    {!! Form::label('kode_pengguna', 'Input Sebagai', ['class' => 'col-md-2 label-control']) !!}
                                                    <div class="col-md-10">
                                                        {!! Form::select('kode_pengguna', $listPengguna, null, ['class'=>'select2 form-control', 'placeholder'=>'Pilih User', 'disabled'=>($var['method']=='edit'?true:false)]) !!}
                                                    </div>
                                                </div>
                                            @endif
				                        	<div class="form-group row">
				                        		{!! Form::label('kode_kegiatan', 'Kode Kegiatan', ['class' => 'col-md-2 label-control']) !!}
				                          		<div class="col-md-4">
				                          			{!! Form::text('kode_kegiatan', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Kode Kegiatan', 'readonly'=>true]) !!}
				                          		</div>
				                          		{!! Form::label('uraian_kode_kegiatan', 'Uraian Kode Kegiatan', ['class' => 'col-md-2 label-control']) !!}
				                          		<div class="col-md-4">
				                          			<div class="input-group">
				                          				{!! Form::text('uraian_kode_kegiatan', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Uraian Kode Kegiatan', 'readonly'=>true]) !!}
				                          				<div class="input-group-append">
								                          	<a class="btn btn-primary" style="color: white;" data-toggle="modal" data-target="#modalKode" onclick="loadDataKodeKegiatan()"><li class="la la-search"></li> Cari</a>
								                        </div>
				                          			</div>
				                          		</div>
				                        	</div>
                                            <div class="form-group row">
                                                {!! Form::label('kode_rincian_objek', 'Kode Rincian Objek', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-4">
                                                    {!! Form::text('kode_rincian_objek', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Kode Rincian Objek', 'readonly'=>true]) !!}
                                                </div>
                                                {!! Form::label('uraian_kode_rincian_objek', 'Uraian Kode Rincian Objek', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        {!! Form::text('uraian_kode_rincian_objek', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Uraian Kode Rincian Objek', 'readonly'=>true]) !!}
                                                        <div class="input-group-append">
                                                            <a class="btn btn-primary" style="color: white;" data-toggle="modal" data-target="#modalKode" onclick="loadDataKodeRincianObjek()"><li class="la la-search"></li> Cari</a>
                                                        </div>
                                                    </div>
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
                                            <div class="form-group row">
                                                {!! Form::label('anggaran', 'Anggaran', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-10">
                                                    {!! Form::text('anggaran', ($var['method']=='create'?0:null), ['class'=>'form-control', 'placeholder'=>'Inputkan Anggaran', 'readonly'=>true]) !!}
                                                </div>
                                            </div>
                                            @if($var['method']=='edit')
                                                <div class="form-group row">
                                                    {!! Form::label('realisasi', 'Realisasi', ['class' => 'col-md-2 label-control']) !!}
                                                    <div class="col-md-10">
                                                        {!! Form::text('realisasi', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Realisasi', 'readonly'=>true]) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    {!! Form::label('sisa', 'Sisa', ['class' => 'col-md-2 label-control']) !!}
                                                    <div class="col-md-10">
                                                        {!! Form::text('sisa', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Sisa', 'readonly'=>true]) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    {!! Form::label('tambah_kurang', 'Bertambah / (Berkurang)', ['class' => 'col-md-2 label-control']) !!}
                                                    <div class="col-md-10">
                                                        {!! Form::text('tambah_kurang', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Bertambah / (Berkurang)', 'onkeyup'=>'mataUang("tambah_kurang"); hitungPrognosis();']) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    {!! Form::label('jumlah', 'Prognosis', ['class' => 'col-md-2 label-control']) !!}
                                                    <div class="col-md-10">
                                                        {!! Form::text('jumlah', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Prognosis', 'readonly'=>true]) !!}
                                                    </div>
                                                </div>
                                            @endif
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


    @if($var['method'] == 'create')
    <!-- Modal -->
  	<div class="modal animated slideInDown text-left" id="modalKode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    	<div class="modal-dialog modal-lg" role="document">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title" id="myModalLabel"></h4>
      				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        				<span aria-hidden="true">&times;</span>
      				</button>
        		</div>
        		<div class="modal-body">
                    <form class="formku-modal" method="GET" action="" id="formCari">
                        <div class="input-group">
                            <input name="cari" id="cari" type="text" class="form-control" placeholder="Inputkan Pencarian">
                            <span class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="la la-search"></i> Cari</button>
                            </span>
                        </div>
                    </form>
                    <hr>
        			<div id="areaAkunModalKode"></div>
       	 		</div>
      		</div>
    	</div>
    </div>
    @endif
@endsection

@section('javascript')
	<script type="text/javascript">
		function loadDataKodeKegiatan(){
            var kodePengguna = ($('#kode_pengguna').val()!=''?$('#kode_pengguna').val():'');
            $("#myModalLabel").text('Pencarian Kode Kegiatan');
            $(".formku-modal").attr("id","formCariKodeKegiatan");
            $("#areaAkunModalKode").load(encodeURI('{!! url('/prognosis/kode-rincian-objek/kode-kegiatan?kodePengguna=') !!}'+kodePengguna));
        }

        function loadDataKodeRincianObjek(){
            $("#myModalLabel").text('Pencarian Kode Rincian Objek');
            $(".formku-modal").attr("id","formCariKodeRincianObjek");
            $("#areaAkunModalKode").load(encodeURI('{!! url('/prognosis/kode-rincian-objek/kode-rincian-objek') !!}'));
        }

        function hitungPrognosis(){
            var anggaran= $("#anggaran").val().replace(/\./g, '');
            var realisasi= $("#realisasi").val().replace(/\./g, '');
            var sisa = eval(realisasi) - eval(anggaran);
            $("#sisa").val(sisa); mataUang('sisa');

            var tambahKurang = $("#tambah_kurang").val().replace(/\./g, '');
            if(tambahKurang[0] == '('){
                var tambahKurang = tambahKurang.replace(/\(/g, '').replace(/\)/g, ''); 
                tambahKurang *= -1;
            } 
            var prognosis = (eval(sisa)*-1) + eval(tambahKurang);
            $("#jumlah").val(prognosis); mataUang('jumlah');
        }

        $(document).ready(function() {  
            //---------------KODE KEGIATAN-----------------
            $(document).on('click', '#pagination-kode-kegiatan .pagination a', function (e) {
                e.preventDefault();
                //console.log($(this).attr('href').split('page='));
                var page = $(this).attr('href').split('page=')[1];
                var cari = $('#cari').val();
                var kodePengguna = ($('#kode_pengguna').val()!=''?$('#kode_pengguna').val():'');
                $("#areaAkunModalKode").load(encodeURI('{!! url('/prognosis/kode-rincian-objek/kode-kegiatan') !!}?page='+page+'&cari='+cari+'&kodePengguna='+kodePengguna));
            });

            $(document).on('submit', '#formCariKodeKegiatan', function (e) {
                e.preventDefault();
                var cari = $('#cari').val();
                var kodePengguna = ($('#kode_pengguna').val()!=''?$('#kode_pengguna').val():'');
                $("#areaAkunModalKode").load(encodeURI('{!! url('/prognosis/kode-rincian-objek/kode-kegiatan') !!}?cari='+cari+'&kodePengguna='+kodePengguna));
            });

            $(document).on('click', '#buttonPilihKodeKegiatan', function (e) {
                e.preventDefault();
                var id = $(this).attr('data-value');

                $.ajax({
                    method : 'post',
                    url : '{!! url('/prognosis/kode-rincian-objek/kode-kegiatan') !!}',
                    data : 'id='+id,
                }).done(function (data) {
                    // console.log(data);
                    $("#cari").val("");
                    $("#kode_kegiatan").val(data.kode_kegiatan_full);
                    $("#uraian_kode_kegiatan").val(data.uraian_kegiatan);
                });
            });
            //-----------------------------------------------

            //-------------KODE RINCIAN OBJEK---------------
            $(document).on('click', '#pagination-kode-rincian-objek .pagination a', function (e) {
                e.preventDefault();
                //console.log($(this).attr('href').split('page='));
                var page = $(this).attr('href').split('page=')[1];
                var cari = $('#cari').val();
                $("#areaAkunModalKode").load(encodeURI('{!! url('/prognosis/kode-rincian-objek/kode-rincian-objek') !!}?page='+page+'&cari='+cari));
            });

            $(document).on('submit', '#formCariKodeRincianObjek', function (e) {
                e.preventDefault();
                var cari = $('#cari').val();
                $("#areaAkunModalKode").load(encodeURI('{!! url('/prognosis/kode-rincian-objek/kode-rincian-objek') !!}?cari='+cari));
            });

            $(document).on('click', '#buttonPilihKodeRincianObjek', function (e) {
                e.preventDefault();
                var id = $(this).attr('data-value');

                $.ajax({
                    method : 'post',
                    url : '{!! url('/prognosis/kode-rincian-objek/kode-rincian-objek') !!}',
                    data : 'id='+id,
                }).done(function (data) {
                    // console.log(data);
                    $("#cari").val("");
                    $("#kode_rincian_objek").val(data.akun_bas);
                    $("#uraian_kode_rincian_objek").val(data.nama_akun);
                });
            });
            //------------------------------------------

            $('#kode_pengguna').change(function(){
                var kodePengguna = ($('#kode_pengguna').val()!=''?$('#kode_pengguna').val():'');
                $.ajax({
                    method : 'post',
                    url : '{!! url('/prognosis/kode-rincian-objek/organisasi') !!}',
                    data : 'kodePengguna='+kodePengguna,
                }).done(function (data) {
                    // console.log(data);
                    $("#kode_kegiatan").val("");
                    $("#uraian_kode_kegiatan").val("");
                    $("#kode_organisasi").val(data.kode_organisasi);
                    $("#nama_organisasi").val(data.nama_organisasi);
                });
            });

            $("#form-kode-rincian-objek").validate({
                rules: {
                    kode_kegiatan: "required",
                    kode_rincian_objek: "required",
                    kode_organisasi: "required",
                    nama_organisasi: "required"
                },
                messages: {
                    kode_kegiatan: "Kolom kode kegiatan harus diisi",
                    kode_rincian_objek: "Kolom kode rincian objek harus diisi",
                    kode_organisasi: "Kolom kode organisasi harus diisi",
                    nama_organisasi: "Kolom nama organisasi harus diisi"
                }
            });
        });
    </script>
@endsection