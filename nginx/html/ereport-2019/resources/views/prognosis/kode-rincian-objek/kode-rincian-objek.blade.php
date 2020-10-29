<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" style="white-space: nowrap;">
                <thead class="bg-primary white">
                    <tr style="text-align: center;">
                        <th width="30px">Pilih</th>
                        <th>Kode Rincian Objek</th>
                        <th>Uraian Rincian Objek</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listKodeRincianObjek as $item)
                        <tr>
                            <td>
                                <center>
                                    <a href="" class="btn btn-social-icon btn-primary btn-xs" id="buttonPilihKodeRincianObjek" data-dismiss="modal" data-value="{!! $item['id'] !!}"><i class="ft-plus"></i></a>
                                </center>
                            </td>
                            <td>{{ $item['akun_bas'] }}</td>
                            <td>{{ $item['nama_akun'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-8 ml-auto" id="pagination-kode-rincian-objek">
         {{ $listKodeRincianObjek->render() }}
    </div>
</div>
<!-- /.row