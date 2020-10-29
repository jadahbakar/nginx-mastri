@extends('layout.admin')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">Posting</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="#">Entry Data</a></li>
                        <li class="breadcrumb-item"><a href="#">SKPD</a></li>
                        <li class="breadcrumb-item"><a href="#">Akuntansi</a></li>
                        <li class="breadcrumb-item active"><a href="#">Posting</a></li>
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

                                   {!! Form::open(['id'=>'form-posting', 'method'=>'GET', 'url'=>'entry-data/skpd/akuntansi/posting', 'class'=>'form form-horizontal']) !!}
                                        <div class="form-body">
                                            <div class="form-group row">
                                                {!! Form::label('no_trans', 'Nomor Transaksi', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-4">
                                                    {!! Form::text('no_trans', Request::get('no_trans'), ['class'=>'form-control', 'placeholder'=>'Inputkan Nomor Transaksi']) !!}
                                                </div>

                                                {!! Form::label('jenis_transaksi', 'Jenis Transaksi', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-4">
                                                    {!! Form::select('jenis_transaksi', $var['jenis_transaksi'], Request::get('jenis_transaksi'), ['class'=>'form-control', 'placeholder'=>'Inputkan Jenis Transaksi']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group row">
                                                {!! Form::label('bulan', 'Bulan', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-4">
                                                    {!! Form::select('bulan', $var['bulan'], Request::get('bulan'), ['class'=>'form-control', 'placeholder'=>'Pilih Bulan']) !!}
                                                </div>

                                                {!! Form::label('tahun', 'Tahun', ['class' => 'col-md-2 label-control']) !!}
                                                <div class="col-md-4">
                                                    {!! Form::number('tahun', Request::get('tahun'), ['class'=>'form-control', 'placeholder'=>'Inputkan Tahun']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-body">
                                            <div class="col-md-4 ml-auto">
                                               <button type="submit" class="btn btn-primary"><i class="ft-search"></i> Tampil</button>
                                               <button type="reset" class="btn btn-danger"><i class="ft-refresh-cw"></i> Reset</button>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}

                                    <hr />
                                    <br />
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <legend></legend>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover" style="white-space: nowrap;">
                                                    <thead class="bg-dark white">
                                                        <tr style="text-align: center;">
                                                            <th width="50px;">
                                                                <div class="icheck1">
                                                                    <fieldset>
                                                                        <input type="checkbox" id="checkBoxHeader" class="checkBoxHeader">
                                                                    </fieldset>
                                                                </div>
                                                            </th>
                                                            <th>No. Transaksi</th>
                                                            <th>Tgl Transaksi</th>
                                                            <th>Jenis Transaksi</th>
                                                            <th>Kode Rekening</th>
                                                            <th>Jumlah</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $nomor=0;
                                                            $disabledChecked = "disabled checked ";
                                                            $jumDisabled = 0;
                                                        @endphp
                                                        @foreach($listTransaksiSemua as $item)
                                                            @php
                                                                $jumJurnal = $helper->cekJurnal($item['no_trans']);
                                                                if($jumJurnal != 0) $disabledChecked++;
                                                            @endphp
                                                            <tr itemid="{!! $item['no_trans'] !!}" item-value="checkBoxData{!! $nomor !!}">
                                                                <td>
                                                                    <div class="icheck1">
                                                                        <fieldset>
                                                                            <input type="checkbox" class="checkBoxData" id="checkBoxData{!! $nomor !!}" value="{!! $item['no_trans'] !!}"
                                                                             onChange="simpanData('{!! $item['no_trans'] !!}', '{!! $nomor !!}')" @if($jumJurnal != 0) {!! $disabledChecked !!} @endif>
                                                                        </fieldset>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $item['no_trans'] }}</td>
                                                                <td style="text-align: center;">{{ \Carbon\Carbon::parse($item['tanggal_transaksi'])->format('d-m-Y') }}</td>
                                                                <td>{{ jenisTransaksi($item['jenis_transaksi']) }}</td>
                                                                <td>{{ $item['kode_rekening'] }}</td>
                                                                <td style="text-align: right;">{{ mataUang($item['jumlah']) }}</td>
                                                            </tr>
                                                            @php $nomor++; @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 style="padding-top:15px; font-weight: bold;">{!! $var['jumlahTerposting'] !!} dari {!! $listTransaksiSemua->total() !!} data sudah terposting</h4>
                                        </div>
                                        <div class="col-md-6">
                                             {{ $listTransaksiSemua->render() }}
                                        </div>
                                    </div>
                                    <!-- /.row -->

                                    <div id="areaJurnal"></div>
                                    <br>
                                    {!! Form::open(['id'=>'form-posting-data', 'method'=>'POST', 'url'=>'entry-data/skpd/akuntansi/posting', 'class'=>'form form-horizontal']) !!}
                                        <div class="form-body">
                                            <div class="col-md-2 ml-auto">
                                                <button type="submit" class="btn btn-primary btn-block" id="buttonPosting"><i class="ft-cpu"></i> Posting</button>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}

                                    <hr />
                                    <br />
                                    <div class="col-md-12">
                                        <legend></legend>
                                    </div>
                                    <div class="col-md-12">
                                        <h3><b>10 Posting Terakhir</b></h3>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" style="white-space: nowrap;">
                                                <thead class="bg-dark white">
                                                    <tr style="text-align: center;">
                                                        <th width="100px;">Status</th>
                                                        <th>Pengguna</th>
                                                        <th>Kode Organisasi</th>
                                                        <th>Organisasi</th>
                                                        <th>Created At</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($listProsesPosting as $item)
                                                        <tr>
                                                            <td>
                                                                <center>
                                                                    <div id="status-{!! $item['id'] !!}">{!! statusProses($item['status']) !!}</div>
                                                                </center>
                                                            </td>
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
        @if(Auth::user()->view == 3)
            socket.on("channel-name-{!! Auth::user()->kode_pengguna !!}:App\\Events\\Akuntansi\\NotifikasiPostingEvent", function(message){
                $("#status-"+message.idProsesPosting).html(message.labelHtml);
            });
        @elseif(Auth::user()->view == 2)
            socket.on("channel-name-{!! Auth::user()->organisasi !!}:App\\Events\\Akuntansi\\NotifikasiPostingEvent", function(message){
                $("#status-"+message.idProsesPosting).html(message.labelHtml);
            });
        @elseif(Auth::user()->view == 1)
            socket.on("channel-name-main-admin:App\\Events\\Akuntansi\\NotifikasiPostingEvent", function(message){
                $("#status-"+message.idProsesPosting).html(message.labelHtml);
            });
        @endif

        $("#areaJurnal").load("{{ url('entry-data/skpd/akuntansi/posting/jurnal') }}");
        $("#checkBoxHeader").on('ifClicked', function(){
            var currentUser = "{!! Auth::user()->kode_pengguna !!}";
            var user = ($("#kode_pengguna").val()=="" || $("#kode_pengguna").val()==undefined?currentUser:$("#kode_pengguna").val());
            var checked = $("#checkBoxHeader").is(":checked");
            var i, noTrans, jumlah=10;

            if(!checked){
                for(i=0;i<jumlah;i++){
                    $("#checkBoxData"+i).iCheck('check');
                    noTrans = $("#checkBoxData"+i).val();
                    simpanData(noTrans, user, "save");
                }
            }else{
                for(i=0;i<jumlah;i++){
                    $("#checkBoxData"+i).iCheck('uncheck');
                    noTrans = $("#checkBoxData"+i).val();
                    simpanData(noTrans, user, "delete");
                }
            }
        });

        $("table input.checkBoxData").on('ifClicked', function(){
            var currentUser = "{!! Auth::user()->kode_pengguna !!}";
            var user = ($("#kode_pengguna").val()=="" || $("#kode_pengguna").val()==undefined?currentUser:$("#kode_pengguna").val());
            var noTrans = $(this).val();
            var checked = $(this).is(":checked");

            if(!checked){
                simpanData(noTrans, user, "save");
            }else{
                simpanData(noTrans, user, "delete");
            }
        });

        $(document).ready(function () {
            $('.table tr').click(function (event) {
                $(this).iCheck('toggle');
                var itemId = $(this).attr('itemid');
                var currentUser = "{!! Auth::user()->kode_pengguna !!}";
                var user = ($("#kode_pengguna").val()=="" || $("#kode_pengguna").val()==undefined?currentUser:$("#kode_pengguna").val());
                var noTrans = $(this).attr('itemid');
                var idCheckbox = $(this).attr('item-value');
                var checked = $("#"+idCheckbox).is(":checked");;

                if(checked){
                    simpanData(noTrans, user, "save");
                }else{
                    simpanData(noTrans, user, "delete");
                }

            });
        });

        $('#buttonPosting').on('click', function(e){
	        e.preventDefault();
	        var $self = $(this);
	        swal({
			    title: "Data yakin diposting ?",
			    text: "Mohon diteliti sebelum memposting data",
			    icon: "warning",
			    buttons: {
			    	confirm: {
	                    text: "Posting",
	                    value: true,
	                    visible: true,
	                    className: "btn-primary",
	                    closeModal: true
	                },
	                cancel: {
	                    text: "Batal",
	                    value: null,
	                    visible: true,
	                    className: "btn-secondary",
	                    closeModal: true,
	                }
			    }
			}).then(isConfirm => {
			    if (isConfirm) {
			        $("#form-posting-data").submit();
			    }
			});
        });

        function simpanData(noTrans, user, aksi){
            var data = "noTrans="+noTrans+"&user="+user+"&aksi="+aksi;
            $.ajax({
                method: 'post',
                url : "{!! url('/entry-data/skpd/akuntansi/posting/jurnal') !!}",
                data : data,
                success:function(msg){
                    $("#areaJurnal").html(msg);
                }
            });
        }

    </script>
@endsection
