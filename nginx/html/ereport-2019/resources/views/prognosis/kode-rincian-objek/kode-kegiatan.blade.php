<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" style="white-space: nowrap;">
                <thead class="bg-primary white">
                    <tr style="text-align: center;">
                        <th width="30px">Pilih</th>
                        <th>Kode Kegiatan</th>
                        <th>Uraian Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listKodeKegiatanPrognosis as $item)
                        <tr>
                            <td>
                                <center>
                                    <a href="" class="btn btn-social-icon btn-primary btn-xs" id="buttonPilihKodeKegiatan" data-dismiss="modal" data-value="{!! $item['id'] !!}"><i class="ft-plus"></i></a>
                                </center>
                            </td>
                            <td>{{ $item['kode_kegiatan_full'] }}</td>
                            <td>{{ $item['uraian_kegiatan'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-8 ml-auto" id="pagination-kode-kegiatan">
         {{ $listKodeKegiatanPrognosis->render() }}
    </div>
</div>
<!-- /.row