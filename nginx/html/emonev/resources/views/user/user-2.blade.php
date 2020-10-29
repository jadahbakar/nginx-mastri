@extends('layouts.admin')

@section('konten')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">User</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Beranda</a></li>
            <li class="breadcrumb-item active">User</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('user') }}"><span class="hidden-sm-up"><b>Lihat Data</b></span> <span class="hidden-xs-down"><b>Lihat Data</b></span></a> </li>
                    <li class="nav-item"> <a class="nav-link active" href="{{ url('user/create') }}" ><span class="hidden-sm-up"><b>Tambah Data</b></span> <span class="hidden-xs-down"><b>Tambah Data</b></span></a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active">
                        <br />
                        @if($var['method']=='edit')
                            {!! Form::model($listUser, ['method'=>'PATCH', 'route'=> ['user.update', $listUser->id.$var['url']['all']], 'id'=>'form-user', 'class'=>'form-horizontal']) !!}
                        @elseif($var['method']=='create')
                            {!! Form::open(['id'=>'form-user', 'method'=>'POST', 'route'=>'user.store', 'class'=>'form-horizontal']) !!}
                        @else
                            {!! Form::model($listUser, ['class'=>'form-horizontal']) !!}
                        @endif
                            <div class="form-group row">
                                {!! Form::label('nip', 'NIP', ['class' => 'control-label text-right col-md-2']) !!}
                                <div class="col-md-10">
                                    {!! Form::text('nip', null, ['class'=>'form-control', 'placeholder'=>'Inputkan NIP']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('name', 'Nama', ['class' => 'control-label text-right col-md-2']) !!}
                                <div class="col-md-10">
                                    {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Nama']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('email', 'Email', ['class' => 'control-label text-right col-md-2']) !!}
                                <div class="col-md-10">
                                    {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Email']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('username', 'Username', ['class' => 'control-label text-right col-md-2']) !!}
                                <div class="col-md-10">
                                    {!! Form::text('username', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Username']) !!}
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="col-md-10 offset-md-2" style="text-align: right;">
                                    @if($var['method']=='edit')
                                        {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
                                        {!! Form::reset('Reset', ['class'=>'btn btn-danger']) !!}
                                    @elseif($var['method']=='create')
                                        {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
                                        {!! Form::reset('Reset', ['class'=>'btn btn-danger']) !!}
                                    @else
                                        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
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
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {  
            @if($var['method']=='edit' || $var['method']=='show')
                var pk = '{{ $listUser->id  }}';
            @else
                var pk = null;
            @endif

            $("#form-user").validate({
                rules: {
                    nip: {
                        required: true,
                        remote: {
                            url: "{{ url('user/cek-validasi') }}",
                            type: "post",
                            data: {
                                'kolom': 'nip',
                                'aksi': '{{ $var['method'] }}',
                                'pk' : pk
                            }
                        }
                    },
                    name: "required",
                    email: {
                        email: true,
                        remote: {
                            url: "{{ url('user/cek-validasi') }}",
                            type: "post",
                            data: {
                                'kolom': 'email',
                                'aksi': '{{ $var['method'] }}',
                                'pk' : pk
                            }
                        }
                    },
                    username: {
                        required: true,
                        remote: {
                            url: "{{ url('user/cek-validasi') }}",
                            type: "post",
                            data: {
                                'kolom': 'username',
                                'aksi': '{{ $var['method'] }}',
                                'pk' : pk
                            }
                        }
                    }
                },
                messages: {
                    nip: {
                        required: "Kolom NIP harus diisi",
                        remote: "NIP sudah digunakan"
                    },
                    name: "Kolom nama harus diisi",
                    email: {
                        email: "Data harus sesuai dengan format email",
                        remote: "Email sudah digunakan"
                    },
                    username: {
                        required: "Kolom username harus diisi",
                        remote: "Username sudah digunakan"
                    }
                }
            });
        });
    </script>
@endsection