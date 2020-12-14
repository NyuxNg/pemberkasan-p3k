<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <!-- Bootstrap CSS -->
        <title>DRH - Perorangan</title>
        <style>
            .tw-100 {
                width: 100% !important;
            }

            .title {
                padding-top: 100px;
                margin-bottom: 0px;
                text-align: center;
                font-size: 22px;
            }

            .foto {
                width: 94px;
                height: 120px;
                /*border: 1px solid #000;*/
                line-height: 15px;
                text-align: center;
            }

            .h5-title {
                margin-bottom: 2px;
            }

            .tb{
                border: 1px solid #000;
                border-collapse: collapse;
                width: 100%;
            }

            .tb td, .tb th {
              border: 1px solid #000;
              padding: 3px;
            }

            .no {
                width: 4px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <table class="tw-100">
            <tr>
                <td>
                    <h3 class="title">DAFTAR RIWAYAT HIDUP</h3>
                </td>
                <td width="120px">
                    <div class="foto">
                        @if ($berkas->file))
                            <img width="94px" height="120px" src="{{ asset('public/upload/berkas') . "/" . $berkas->no_peserta . "/" . $berkas->file }}" alt="">
                        @endif
                    </div>
                </td>
            </tr>
        </table>
        <h5 class="h5-title">I. KETERANGAN PERORANGAN</h5>
        <table class="tw-100 tb">
            <tr>
                <td class="no">1</td>
                <td colspan="2" width="235px">Nomor Induk Kependudukan (NIK)</td>
                <td>{{ $peserta->nik }}</td>
            </tr>
            <tr>
                <td rowspan="3" class="no">2</td>
                <td rowspan="3" colspan="2" width="235px">Nama</td>
                <td>{{ strtoupper($peserta->nama) }}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>*)</td>
            </tr>
            <tr>
                <td rowspan="3" class="no">3</td>
                <td rowspan="3" colspan="2" width="235px">Kabupaten/Kota Tempat Lahir</td>
                <td>{{ strtoupper($peserta->tempat_lahir->nama) }}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>*)</td>
            </tr>
            <tr>
                <td rowspan="3" class="no">4</td>
                <td rowspan="3" colspan="2" width="235px">Tanggal Lahir</td>
                <td>{{ strtoupper(tanggal($peserta->tanggal_lahir)) }}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>*)</td>
            </tr>
            <tr>
                <td class="no">5</td>
                <td colspan="2" width="235px">Jenis Kelamin</td>
                <td>{{ ($peserta->jk == "P") ? "Perempuan" : "Laki-laki" }}</td>
            </tr>
            <tr>
                <td class="no">6</td>
                <td colspan="2" width="235px">Agama/Aliran Kepercayaan</td>
                <td>{{ $peserta->agama }}</td>
            </tr>
            <tr>
                <td class="no">7</td>
                <td colspan="2" width="235px">Status Perkawinan</td>
                <td>{{ $peserta->status_perkawinan }}</td>
            </tr>
            <tr>
                <td class="no">8</td>
                <td colspan="2" width="235px">E-Mail</td>
                <td>{{ $peserta->email }}</td>
            </tr>
            <tr>
                <td class="no">9</td>
                <td colspan="2" width="235px">Nomor Telepon / Handphone</td>
                <td>{{ $peserta->no_hp }}</td>
            </tr>
            <tr>
                <td rowspan="5" class="no">10</td>
                <td rowspan="5" width="100px">Alamat</td>
                <td width="135px">a. Jalan</td>
                <td>{{ $peserta->jalan }}</td>
            </tr>
            <tr>
                <td width="135px">b. Kelurahan/Desa</td>
                <td>{{ ucwords(strtolower($peserta->desa->nama)) }}</td>
            </tr>
            <tr>
                <td width="135px">c. Kecamatan</td>
                <td>{{ ucwords(strtolower($peserta->kecamatan->nama)) }}</td>
            </tr>
            <tr>
                <td width="135px">d. Kabupaten/Kota</td>
                <td>{{ ucwords(strtolower($peserta->kabupaten->nama)) }}</td>
            </tr>
            <tr>
                <td width="135px">e. Provinsi</td>
                <td>{{ ucwords(strtolower($peserta->provinsi->nama)) }}</td>
            </tr>
            <tr>
                <td rowspan="7" class="no">11</td>
                <td rowspan="7" width="100px">Keterangan Badan</td>
                <td width="135px">a. Tinggi (cm)</td>
                <td>{{ ucwords(strtolower($peserta->tinggi_badan)) }}</td>
            </tr>
            <tr>
                <td width="135px">b. Berat Badan (kg)</td>
                <td>{{ ucwords(strtolower($peserta->berat_badan)) }}</td>
            </tr>
            <tr>
                <td width="135px">c. Rambut</td>
                <td>{{ ucwords(strtolower($peserta->rambut)) }}</td>
            </tr>
            <tr>
                <td width="135px">d. Bentuk Muka</td>
                <td>{{ ucwords(strtolower($peserta->bentuk_muka)) }}</td>
            </tr>
            <tr>
                <td width="135px">e. Warna Kulit</td>
                <td>{{ ucwords(strtolower($peserta->warna_kulit)) }}</td>
            </tr>
            <tr>
                <td width="135px">f. Ciri Khas</td>
                <td>{{ ucwords(strtolower($peserta->ciri_khas)) }}</td>
            </tr>
            <tr>
                <td width="135px">g. Cacat Tubuh</td>
                <td>{{ ucwords(strtolower($peserta->cacat_tubuh)) }}</td>
            </tr>
            <tr>
                <td class="no">12</td>
                <td colspan="2" width="235px">Kegemaran (Hobby)</td>
                <td>{{ ucwords(strtolower($peserta->kegemaran)) }}</td>
            </tr>
        </table>
        <p>*) Ditulis dengan huruf Kapital/Balok dan tinta hitam</p>
    </body>
</html>