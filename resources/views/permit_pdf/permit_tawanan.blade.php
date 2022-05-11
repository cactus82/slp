<!DOCTYPE html>
<html>
<head>
<title>Permit Haiwan Tawanan</title>
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

<p class="center-align"><span class="times-roman">BORANG 10(a)</span><br class="times-roman">
<span class="times-roman">(Peraturan 34)</span></p>
<p class="times-roman-center">NEGERI SABAH</p>
<p class="times-roman-center">ENAKMEN PEMELIHARAAN HIDUPAN LIAR 1997</p>
<p class="times-roman-center">PERMIT HAIWAN TAWANAN</p>
<p>&nbsp;</p>
<p class="times-roman-center">Nombor Permit <span class="underline">{{$no_permit}}</span></p>
<p>&nbsp;</p>
<p class="left-align">(Nama) <span class="underline">&nbsp;{{$nama ?? ''}}&nbsp;</span>
    beralamat di (Alamat) <span class="underline">&nbsp;{{$alamat ?? ''}}&nbsp;</span>
    dengan ini adalah layak untuk menyimpan dalam tawanan haiwan-haiwan atau hasil haiwan berikut:
    </p>
    <p class="left-align">&nbsp;</p>
    <p class="center-align">JADUAL</p>
    @if ($list)
        <table align="center" style="width: 90%">
            <tr>
                <td><span class="underline">Haiwan</span></td>
                <td><span class="underline">Spesis</span></td>
                <td><span class="underline">Nombor/Nama/Tanda</span></td>
            </tr>

            @foreach ($list as $v)
                <tr>
                    <td>{{$v->haiwan}}</td>
                    <td><span style="font-style:italic">{{$v->spesis}}</span></td>
                    <td>{{$v->bilangan}}&nbsp;(bilangan)</td>
                </tr>
            @endforeach
        </table>
    @endif
<p class="left-align">&nbsp;</p>
<p class="left-align">Permit ini adalah sah sehingga: {{$sah_sehingga ?? ''}}</p>
<p class="left-align">Fee dibayar: RM{{$jumlah_rm ?? ''}}</p>
<p class="left-align">Tarikh (Resit Am): {{$tarikh_resit}}</p>
<p class="times-roman">&nbsp;</p>
<p class="times-roman">&nbsp;</p>
<p class="center-align">PERMIT INI TIDAK MEMERLUKAN TANDATANGAN</p>

</body>

</html>
