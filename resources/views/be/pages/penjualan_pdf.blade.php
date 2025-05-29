{{-- filepath: c:\Users\yosua\OneDrive\Dokumen\NGODING\project\lspku\lsp-apotek-yosua\resources\views\be\pages\penjualan_pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Penjualan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #222; padding: 4px 8px; }
        th { background: #eee; }
        .kop {
            text-align: center;
            margin-bottom: 16px;
        }
        .kop .title {
            font-size: 1.3em;
            font-weight: bold;
        }
        .kop .subtitle {
            font-size: 1em;
        }
        .kop .alamat {
            font-size: 0.95em;
            margin-bottom: 8px;
        }
        .kop hr {
            border: 1px solid #222;
            margin: 8px 0 16px 0;
        }
        .footer-ttd {
            width: 100%;
            margin-top: 40px;
        }
        .footer-ttd td {
            border: none;
            text-align: left;
            padding-top: 40px;
        }
        .footer-ttd .ttd {
            text-align: right;
            padding-right: 60px;
        }
    </style>
</head>
<body>
    <div class="kop">
        <div class="title">PT Veni Creator Spiritus</div>
        <div class="subtitle">Karadenan No. 123, Jakarta, Indonesia</div>
        <div class="alamat">Telp: (021) 12345678 &nbsp; | &nbsp; Email: info@venicreatorspiritus.co.id</div>
        <hr>
        <div style="font-size:1.1em; font-weight:bold; margin-bottom:10px;">Laporan Daftar Penjualan</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Tanggal Penjualan</th>
                <th>Total Bayar</th>
                <th>Pelanggan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penjualan as $i => $item)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->tgl_penjualan }}</td>
                <td>{{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                <td>{{ $item->pelanggan ? $item->pelanggan->nama_pelanggan : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;">Belum ada data penjualan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <br><br>
    <table class="footer-ttd">
        <tr>
            <td></td>
            <td class="ttd">
                Mengetahui,<br>
                <b>Yosua Gerrard Ferdinand</b>
                <br><br><br><br>
                (........................................)
            </td>
        </tr>
    </table>
</body>
</html>
