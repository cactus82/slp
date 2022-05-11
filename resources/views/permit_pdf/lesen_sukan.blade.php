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

<p class="center-align"><span class="times-roman">BORANG 2</span><br class="times-roman">
<span class="times-roman">(Peraturan 23(a))</span></p>
<p class="times-roman-center">NEGERI SABAH</p>
<p class="times-roman-center">ENAKMEN PEMELIHARAAN HIDUPAN LIAR 1997</p>
<p class="times-roman-center">LESEN SUKAN</span></p>
<p class="times-roman-center">(Tidak boleh dipindah milik)</p>
<p class="times-roman-center">Nombor Lesen &nbsp;<span class="underline">{{$no_permit}}</span></p>
<p>&nbsp;</p>
<p class="left-align">Nama Penuh &nbsp;<span class="underline">{{ $nama ?? '' }}</span></p>
<p class="left-align">No. Kad Pengenalan Pemegang Lesen &nbsp;<span class="underline">{{ $ic ?? '' }}</span></p>
<p class="left-align">Alamat Kediaman di negara menetap &nbsp;<span class="underline">{{ $alamat ?? '' }}</span></p>
<p class="left-align">Orang yang bernama seperti di atas dibenarkan untuk memburu dan membunuh haiwan daripada spesis
    yang dinyatakan di bawah dalam kawasan dan bilangan dinyatakan dibawah tertakluk kepada Enakmen di
    atas dan Peraturan-Peraturan dibuat di bawahnya dan syarat-syarat diendorskan atas lesen ini.</p>
<p class="left-align">&nbsp;</p>

<table align="center" style="width: 80%">
    <tr>
        <td><span class="underline">Spesis</span></td>
        <td><span class="underline">Kawasan</span></td>
        <td><span class="underline">Bilangan</span></td>
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
