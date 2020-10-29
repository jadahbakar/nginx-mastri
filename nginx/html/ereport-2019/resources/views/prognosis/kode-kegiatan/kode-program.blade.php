<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" style="white-space: nowrap;">
                <thead class="bg-primary white">
                    <tr style="text-align: center;">
                        <th width="30px">Pilih</th>
                        <th>Kode Program</th>
                        <th>Nama Program</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listKodeProgram as $item)
                        <tr>
                            <td>
                                <center>
                                    <a href="" class="btn btn-social-icon btn-primary btn-xs" id="buttonPilih" data-dismiss="modal" data-value="{!! $item['kdRekening'] !!}"><i class="ft-plus"></i></a>
                                </center>
                            </td>
                            <td>{{ $item['kdRekening'] }}</td>
                            <td>{{ $item['nmRekening'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-8 ml-auto">
         {{ $listKodeProgram->render() }}
    </div>
</div>
<!-- /.row