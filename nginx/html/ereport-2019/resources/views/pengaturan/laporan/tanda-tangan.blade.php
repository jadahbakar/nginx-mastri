@extends('layout.admin')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          	<h3 class="content-header-title">Tanda Tangan</h3>
          	<div class="row breadcrumbs-top">
            	<div class="breadcrumb-wrapper col-12">
      				<ol class="breadcrumb">
        				<li class="breadcrumb-item"><a href="#">Beranda</a></li>
        				<li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
                        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
        				<li class="breadcrumb-item active"><a href="#">Tanda Tangan Pejabat</a></li>
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
	                                {!! Form::model($tandaTangan, ['method'=>'POST', 'url'=> 'pengaturan/laporan/tanda-tangan', 'class'=>'form form-horizontal']) !!}
                      					<div class="form-body">
				                        	<div class="form-group row">
				                        		{!! Form::label('status', 'Status', ['class' => 'col-md-2 label-control']) !!}
				                          		<div class="col-md-10">
				                          			{!! Form::select('status', ['Tidak Aktif'=>'Tidak Aktif', 'Aktif'=>'Aktif'], null, ['class'=>'form-control']) !!}
				                          		</div>
				                        	</div>
				                      	</div>
                                        <div class="form-body">
                                            <div class="form-group row">
                                                {!! Form::label('tanggal', 'Tanggal', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-10">
                                                    {!! Form::text('tanggal', null, ['class'=>'form-control singledate', 'placeholder'=>'Inputkan Tanggal']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group row">
                                                {!! Form::label('pejabat_penanda_tangan_1', 'Pejabat Penandatangan 1', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-10">
                                                    {!! Form::text('pejabat_penanda_tangan_1', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Pejabat Penandatangan 1']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group row">
                                                {!! Form::label('pejabat_penanda_tangan_2', 'Pejabat Penandatangan 2', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-10">
                                                    {!! Form::text('pejabat_penanda_tangan_2', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Pejabat Penandatangan 2']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group row">
                                                {!! Form::label('nama', 'Nama', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-10">
                                                    {!! Form::text('nama', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Nama']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group row">
                                                {!! Form::label('nip', 'NIP.', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-10">
                                                    {!! Form::text('nip', null, ['class'=>'form-control', 'placeholder'=>'Inputkan NIP.']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group row">
                                                {!! Form::label('jabatan', 'Jabatan', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-10">
                                                    {!! Form::text('jabatan', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Jabatan']) !!}
                                                </div>
                                            </div>
                                        </div>
                  						<div class="form-body">
                  							<div class="col-md-4 ml-auto">
	                                           <button type="submit" class="btn btn-primary"><i class="ft-edit-3"></i> Update</button>
	                                           <button type="reset" class="btn btn-danger"><i class="ft-refresh-cw"></i> Reset</button>
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
@endsection