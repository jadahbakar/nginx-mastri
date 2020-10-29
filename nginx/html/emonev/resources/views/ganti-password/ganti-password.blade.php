@extends('layouts.admin')

@section('konten')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Ganti Password</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Beranda</a></li>
            <li class="breadcrumb-item active">Ganti Password</li>
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
                            {!! Form::open(['id'=>'form-ganti-password', 'method'=>'POST', 'route'=>'ganti-password', 'class'=>'form-horizontal']) !!}
                            <div class="form-group row">
                                {!! Form::label('password', 'Password', ['class' => 'control-label text-right col-md-2']) !!}
                                <div class="col-md-10">
                                    {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Inputkan Password']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('password2', 'Konfirmasi Password', ['class' => 'control-label text-right col-md-2']) !!}
                                <div class="col-md-10">
                                    {!! Form::password('password2', ['class'=>'form-control', 'placeholder'=>'Inputkan Konfirmasi Password']) !!}
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
            $("#form-ganti-password").validate({
                rules: {
                    password: "required",
                    password2: {
                        required: true,
                        equalTo: password
                    }
                },
                messages: {
                    password: "Kolom password harus diisi",
                    password2: {
                        required: "Kolom Konfirmasi password harus diisi",
                        equalTo: "Konfirmasi password harus sama dengan password baru"
                    }
                }
            });
        });
          
    </script>
@endsection