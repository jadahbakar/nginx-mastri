@extends('layouts.admin')

@section('konten')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Laporan</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Beranda</a></li>
            <li class="breadcrumb-item active">Laporan</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active">
                        <br />
                            {!! Form::open(['id'=>'form-cetak', 'method'=>'POST', 'route'=>'cetak-laporan', 'class'=>'form-horizontal', 'target'=>'_blank']) !!}
                            <div class="form-group row">
                                {!! Form::label('bulan', 'Bulan', ['class' => 'control-label text-right col-md-2']) !!}
                                <div class="col-md-4">
                                    {!! Form::select('bulan', $var['bulan'], null, ['class'=>'form-control custom-select', 'placeholder'=>'Pilih Bulan']) !!}
                                </div>

                                {!! Form::label('tahun', 'Tahun', ['class' => 'control-label text-right col-md-1']) !!}
                                <div class="col-md-5">
                                    {!! Form::number('tahun', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Tahun']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('format', 'Format Laporan', ['class' => 'control-label text-right col-md-2']) !!}
                                <div class="col-md-10">
                                    {!! Form::select('format', ['pdf'=>'PDF', 'xls'=>'Excel', 'doc'=>'Word'], null, ['class'=>'form-control custom-select', 'placeholder'=>'Pilih Format Laporan']) !!}
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="col-md-10 offset-md-2" style="text-align: right;">
                                    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
                                    {!! Form::reset('Reset', ['class'=>'btn btn-danger']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {  
            $("#form-cetak").validate({
                rules: {
                    bulan: "required",
                    tahun: "required",
                    format: "required"
                },
                messages: {
                    bulan: "Kolom bulan harus diisi",
                    tahun: "Kolom tahun harus diisi",
                    format: "Kolom format laporan harus diisi"
                }
            });
        });
          
    </script>
@endsection