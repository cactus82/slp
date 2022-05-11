<!DOCTYPE html>
<html>
<head>
<title>Permit Peniaga Haiwan</title>
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

<p class="center-align"><span class="times-roman">BORANG 12</span><br class="times-roman">
<span class="times-roman">(Peraturan 35(2))</span></p>
<p class="times-roman-center">NEGERI SABAH</p>
<p class="times-roman-center">ENAKMEN PERLINDUNGAN HIDUPAN LIAR 1997</p>
<p class="times-roman-center">PERMIT PENIAGA HAIWAN</p>
<p class="times-roman-center">(Tidak boleh dipindah milik)</p>
<p>&nbsp;</p>
<p class="times-roman-center">Nombor Permit <span class="underline">{{$no_permit}}</span></p>
<p>&nbsp;</p>
<p class="left-align">(Nama) <span class="underline">&nbsp;{{$nama ?? ''}}</span>
    di (alamat) <span class="underline">&nbsp;{{$alamat_pemohon ?? ''}})&nbsp;</span>
    dengan ini dibenarkan untuk menjalankan perniagaan di (alamat perniagaan)
    <span class="underline">&nbsp;{{$alamat_premis ?? ''}}&nbsp;</span> bagi haiwan dan hasil haiwan
    di bawah:
    </p>
    <p class="left-align">&nbsp;</p>

    <p class="center-align">SYARAT-SYARAT</p>

<p class="left-align">&nbsp;</p>
<p class="left-align">Permit ini adalah sah sehingga 31 December pada tahun ia dikeluarkan.</p>
<p class="times-roman">&nbsp;</p>
<p class="times-roman">&nbsp;</p>
<p class="left-align">Tarikh (Resit Am): {{$tarikh_diluluskan}}</p>
<p class="times-roman">&nbsp;</p>
<p class="times-roman">&nbsp;</p>
<p class="center-align">PERMIT INI TIDAK MEMERLUKAN TANDATANGAN</p>

</body>

</html>
