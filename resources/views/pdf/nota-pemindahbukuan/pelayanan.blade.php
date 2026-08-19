<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @media print {
            @page { size: A4 portrait; margin: 5mm; }
        }
        html, body {
            background: #FFFFFF;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #000;
        }
        .nota-box {
            width: 200mm;
            border: 1.5pt solid #000;
            padding: 0;
            margin: 4mm auto;
            font-size: 12pt;
        }
        .nota-head { display: table; width: 100%; border-bottom: 1pt solid #000; }
        .nota-head > div { display: table-cell; vertical-align: middle; padding: 6px 10px; }
        .nota-logo { width: 16%; }
        .nota-title { width: 62%; text-align: center; vertical-align: bottom !important; padding-bottom: 4px; }
        .nota-info { min-height: 14mm; font-family: consolas, "Lucida Console", Courier, monospace; font-size: 6pt; text-align: left; line-height: 1.3; margin-bottom: 4px; }
        .nota-nomor { width: 22%; border-left: 1pt solid #000; padding: 0 !important; }

        .nota-logo b { font-size: 16pt; letter-spacing: 1px; }
        .nota-logo img { height: 75px; width: auto; vertical-align: middle; }
        .nota-title b { font-size: 14pt; }

        .nomor-label { border-bottom: 1pt solid #000; text-align: center; padding: 4px; font-size: 11pt; }
        .nomor-value { text-align: center; padding: 10px 4px; font-size: 12pt; font-weight: bold; min-height: 24px; }

        .nota-body { padding: 10px 14px; }
        .nota-row { margin: 6px 0; }
        .fill { border-bottom: 1pt solid #000; display: inline-block; padding: 0 6px; }

        .nota-foot { display: table; width: 100%; margin-top: 14px; }
        .nota-foot > div { display: table-cell; width: 50%; vertical-align: top; text-align: center; }
        .nota-foot .kiri { padding-top: 10mm; }
        .nota-foot .kanan { padding-top: 5mm; }
        .ttd-space { height: 22mm; }
        .ttd-space-pincab { height: 22mm; }
    </style>
</head>
<body>
<?php
    $kodeKantor = $kodeKantor;
    $namaKantor = $namaKantor;
    $tanggal = $tanggal;
    $notaData = $nota;
    $nominalRupiah = $nominalRupiah;
    $pincab = $pincab;
    $manajerOperasional = $manajerOperasional;
    $keterangan = $nota->keterangan ?: '-';
    $jenisTransaksi = $nota->jenis_transaksi;
?>

<div class="nota-box">
    <div class="nota-head">
        <div class="nota-logo">
            <img src="{{ public_path('images/logo_bprjabar.png') }}"
                 onerror="this.style.display='none'" alt=""/>
        </div>
        <div class="nota-title">
            <b>NOTA PEMINDAHBUKUAN</b>
        </div>
        <div class="nota-nomor">
            <div class="nomor-label">NOMOR</div>
            <div class="nomor-value"></div>
        </div>
    </div>

    <div class="nota-body">
        <div class="nota-row" style="white-space:nowrap;">
            Jenis Transaksi : <span class="fill" style="min-width:80mm;"><?php echo htmlspecialchars($jenisTransaksi); ?></span>
            &nbsp; Nominal Rp. <span class="fill" style="min-width:38mm; text-align:right;"><?php echo htmlspecialchars($nominalRupiah); ?></span>
        </div>

        <div class="nota-row">
            Keterangan : <span class="fill" style="min-width:160mm;"><?php echo htmlspecialchars($keterangan); ?></span>
        </div>

        <div class="nota-foot">
            <div class="kiri">
                Yang Membukukan,
                <div class="ttd-space"></div>
                <span class="fill" style="min-width:70mm;"><strong><?php echo htmlspecialchars(strtoupper($manajerOperasional)); ?></strong></span><br/>
                <small>Manajer Operasional</small>
            </div>
            <div class="kanan">
                <?php echo htmlspecialchars($kotaKantor . ', ' . $tanggal); ?><br/>
                Diketahui,
                <div class="ttd-space-pincab"></div>
                <span class="fill" style="min-width:70mm;"><strong><?php echo htmlspecialchars(strtoupper($pincab)); ?></strong></span><br/>
                <small>Pemimpin Cabang</small>
            </div>
        </div>
    </div>
</div>
</body>
</html>
