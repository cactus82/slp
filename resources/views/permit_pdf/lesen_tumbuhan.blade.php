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

<p class="center-align"><span class="times-roman">BORANG 16</span><br class="times-roman">
<span class="times-roman">(Peraturan 41(a))</span></p>
<p class="times-roman-center">NEGERI SABAH</p>
<p class="times-roman-center">ENAKMEN PEMELIHARAAN HIDUPAN LIAR 1997</p>
<p class="times-roman-center">LESEN PUNGUTAN TUMBUHAN PEMUNGUT</p>
<p class="times-roman-center">(Tidak boleh dipindah milik)</p>
<p>&nbsp;</p>
<p class="left-align">Nombor Lesen: &nbsp;<span class="underline">{{$no_permit}}</span>
<br>(Nama penuh & No. Kad Pengenalan)&nbsp;<span class="underline">{{$no_permit}}</span>
beralamat (alamat di Sabah) &nbsp;<span class="underline">{{ $alamat ?? '' }}</span>
tinggal di (alamat dalam negara tempat tinggal)&nbsp;<span class="underline">{{ $alamat_tempat_tinggal ?? '' }}</span>
&nbsp;adalah dibenarkan
untuk mencari dan menuai tumbuhan dari spesies yang dinyatakan dibawah dalam kawasan dan dalam
bilangan yang dinyatakan dibawah tertakluk kepada Enakmen diatas dan Peraturan-Peraturan yang dibuat
dibawahnya dan syarat-syarat yang diendorskan pada lesen ini</p>
<p class="left-align"></p>
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
<p class="left-align">Fee lesen: RM{{$jumlah_rm ?? ''}}</p>
<p class="left-align">Tarikh Pengeluaran Lesen: {{$tarikh_resit ?? ''}}</p>
<p class="left-align">Tarikh Tamat Tempoh: {{$sah_sehingga ?? ''}}</p>
<p class="times-roman">&nbsp;</p>
<p class="times-roman">&nbsp;</p>
<p class="center-align">PERMIT INI TIDAK MEMERLUKAN TANDATANGAN</p>

</body>

</html>
