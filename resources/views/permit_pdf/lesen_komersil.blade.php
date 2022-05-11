<!DOCTYPE html>
<html>
<head>
<title>Lesen Memburu Sukan</title>
<style type="text/css">
.center-align {
	text-align: center;
}
.left-align {
	text-align: left;
	font-family: "Times New Roman", Times, serif;
}
.right-align {
	text-align: right;
	font-family: "Times New Roman", Times, serif;
}
.times-roman {
	font-family: "Times New Roman", Times, serif;
}
.times-roman-center {
	text-align: center;
	font-family: "Times New Roman", Times, serif;
}
.underline {
	text-decoration: underline;
}
.strikethrough {
	text-decoration: line-through;
}
</style>
</head>

<body>

<p class="center-align"><span class="times-roman">BORANG 3</span><br class="times-roman">
<span class="times-roman">(Peraturan 23(b))</span></p>
<p class="times-roman-center">NEGERI SABAH
    <br>ENAKMEN PEMELIHARAAN HIDUPAN LIAR 1997
    <br>LESEN MEMBURU KOMERSIL</span>
    <br>(Tidak boleh dipindah milik)</p>
<p>&nbsp;</p>
<p class="left-align">Nombor Lesen: &nbsp;<span class="underline">{{$no_permit}}</span>
    <br>Nama penuh pemegang lesen: &nbsp;<span class="underline">{{ $nama ?? '' }}</span>
    <br>No. Kad Pengenalan Pemegang Lesen: &nbsp;<span class="underline">{{ $ic ?? '' }}</span>
    <br>Alamat: &nbsp;<span class="underline">{{ $alamat ?? '' }}</span>
    <br>Nombor pendaftaran kereta yang digunakan untuk memburu:
<span class="underline">&nbsp;{{ $nombor_kereta ?? '' }}&nbsp;</span></p>
<p class="left-align">Penama-penama bagi teman pemburu yang dibenarkan di bawah lesen ini</p>
<table align="center" style="width: 80%">
    <tr>
        <td>a.</td>
        <td>Nama: {{ $nama_teman1 ?? '' }}</td>
        <td>No. Kad Pengenalan: {{ $nokp_teman1 ?? '' }}</td>
    </tr>
    <tr>
        <td>b.</td>
        <td>Nama: {{ $nama_teman2 ?? '' }}</td>
        <td>No. Kad Pengenalan: {{ $nokp_teman2 ?? '' }}</td>
    </tr>
    <tr>
        <td>c.</td>
        <td>Nama: {{ $nama_teman3 ?? '' }}</td>
        <td>No. Kad Pengenalan: {{ $nokp_teman3 ?? '' }}</td>
    </tr>
    <tr>
        <td>d.</td>
        <td>Nama: {{ $nama_teman4 ?? '' }}</td>
        <td>No. Kad Pengenalan: {{ $nokp_teman4 ?? '' }}</td>
    </tr>
</table>
<p class="left-align">Penama-penama diatas adalah dibenarkan untuk memburu spesies binatang yang dinyatakan dibawah,
    dikawasan dan dengan bilangan yang dinyatakan dibawah, Tertakluk kepada Enakmen dan Peraturanperaturan diatas dan syarat-syarat yang dipersetujui dalam lesen ini
</p>
<table align="center" style="width: 90%">
    <tr>
        <td><span class="underline">Spesis</span></td>
        <td><span class="underline">Kawasan</span></td>
        <td><span class="underline">Bilangan (angka dan perkataan)</span></td>
    </tr>

    @foreach ($list as $v)
        <tr>
            <td>{{$v->spesis}}</td>
            <td>{{$v->kawasan}}</td>
            <td>{{$v->bilangan}}</td>
        </tr>
    @endforeach
</table>

<p class="left-align">&nbsp;</p>
<p class="left-align">Fee dibayar: RM{{$jumlah_rm ?? ''}}</p>
<p class="left-align">Tarikh Pengeluaran Lesen: {{$tarikh_resit ?? ''}}</p>
<p class="left-align">Permit ini adalah sah sehingga: {{$sah_sehingga ?? ''}}</p>
<p class="times-roman">&nbsp;</p>
<p class="times-roman">&nbsp;</p>
<p class="center-align">PERMIT INI TIDAK MEMERLUKAN TANDATANGAN</p>

</body>

</html>
