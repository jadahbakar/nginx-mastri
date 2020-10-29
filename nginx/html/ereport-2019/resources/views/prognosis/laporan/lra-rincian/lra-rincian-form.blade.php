@extends('layout.admin')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          	<h3 class="content-header-title">LRA Rincian Prognosis</h3>
          	<div class="row breadcrumbs-top">
            	<div class="breadcrumb-wrapper col-12">
      				<ol class="breadcrumb">
        				<li class="breadcrumb-item"><a href="#">Beranda</a></li>
        				<li class="breadcrumb-item"><a href="#">Prognosis</a></li>
        				<li class="breadcrumb-item active"><a href="#">LRA Rincian Prognosis</a></li>
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
                    			<div class="tab-content px-1 pt-1">
                      				<br />
                                    {!! Form::open(['id'=>'form-cetak', 'method'=>'POST', 'url'=>'prognosis/laporan/lra-rincian-prognosis', 'class'=>'form form-horizontal']) !!}
                                        @if(Auth::user()->view == 1)
                                            <div class="form-group row">
                                                {!! Form::label('kode_pengguna', 'Input Sebagai', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-10">
                                                    {!! Form::select('kode_pengguna', $listPengguna, null, ['class'=>'select2 form-control']) !!}
                                                </div>
                                            </div>
                                        @endif
                      					<div class="form-body">
				                        	<div class="form-group row">
				                        		{!! Form::label('tahun', 'Tahun', ['class' => 'col-md-2 label-control']) !!}
				                          		<div class="col-md-10">
				                          			{!! Form::number('tahun', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Tahun']) !!}
				                          		</div>
				                        	</div>
				                      	</div>
                                        <div class="form-body">
                                            <div class="form-group row">
                                                {!! Form::label('format_laporan', 'Format Laporan', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-10">
                                                    {!! Form::text('format_laporan', 'PDF', ['class'=>'form-control', 'placeholder'=>'Inputkan Format Laporan', 'readonly'=>true]) !!}
                                                </div>
                                            </div>
                                        </div>
                  						<div class="form-body">
                  							<div class="col-md-4 ml-auto">
	                                           <button type="submit" class="btn btn-primary"><i class="ft-printer"></i> Cetak</button>
	                                           <button type="reset" class="btn btn-danger"><i class="ft-refresh-cw"></i> Reset</button>
                                            </div>
                  						</div>
                    				{!! Form::close() !!}  

                                    <hr />
                                    <br />
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-md-6 ml-auto">
                                            <form method="get" action="">
                                                <div class="input-group ">
                                                    <input name="cari" type="text" class="form-control" placeholder="Inputkan Pencarian" value="{{ Request::get('cari') }}">
                                                    <span class="input-group-append">
                                                        <button class="btn btn-info" type="submit"><i class="la la-search"></i> Cari</button>
                                                    </span>
                                                </div>
                                            </form>
                                            <br />
                                        </div>
                                        <div class="col-md-12"> 
                                            <legend></legend>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover" style="white-space: nowrap;">
                                                    <thead class="bg-dark white">
                                                        <tr style="text-align: center;">
                                                            <th width="60px;">Aksi</th>
                                                            <th width="100px;">Status</th>
                                                            <th>Tahun</th>
                                                            <th>Pengguna</th>
                                                            <th>Kode Organisasi</th>
                                                            <th>Organisasi</th>
                                                            <th>Created At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($listProsesLaporanPrognosis as $item)
                                                            @php
                                                                $disabled = '';
                                                                if($item['status'] != 'Sukses'){
                                                                    $disabled = 'disabled';
                                                                }
                                                            @endphp
                                                            <tr>
                                                                <td style="padding: 10px;">
                                                                    <center>
                                                                        <div class="btn-group btn-group-xs" role="group" aria-label="Basic example">
                                                                            <a href="{!! url('/').$item['direktori_file'] !!}" id="buttonDownload-{!! $item['id'] !!}" class="btn btn-social-icon btn-primary btn-xs {!! $disabled !!}" download><i class="ft-download"></i></a>
                                                                            <a href="{!! url('/').$item['direktori_file'] !!}" id="buttonPrint-{!! $item['id'] !!}" class="btn btn-social-icon btn-info btn-xs {!! $disabled !!}" target="_blank"><i class="ft-printer"></i></a>
                                                                        </div>
                                                                    </center>
                                                                </td>
                                                                <td>
                                                                    <center>
                                                                        <div id="status-{!! $item['id'] !!}">{!! statusProses($item['status']) !!}</div>
                                                                    </center>
                                                                </td>
                                                                <td>{{ $item['tahun'] }}</td>
                                                                <td>{{ $item['kode_pengguna'] }}</td>
                                                                <td>{{ $item['kode_organisasi'] }}</td>
                                                                <td>{{ $item->organisasi['nama_organisasi'] }}</td>
                                                                <td>{{ $item['created_at'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ml-auto">
                                             {{ $listProsesLaporanPrognosis->render() }}
                                        </div>
                                    </div>
                                    <!-- /.row -->
                    			</div>
                  			</div>
                		</div>
              		</div>
            	</div>
          	</div>
        </section>
        <!-- Tabs with Icons end -->
    </div>
@endsection

@section('javascript')
	<script type="text/javascript">
        $(document).ready(function() {  
            @if(Auth::user()->view == 3)
                socket.on("channel-name-{!! Auth::user()->kode_pengguna !!}:App\\Events\\Prognosis\\NotifikasiLaporanRincianPrognosisEvent", function(message){
                    $("#status-"+message.idProsesLaporan).html(message.labelHtml);
                    if(message.status == 'Sukses'){
                        var urlFile = '{!! url('/') !!}'+message.direktoriFile;
                        $("#buttonDownload-"+message.idProsesLaporan).removeClass('disabled').attr("href", urlFile);
                        $("#buttonPrint-"+message.idProsesLaporan).removeClass('disabled').attr("href", urlFile);
                    }
                });
            @elseif(Auth::user()->view == 2)
                socket.on("channel-name-{!! Auth::user()->organisasi !!}:App\\Events\\Prognosis\\NotifikasiLaporanRincianPrognosisEvent", function(message){
                    $("#status-"+message.idProsesLaporan).html(message.labelHtml);
                    if(message.status == 'Sukses'){
                        var urlFile = '{!! url('/') !!}'+message.direktoriFile;
                        $("#buttonDownload-"+message.idProsesLaporan).removeClass('disabled').attr("href", urlFile);
                        $("#buttonPrint-"+message.idProsesLaporan).removeClass('disabled').attr("href", urlFile);
                    }
                });
            @elseif(Auth::user()->view == 1)
                socket.on("channel-name-main-admin:App\\Events\\Prognosis\\NotifikasiLaporanRincianPrognosisEvent", function(message){
                    $("#status-"+message.idProsesLaporan).html(message.labelHtml);
                    if(message.status == 'Sukses'){
                        var urlFile = '{!! url('/') !!}'+message.direktoriFile;
                        $("#buttonDownload-"+message.idProsesLaporan).removeClass('disabled').attr("href", urlFile);
                        $("#buttonPrint-"+message.idProsesLaporan).removeClass('disabled').attr("href", urlFile);
                    }
                });
            @endif

            $("#form-cetak").validate({
                rules: {
                    tahun: "required"
                },
                messages: {
                    tahun: "Kolom tahun harus diisi"
                }
            });
        });
    </script>
@endsection