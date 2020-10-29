<hr />
<br />

@if($listData->count() > 0)
    <!-- /row -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="white-space: nowrap;">
                    <thead class="bg-dark white">
                        <tr style="text-align: center;">
                            <th width="75px">Nomor</th>
                            <th width="225px">Kode Rekening</th>
                            <th>Uraian Kode Rekening</th>
                            <th width="175px">Debet</th>
                            <th width="175px">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listData as $item)
                            @php
                                $namaAkunDebet = $helper->namaAkunBas($item['akun_debet'], $item['jenis_jurnal']);
                                $namaAkunKredit = $helper->namaAkunBas($item['akun_kredit'], $item['jenis_jurnal']);
                            @endphp
                            <tr>
                                <td>{{ sprintf("%03s",$item['no_urut']) }}</td>
                                <td>{{ $item['akun_debet'] }}</td>
                                <td>{{ $namaAkunDebet }}</td>
                                <td>Rp {{ mataUang($item['jumlah']) }}</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $item['akun_kredit'] }}</td>
                                <td>{{ $namaAkunKredit }}</td>
                                <td>&nbsp;</td>
                                <td>Rp {{ mataUang($item['jumlah']) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.row -->
@else
    <!-- /row -->
    <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="white-space: nowrap;">
                        <thead class="bg-dark white">
                            <tr style="text-align: center;">
                                <th width="75px">Nomor</th>
                                <th width="225px">Kode Rekening</th>
                                <th>Uraian Kode Rekening</th>
                                <th width="175px">Debet</th>
                                <th width="175px">Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" style="text-align:center;"><h2><b>Data Kosong</b></h2></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
@endif
