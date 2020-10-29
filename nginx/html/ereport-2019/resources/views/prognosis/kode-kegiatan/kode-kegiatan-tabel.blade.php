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
                                        <a class="nav-link active" href="{{ url('prognosis/kode-kegiatan') }}"><i class="la la-table"></i> Lihat Data</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('prognosis/kode-kegiatan/create') }}"><i class="la la-list"></i> Tambah Data</a>
                                    </li>
                                </ul>
                                <div class="tab-content px-1 pt-1">
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a class="btn btn-primary btn-glow" href="{{ url('prognosis/kode-kegiatan/create') }}"><i class="ft-plus"></i> Tambah Data</a>
                                        </div>
                                        <div class="col-md-6">
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
                                                            <th width="30px">Pilih</th>
                                                            <th>Kode Program</th>
                                                            <th>Uraian Kode Program</th>
                                                            <th>Kode Kegiatan</th>
                                                            <th>Uraian Kode Kegiatan</th>
                                                            <th>Kode Kegiatan Full</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $no = 0;
                                                        @endphp
                                                        @foreach($listKodeKegiatan as $item)
                                                            @php
                                                                $no++;
                                                            @endphp
                                                            <tr>
                                                                <td style="padding: 10px;">
                                                                    <center>
                                                                        {!! Form::open(['method'=>'delete', 'url'=>'prognosis/kode-kegiatan/'.$item->id.$var['url']['all'], 'class'=> 'delete_form']) !!}
                                                                        {!! Form::hidden('nomor', $no, ['class'=>'form-control']) !!}
                                                                        <div class="btn-group btn-group-xs" role="group" aria-label="Basic example">
                                                                            <button type="submit" class="btn btn-social-icon btn-danger btn-xs"><i class="ft-trash-2"></i></button>
                                                                            <a href="{{ url('/prognosis/kode-kegiatan/'.$item->id.'/edit'.$var['url']['all'])}}" class="btn btn-social-icon btn-primary btn-xs"><i class="ft-edit"></i></a>
                                                                            <a href="{{ url('/prognosis/kode-kegiatan/'.$item->id.$var['url']['all'])}}" class="btn btn-social-icon btn-info btn-xs"><i class="ft-book"></i></a>
                                                                        </div>
                                                                        {!! Form::close() !!}
                                                                    </center>
                                                                </td>
                                                                <td>{{ $item['kode_program'] }}</td>
                                                                <td>{{ $item['uraian_program'] }}</td>
                                                                <td>{{ $item['kode_kegiatan'] }}</td>
                                                                <td>{{ $item['uraian_kegiatan'] }}</td>
                                                                <td>{{ $item['kode_kegiatan_full'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ml-auto">
                                             {{ $listKodeKegiatan->render() }}
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