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
        .nota-nomor { width: 22%; border-left: 1pt solid #000; padding: 0 !important; }

        .nota-logo b { font-size: 16pt; letter-spacing: 1px; }
        .nota-logo img { height: 75px; width: auto; vertical-align: middle; }
        .nota-title b { font-size: 14pt; }

        .nomor-label { border-bottom: 1pt solid #000; text-align: center; padding: 4px; font-size: 11pt; }
        .nomor-value { text-align: center; padding: 10px 4px; font-size: 12pt; font-weight: bold; min-height: 24px; }

        .nota-body { padding: 10px 14px; }
        .nota-row { margin: 6px 0; }
        .fill { border-bottom: 1pt solid #000; display: inline-block; padding: 0 6px; }

        .terbilang {
            background: rgba(200, 200, 200, 0.5);
            padding: 6px 14px;
            font-size: 11pt;
            font-style: italic;
            text-align: center;
        }

        .nota-foot { display: table; width: 100%; margin-top: 14px; }
        .nota-foot > div { display: table-cell; width: 33%; vertical-align: top; text-align: center; }
        .nota-foot .col1 { padding-top: 10mm; }
        .nota-foot .col2 { padding-top: 10mm; }
        .nota-foot .col3 { padding-top: 5mm; }
        .ttd-space { height: 22mm; }
        .ttd-label { font-size: 10pt; }
    </style>
</head>
<body>
<?php
    $kodeKantor = $kodeKantor;
    $namaKantor = $namaKantor;
    $tanggal = $tanggal;
    $notaData = $nota;
    $nominalRupiah = $nominalRupiah;
    $stafTeller = $stafTeller;
    $manajerOperasional = $manajerOperasional;
    $pimpinanDivisi = $pimpinanDivisi;
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

        <div class="terbilang" style="margin-top: 6px;">
            === <?php echo htmlspecialchars($terbilang); ?> Rupiah ===
        </div>

        <div class="nota-row">
            Keterangan : <span class="fill" style="min-width:160mm;"><?php echo htmlspecialchars($keterangan); ?></span>
        </div>

        <div class="nota-foot">
            <div class="col1">
                Yang Membukukan,
                <div class="ttd-space"></div>
                <span class="fill" style="min-width:50mm;"><strong><?php echo htmlspecialchars(strtoupper($stafTeller)); ?></strong></span><br/>
                <small>Staf Teller</small>
            </div>
            <div class="col2">
                Diperiksa,
                <div class="ttd-space"></div>
                <span class="fill" style="min-width:50mm;"><strong><?php echo htmlspecialchars(strtoupper($manajerOperasional)); ?></strong></span><br/>
                <small>Manajer Operasional</small>
            </div>
            <div class="col3">
                <?php echo htmlspecialchars($kotaKantor . ', ' . $tanggal); ?><br/>
                Diketahui,
                <div class="ttd-space"></div>
                <span class="fill" style="min-width:45mm;"><strong><?php echo htmlspecialchars(strtoupper($pimpinanDivisi)); ?></strong></span><br/>
                <small>Pimpinan Divisi Operasional</small>
            </div>
        </div>
    </div>
</div>
</body>
</html>
