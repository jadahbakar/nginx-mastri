@extends('layout.admin')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">Konvert Kode Akun Prognosis</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="#">Prognosis</a></li>
                        <li class="breadcrumb-item active"><a href="#">Konvert Kode Akun Prognosis</a></li>
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
                                    <!-- /row -->
                                    <div class="row">
                                        @if(Auth::user()->view == 2)
                                            <div class="col-md-3">
                                                {!! Form::open(['id'=>'form-konvert-prognosis', 'method'=>'POST', 'url'=>'prognosis/konvert-akun-prognosis', 'class'=>'form form-horizontal']) !!}
                                                    <div class="input-group">
                                                        <input name="tahun" id="tahun" type="number" class="form-control" placeholder="Inputkan Tahun">
                                                        <span class="input-group-append">
                                                            <button class="btn btn-primary btn-glow" type="submit" id="buttonKonvertPrognosis"><i class="la la-chain"></i> Konvert</button>
                                                        </span>
                                                    </div>
                                                {!! Form::close() !!}  
                                            </div>
                                            <div class="col-md-3"></div>
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
                                        @elseif(Auth::user()->view == 1)
                                            <div class="col-md-7">
                                                {!! Form::open(['id'=>'form-konvert-prognosis', 'method'=>'POST', 'url'=>'prognosis/konvert-akun-prognosis', 'class'=>'form form-horizontal']) !!}
                                                    <div class="form-group row">
                                                        <div class="col-md-7">
                                                            {!! Form::select('kode_pengguna', $listPengguna, null, ['class'=>'select2 form-control']) !!}
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="input-group">
                                                                <input name="tahun" id="tahun" type="number" class="form-control" placeholder="Inputkan Tahun">
                                                                <span class="input-group-append">
                                                                    <button class="btn btn-primary btn-glow" type="submit" id="buttonKonvertPrognosis"><i class="la la-chain"></i> Konvert</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                     </div>
                                                {!! Form::close() !!}  
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-4">
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
                                        @endif
                                        
                                        <div class="col-md-12"> 
                                            <legend></legend>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover" style="white-space: nowrap;">
                                                    <thead class="bg-dark white">
                                                        <tr style="text-align: center;">
                                                            <th width="100px;">Status</th>
                                                            <th>Tahun</th>
                                                            <th>Pengguna</th>
                                                            <th>Kode Organisasi</th>
                                                            <th>Organisasi</th>
                                                            <th>Created At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($listProsesPrognosis as $item)
                                                            <tr>
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
                                             {{ $listProsesPrognosis->render() }}
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
        @if(Auth::user()->view == 3)
            socket.on("channel-name-{!! Auth::user()->kode_pengguna !!}:App\\Events\\Prognosis\\NotifikasiKonvertEvent", function(message){
                $("#status-"+message.idProsesPrognosis).html(message.labelHtml);
            });
        @elseif(Auth::user()->view == 2)
            socket.on("channel-name-{!! Auth::user()->organisasi !!}:App\\Events\\Prognosis\\NotifikasiKonvertEvent", function(message){
                $("#status-"+message.idProsesPrognosis).html(message.labelHtml);
            });
        @elseif(Auth::user()->view == 1)
            socket.on("channel-name-main-admin:App\\Events\\Prognosis\\NotifikasiKonvertEvent", function(message){
                $("#status-"+message.idProsesPrognosis).html(message.labelHtml);
            });
        @endif

        $(document).ready(function() {  
            $("#form-konvert-prognosis").validate({
                rules: {
                    tahun: "required"
                },
                messages: {
                    tahun: "Kolom tahun harus diisi"
                }
            });
            
            //Confirm Message
            $('#buttonKonvertPrognosis').on('click', function(e){
                var tahun = $('#tahun').val();
                if(tahun != ''){
                    e.preventDefault();
                    var $self = $(this);
                    swal({
                        title: "Konvert Kode AKun Prognosis ?",
                        text: "Mohon diteliti sebelum proses dimulai",
                        icon: "warning",
                        buttons: {
                            confirm: {
                                text: "Konvert",
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
                            $self.parents("#form-konvert-prognosis").submit();
                        }
                    });
                }
            });

        });
    </script>
@endsection