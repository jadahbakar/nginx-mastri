@extends('layouts.admin')

@section('konten')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Data SPJ</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Beranda</a></li>
            <li class="breadcrumb-item active">Data SPJ</li>
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
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::open(['id'=>'form-spj', 'method'=>'POST', 'route'=>'data-spj.store', 'class'=>'form-horizontal']) !!}
                                    <div class="input-group">
                                        <input name="tahun" type="text" class="form-control" placeholder="Inputkan Tahun">
                                        <div class="input-group-btn">
                                            <button class="btn btn-info" type="submit">Tarik Data</button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}  
                            </div>
                            <div class="col-md-3"><p></p></div>
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
                                    <table class="table color-table inverse-table table-hover" style="width: 2600px;">
                                        <thead>
                                            <tr>
                                                {{-- <th width="100px" style="text-align: center;"><b>Aksi</b></th> --}}
                                                <th style="text-align: center;"><b>Tahun Anggaran</b></th>
                                                <th style="text-align: center;"><b>Tgl SPJ</b></th>
                                                <th style="text-align: center;"><b>Jenis Transaksi</b></th>
                                                <th style="text-align: center;"><b>Jenis SPJ</b></th>
                                                <th style="text-align: center;"><b>Kode Urusan</b></th>
                                                <th style="text-align: center;"><b>Kode OPD</b></th>
                                                <th style="text-align: center;"><b>Kode Program</b></th>
                                                <th style="text-align: center;"><b>Kode Kegiatan</b></th>
                                                <th style="text-align: center;"><b>Kode Akun</b></th>
                                                <th style="text-align: center;"><b>Kode Kelompok</b></th>
                                                <th style="text-align: center;"><b>Kode Jenis</b></th>
                                                <th style="text-align: center;"><b>Kode Objek</b></th>
                                                <th style="text-align: center;"><b>Kode Rincian</b></th>
                                                <th style="text-align: center;"><b>Kode Rekening</b></th>
                                                <th style="text-align: center;"><b>Debet</b></th>
                                                <th style="text-align: center;"><b>Kredit</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 0;
                                            @endphp
                                            @foreach($listSpj as $item)
                                                @php
                                                    $no++;
                                                @endphp
                                                <tr>
                                                    {{-- <td class="text-center">
                                                        {!! Form::open(['method'=>'DELETE', 'route'=> ['user.destroy', $item->id.$var['url']['all']], 'class'=> 'delete_form']) !!}
                                                        {!! Form::hidden('nomor', $no, ['class'=>'form-control']) !!}
                                                        <div class="btn-group" style="width: 100px;">
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                                            <a href="{{ url('/user/'.$item->id.'/edit'.$var['url']['all'])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                            <a href="{{ url('/user/'.$item->id.$var['url']['all'])}}" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></a>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </td> --}}
                                                    <td style="text-align: center;">{{ $item['tahun_anggaran'] }}</td>
                                                    <td style="text-align: center;">{{ $item['tanggal_spj'] }}</td>
                                                    <td>{{ jenisTransaksi($item['jenis_transaksi']) }}</td>
                                                    <td style="text-align: center;">{{ jenis2($item['jenis_spj']) }}</td>
                                                    <td style="text-align: center;">{{ $item['kode_urusan'] }}</td>
                                                    <td style="text-align: center;">{{ $item['kode_opd'] }}</td>
                                                    <td style="text-align: center;">{{ $item['kode_program'] }}</td>
                                                    <td style="text-align: center;">{{ $item['kode_kegiatan'] }}</td>
                                                    <td style="text-align: center;">{{ $item['kode_akun'] }}</td>
                                                    <td style="text-align: center;">{{ $item['kode_kelompok'] }}</td>
                                                    <td style="text-align: center;">{{ $item['kode_jenis'] }}</td>
                                                    <td style="text-align: center;">{{ $item['kode_objek'] }}</td>
                                                    <td style="text-align: center;">{{ $item['kode_rincian'] }}</td>
                                                    <td>{{ $item['kode_rekening'] }}</td>
                                                    <td style="text-align: right;">{{ $item['debet'] }}</td>
                                                    <td style="text-align: right;">{{ $item['kredit'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-10 offset-md-2" style="text-align: right;">
                                 {{ $listSpj->render() }}
                            </div>
                        </div>
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
            $("#form-spj").validate({
                rules: {
                    tahun: "required",
                },
                messages: {
                    tahun: "Kolom tahun harus diisi",
                }
            });
        });
    </script>
@endsection