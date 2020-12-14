<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        td {
            padding-top: 3px;
        }
    </style>
    <title>Surat Pernyataan</title>
  </head>
  <body>
    <h5 class="text-center">SURAT PERNYATAAN</h5>
    <p class="text-justify">Yang bertanda tangan di bawah ini</p>
    <table class="w-100 text-justify">
        <tr>
            <td style="width: 30px" class="text-nowrap pr-2">Nama</td>
            <td width="5px">:</td>
            <td>{{ $peserta['nama'] }}</td>
        </tr>
        <tr>
            <td style="width: 30px" class="text-nowrap pr-2">Tempat dan Tanggal Lahir</td>
            <td width="5px">:</td>
            <td>{{ $peserta['ttl'] }}</td>
        </tr>
        <tr>
            <td style="width: 30px" class="text-nowrap pr-2">Agama</td>
            <td width="5px">:</td>
            <td>{{ $peserta['agama'] }}</td>
        </tr>
        <tr>
            <td style="width: 30px" class="text-nowrap">Alamat</td>
            <td width="5px">:</td>
            <td>{{ $peserta['jalan'] }}</td>
        </tr>
    </table>
    <p class="text-justify" style="margin-top: 1rem">Dengan ini menyatakan dengan sesungguhnya, bahwa saya :</p>
    <ol class="text-justify">
        <li class="mb-2">Tidak pernah dipidana dengan pidana penjara berdasarkan putusan pengadilan yang sudah mempunyai kekuatan hukum tetap karena melakukan tindak pidana dengan pidana penjara 2 (dua) tahun atau lebih;</li>
        <li class="mb-2">Tidak pernah diberhentikan dengan hormat tidak atas permintaan sendiri atau tidak dengan hormat sebagai Calon PNS atau PNS, prajurit Tentara Nasional Indonesia, anggota Kepolisian Negara Republik Indonesia, atau diberhentikan tidak dengan hormat sebagai pegawai swasta (termasuk pegawai Badan Usaha Milik Negara atau Badan Usaha Milik Daerah);</li>
        <li class="mb-2">Tidak berkedudukan sebagai calon PNS, PNS, prajurit Tentara Nasional Indonesia, atau anggota Kepolisian Negara Republik Indonesia;</li>
        <li class="mb-2">Tidak menjadi anggota atau pengurus partai politik atau terlibat politik praktis;</li>
        <li class="mb-2">Bersedia ditempatkan di seluruh wilayah Negara Kesatuan Republik Indonesia atau negara lain yang ditentukan oleh Instansi Pemerintah.</li>
    </ol>
    <p class="text-justify mb-5">Demikian pernyataan ini saya buat dengan sesungguhnya, dan saya bersedia dituntut dimuka pengadilan serta bersedia menerima segala tindakan yang diambil oleh Pemerintah, apabila dikemudian hari terbukti pernyataan saya ini tidak benar.</p>
    <div class="col-sm-5 offset-sm-7 text-center">
        <p class="mb-0">{{ ucwords($peserta['kecamatan']) }}, &nbsp;&nbsp;&nbsp;&nbsp;{{ bulan() }}</p>
        <p class="mb-4">Yang membuat pernyataan</p>
        <p class="text-left pl-3"><small>Materi 6000</small></p>
        <p class="mt-4">{{ $peserta['nama'] }}</p>
    </div>
  </body>
</html>