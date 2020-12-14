<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <!-- Bootstrap CSS -->
        <title>DRH - Riwayat</title>
        <style>
            body {
                font-size: 15px
            }

            .tw-100 {
                width: 100% !important;
                margin-left: 20px;
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
                border: 1px solid #000;
                line-height: 15px;
                text-align: center;
            }

            .h5-title {
                margin-bottom: 2px;
                font-size: 17px;
            }

            .h6-title {
                margin-top: 2px;
                margin-bottom: 2px;
                margin-left: 20px;
                font-size: 15px;
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

            .tb th {
                text-align: center;
                font-weight: normal;
            }

            .no {
                width: 4px;
                text-align: center;
            }

            .text-center {
                text-align: center;
            }

            .page-break {
                page-break-after: always;
            }
        </style>
    </head>
    <body>
        <h5 class="h5-title">II. PENDIDIKAN</h5>
        <h5 class="h6-title">1. Pendidikan di dalam dan luar negeri</h5>
        <table class="tw-100 tb">
            <tr>
                <th rowspan="2" class="no">No</th>
                <th rowspan="2">Tingkat</th>
                <th rowspan="2">Nama Sekolah / Perguruan Tinggi</th>
                <th rowspan="2">Akreditasi</th>
                <th rowspan="2">Tempat</th>
                <th colspan="3" class="text-center">STTB/IJAZAH</th>
                <th colspan="2" class="text-center">Gelar</th>
            </tr>
            <tr>
                <th>Nomor</th>
                <th>Tanggal</th>
                <th>Pejabat <br>Penandatangan</th>
                <th>Depan</th>
                <th>Belakang</th>
            </tr>
            @if ($pendidikan->count() == 0)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @else
            @php
                $no=1;
            @endphp
            @foreach ($pendidikan as $p)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $p->tingkat }}</td>
                    <td>{{ $p->nama_lembaga }}</td>
                    <td>{{ $p->akreditasi }}</td>
                    <td>{{ ucwords(strtolower($p->kabupaten->nama)) }}</td>
                    <td>{{ $p->ijazah_nomor }}</td>
                    <td>{{ tanggal($p->ijazah_tanggal) }}</td>
                    <td>{{ $p->ijazah_pejabat }}</td>
                    <td>{{ $p->gelar_depan }}</td>
                    <td>{{ $p->gelar_belakang }}</td>
                </tr>
            @endforeach
            @endif
        </table>
        <h5 class="h6-title" style="margin-top: 30px">2. Kursus/ Latihan di dalam luar negeri</h5>
        <table class="tw-100 tb">
            <tr>
                <th rowspan="2" class="no">No</th>
                <th rowspan="2">Nama Kursus / Pelatihan</th>
                <th colspan="2" class="text-center">Lamanya</th>
                <th rowspan="2">Nomor</th>
                <th rowspan="2">Tempat</th>
                <th rowspan="2">Institusi Penyelenggara</th>
            </tr>
            <tr>
                <th>Mulai</th>
                <th>Selesai</th>
            </tr>
            @if ($pelatihan->count() == 0)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @else

            @php
                $no=1;
            @endphp
            @foreach ($pelatihan as $p)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $p->nama_pelatihan }}</td>
                    <td>{{ tanggal($p->mulai) }}</td>
                    <td>{{ tanggal($p->selesai) }}</td>
                    <td>{{ $p->nomor }}</td>
                    <td>{{ $p->tempat}}</td>
                    <td>{{ $p->institusi_penyelenggara }}</td>
                </tr>
            @endforeach

            @endif
        </table>

        <div class="page-break"></div>

        <h5 class="h5-title">III. RIWAYAT PERKERJAAN</h5>
        <h5 class="h6-title">1. Riwayat Kepangkatan dan Golongan Ruang Penggajian</h5>
        <table class="tw-100 tb">
            <tr>
                <th rowspan="2" class="no">No</th>
                <th rowspan="2">Instansi / Perusahaan</th>
                <th colspan="2" class="text-center">Masa Kerja</th>
                <th rowspan="2">Gaji Pokok</th>
                <th colspan="3" class="text-center">Surat Keputusan</th>
            </tr>
            <tr>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Nomor</th>
                <th>Tanggal</th>
                <th>Pejabat Penandatangan</th>
            </tr>
            @if ($pekerjaan->count() == 0)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @else
            @php
                $no=1;
            @endphp
            @foreach ($pendidikan as $p)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $p->instansi }}</td>
                    <td>{{ $p->jabatan }}</td>
                    <td>{{ tanggal($p->mulai) }}</td>
                    <td>{{ tanggal($p->selesai) }}</td>
                    <td style="text-align: right;">{{ number_format($p->gaji_pokok) }}</td>
                    <td>{{ $p->sk_nomor }}</td>
                    <td>{{ tanggal($p->sk_tanggal) }}</td>
                    <td>{{ $p->sk_pejabat_penandatangan }}</td>
                </tr>
            @endforeach
            @endif
        </table>

        <div class="page-break"></div>

        <h5 class="h5-title">IV. TANDA JASA / PENGHARGAAN</h5>
        <table class="tw-100 tb">
            <tr>
                <th rowspan="2" class="no">No</th>
                <th rowspan="2">Nama Bintang / Lencana Penghargaan</th>
                <th colspan="2" class="text-center">Surat Keputusan</th>
                <th rowspan="2">Tahun Perolehan</th>
                <th rowspan="2">Nama Negara / Instansi yang memberikan</th>
            </tr>
            <tr>
                <th>Nomor</th>
                <th>Tanggal</th>
            </tr>
            @if ($penghargaan->count() == 0)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @else
            @php
                $no=1;
            @endphp
            @foreach ($penghargaan as $p)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->sk_nomor }}</td>
                    <td>{{ tanggal($p->sk_tanggal) }}</td>
                    <td class="text-center">{{ $p->tahun_perolehan }}</td>
                    <td>{{ $p->instansi_pemberi }}</td>
                </tr>
            @endforeach
            @endif
        </table>

        <h5 class="h5-title">V. RIWAYAT KELUARGA</h5>
        <h5 class="h6-title">1. Istri / Suami</h5>
        <table class="tw-100 tb">
            <tr>
                <th class="no">No</th>
                <th width="100px">NIK</th>
                <th width="100px">NIP <sup>**</sup></th>
                <th width="100px">Nama</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Pekerjaan / Posisi Jabatan</th>
                <th>Perusahaan / Institusi</th>
                <th>Status Perkawinan</th>
                <th>Akte Nikah / Akte Cerai</th>
                <th>Tanggal Menikah / Cerai Meninggal</th>
                <th>Status Hidup</th>
            </tr>
           
            @if ($pasangan->count() == 0)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @else
            @php
                $no=1;
            @endphp
            @foreach ($pasangan as $p)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $p->nik }}</td>
                    <td>{{ $p->nip }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->kabupaten->nama . ", " . tanggal($p->tanggal_lahir) }}</td>
                    <td>{{ $p->pekerjaan }}</td>
                    <td>{{ $p->pekerjaan_tempat }}</td>
                    <td>{{ $p->status_pernikahan }}</td>
                    <td>{{ $p->akte_nikah_nomor }}</td>
                    <td>{{ tanggal($p->akte_nikah_tanggal) }}</td>
                    <td>{{ $p->status_hidup }}</td>
                </tr>
            @endforeach
            @endif
        </table>

        <h5 class="h6-title" style="margin-top: 20px">2. Anak</h5>
        <table class="tw-100 tb">
            <tr>
                <th class="no">No</th>
                <th width="200px">NIK</th>
                <th width="200px">NIP <sup>**</sup></th>
                <th width="200px">Nama</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Pekerjaan / Posisi Jabatan</th>
                <th>Perusahaan / Institusi</th>
                <th>Status Hidup</th>
            </tr>
           
            @if ($anak->count() == 0)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @else
            @php
                $no=1;
            @endphp
            @foreach ($anak as $p)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $p->nik }}</td>
                    <td>{{ $p->nip }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->kabupaten->nama . ", " . tanggal($p->tanggal_lahir) }}</td>
                    <td>{{ $p->pekerjaan }}</td>
                    <td>{{ $p->pekerjaan_tempat }}</td>
                    <td>{{ $p->status_hidup }}</td>
                </tr>
            @endforeach
            @endif
        </table>

        <h5 class="h6-title" style="margin-top: 20px">3. Orang Tua Kandung</h5>
        <table class="tw-100 tb">
            <tr>
                <th class="no">No</th>
                <th width="200px">NIK</th>
                <th width="200px">NIP <sup>**</sup></th>
                <th width="200px">Nama</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Pekerjaan / Posisi Jabatan</th>
                <th>Perusahaan / Institusi</th>
                <th>Status Hidup</th>
            </tr>
           
            @if ($orangtua->count() == 0)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @else
            @php
                $no=1;
            @endphp
            @foreach ($orangtua as $p)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $p->nik }}</td>
                    <td>{{ $p->nip }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->kabupaten->nama . ", " . tanggal($p->tanggal_lahir) }}</td>
                    <td>{{ $p->pekerjaan }}</td>
                    <td>{{ $p->pekerjaan_tempat }}</td>
                    <td>{{ $p->status_hidup }}</td>
                </tr>
            @endforeach
            @endif
        </table>

        <div class="page-break"></div>

        <h5 class="h6-title" style="margin-top: 20px">4. Saudara</h5>
        <table class="tw-100 tb">
            <tr>
                <th class="no">No</th>
                <th width="200px">NIK</th>
                <th width="200px">NIP <sup>**</sup></th>
                <th width="200px">Nama</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Pekerjaan / Posisi Jabatan</th>
                <th>Perusahaan / Institusi</th>
                <th>Status Perkawinan</th>
                <th>Status Hidup</th>
            </tr>
           
            @if ($saudara->count() == 0)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @else
            @php
                $no=1;
            @endphp
            @foreach ($saudara as $p)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $p->nik }}</td>
                    <td>{{ $p->nip }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->kabupaten->nama . ", " . tanggal($p->tanggal_lahir) }}</td>
                    <td>{{ $p->pekerjaan }}</td>
                    <td>{{ $p->pekerjaan_tempat }}</td>
                    <td>{{ $p->status_perkawinan }}</td>
                    <td>{{ $p->status_hidup }}</td>
                </tr>
            @endforeach
            @endif
        </table>

        <h5 class="h6-title" style="margin-top: 20px">5. Bapak/Ibu</h5>
        <table class="tw-100 tb">
            <tr>
                <th class="no">No</th>
                <th width="200px">NIK</th>
                <th width="200px">NIP <sup>**</sup></th>
                <th width="200px">Nama</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Pekerjaan / Posisi Jabatan</th>
                <th>Perusahaan / Institusi</th>
                <th>Status Hidup</th>
            </tr>
           
            @if ($mertua->count() == 0)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @else
            @php
                $no=1;
            @endphp
            @foreach ($mertua as $p)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $p->nik }}</td>
                    <td>{{ $p->nip }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->kabupaten->nama . ", " . tanggal($p->tanggal_lahir) }}</td>
                    <td>{{ $p->pekerjaan }}</td>
                    <td>{{ $p->pekerjaan_tempat }}</td>
                    <td>{{ $p->status_hidup }}</td>
                </tr>
            @endforeach
            @endif
        </table>


        <h5 class="h5-title">VI. KETERANGAN ORGANISASI</h5>
        <table class="tw-100 tb">
            <tr>
                <th rowspan="2" class="no">No</th>
                <th rowspan="2">Nama Organisasi</th>
                <th rowspan="2">Jabatan Organisasi</th>
                <th colspan="2" class="text-center">Masa Kerja</th>
                <th rowspan="2">Tempat</th>
                <th rowspan="2">Pimpinan Organisasi</th>
            </tr>
            <tr>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
            </tr>
            @if ($organisasi->count() == 0)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @else
            @php
                $no=1;
            @endphp
            @foreach ($organisasi as $p)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->jabatan }}</td>
                    <td>{{ $p->mulai }}</td>
                    <td>{{ $p->selesai }}</td>
                    <td>{{ $p->tempat }}</td>
                    <td>{{ $p->pimpinan }}</td>
                </tr>
            @endforeach
            @endif
        </table>

        <div class="page-break"></div>

        <h5 class="h5-title">VII. KETERANGAN LAIN-LAIN</h5>
        <table class="tw-100 tb">
            <tr>
                <th rowspan="2" class="no">No</th>
                <th rowspan="2">Nama Keterangan</th>
                <th colspan="3" class="text-center">Surat Keterangan</th>
            </tr>
            <tr>
                <th>Nomor</th>
                <th>Tanggal</th>
                <th>Pejabat</th>
            </tr>
            @if ($lainnya->count() == 0)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @else
            @php
                $no=1;
            @endphp
            @foreach ($lainnya as $p)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>
                        @php
                            $nama = array(
                                'a. skck'       => 'Surat Keterangan Catatan Kepolisian', 
                                'b. sks_jasroh' => 'Surat Keterangan Sehat Jasmani dan Rohani', 
                                'c. skb_napza'  => 'Surat Keterangan Bebas NAPZA', 
                                'd. lainnya'    => 'Keterangan Lainnya', 
                            );
                        @endphp 
                        {{ $nama[$p->nama] }}
                    </td>
                    <td>{{ $p->nomor }}</td>
                    <td>{{ tanggal($p->tanggal) }}</td>
                    <td>{{ $p->pejabat }}</td>
                </tr>
            @endforeach
            @endif
        </table>
        <p>
            Demikian daftar riwayat hidup ini saya buat dengan sesungguhnya dan apabila di kemudian hari terdapat keterangan yang tidak benar saya bersedia dituntut di muka pengadilan serta bersedia menerima segala tindakan yang diambil oleh Instansi Pemerintah
        </p>
        <div class="text-center" style="margin-left: 700px; width: 240px">
            <p style="margin-bottom: 0px">{{ ucwords(strtolower($peserta->kecamatan->nama)) }}, &nbsp;&nbsp;&nbsp;&nbsp;{{ bulan() }}</p>
            <p style="margin-top: 0px">Yang membuat</p>
            <p style="text-align: left; margin: 5px 0px 5px 20px;"><small>Materi 6000</small></p>
            <p><strong>{{ $peserta['nama'] }}</strong></p>
        </div>
    </body>
</html>