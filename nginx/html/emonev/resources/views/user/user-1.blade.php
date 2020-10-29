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
                    <li class="nav-item"> <a class="nav-link active" href="{{ url('user') }}"><span class="hidden-sm-up"><b>Lihat Data</b></span> <span class="hidden-xs-down"><b>Lihat Data</b></span></a> </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('user/create') }}" ><span class="hidden-sm-up"><b>Tambah Data</b></span> <span class="hidden-xs-down"><b>Tambah Data</b></span></a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active">
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ url('/user/create') }}" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="col-md-6">
                                <form method="GET" action="">
                                    <div class="input-group">
                                        <input name="cari" type="text" class="form-control" placeholder="Inputkan Pencarian">
                                        <div class="input-group-btn">
                                            <button class="btn btn-info" type="submit">Cari</button>
                                        </div>
                                    </div>
                                </form>
                                <br />
                            </div>

                            <div class="col-md-12"> 
                                <legend></legend>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table color-table inverse-table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="100px" style="text-align: center;"><b>Aksi</b></th>
                                                <th style="text-align: center;"><b>NIP</b></th>
                                                <th style="text-align: center;"><b>Nama</b></th>
                                                <th style="text-align: center;"><b>Email</b></th>
                                                <th style="text-align: center;"><b>Username</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 0;
                                            @endphp
                                            @foreach($listUser as $item)
                                                @php
                                                    $no++;
                                                @endphp
                                                <tr>
                                                    <td class="text-center">
                                                        {!! Form::open(['method'=>'DELETE', 'route'=> ['user.destroy', $item->id.$var['url']['all']], 'class'=> 'delete_form']) !!}
                                                        {!! Form::hidden('nomor', $no, ['class'=>'form-control']) !!}
                                                        <div class="btn-group" style="width: 100px;">
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                                            <a href="{{ url('/user/'.$item->id.'/edit'.$var['url']['all'])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                            <a href="{{ url('/user/'.$item->id.$var['url']['all'])}}" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></a>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </td>
                                                    <td>{{ $item['nip'] }}</td>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td>{{ $item['email'] }}</td>
                                                    <td>{{ $item['username'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-10 offset-md-2" style="text-align: right;">
                                 {{ $listUser->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection