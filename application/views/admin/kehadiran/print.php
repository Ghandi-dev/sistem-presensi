<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Page</title>
    <link href="<?php echo base_url('assets/css/print.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="kop-surat">
        <h2>DAFTAR HADIR KEPALA DESA DAN PERANGKAT DESA</h2>
        <h2>PEMERINTAHAN DESA CIGELAM</h2>
        <h2>KECAMATAN BABAKANCIKAO KABUPATEN PURWAKARTA</h2>
    </div>
    <div style="display: flex; gap: 30px; margin-bottom: 0px">
        <h3 style="margin-bottom: 0px">Hari : <?=$hari?></h3>
        <h3 style="margin-bottom: 0px">Tanggal : <?php echo date('d F Y', strtotime($date)); ?></h3>
    </div>
    <div class="garis"></div>
    <page>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Waktu Datang</th>
                    <th colspan="2">Tanda Tangan</th>
                    <th>Waktu Pulang</th>
                    <th colspan="2">Tanda Tangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
$no = 1;
$totalRows = count($kehadiran);
foreach ($kehadiran as $index => $a):
?>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$a['nama']?></td>
                    <td><?=$a['jabatan'] ?: '-'?></td>
                    <?php if ($a['waktu_datang'] == "00:00:00"): ?>
                    <td>
                        <?php echo ucwords(strtolower($a['status'])) ?>
                    </td>
                    <?php else: ?>
                    <td><?=$a['waktu_datang']?></td>
                    <?php endif;?>
                    <?php if ($no % 2 != 0): // Jika nomor genap ?>
                    <td class="ttd" style="text-align: left;" rowspan="2"><sup><?=$no;?></sup></td>
                    <td class="ttd" style="text-align: left;" rowspan="2"><sup><?=$no + 1;?></sup></td>
                    <?php endif;?>

                    <?php if ($a['waktu_datang'] == "00:00:00"): ?>
                    <td>
                        <?php echo ucwords(strtolower($a['status'])) ?>
                    </td>
                    <?php else: ?>
                    <td><?=$a['waktu_pulang']?></td>
                    <?php endif;?>
                    <?php if ($no % 2 != 0): // Jika nomor genap ?>
                    <td class="ttd" style="text-align: left;" rowspan="2"><sup><?=$no;?></sup></td>
                    <td class="ttd" style="text-align: left;" rowspan="2"><sup><?=$no + 1;?></sup></td>
                    <?php endif;?>
                </tr>
                <?php
// Jika index terakhir adalah ganjil, tambahkan baris kosong untuk menyelaraskan rowspan
if (($index + 1) === $totalRows && ($totalRows % 2) !== 0):
?>
                <tr>
                    <td><?=$no + 1?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php endif;?>

                <?php $no++;endforeach;?>
            </tbody>
        </table>
        <div style="margin-top: 50px; page-break-inside: avoid;">
            <table class="table-normal" style="width: 100%; margin-top: 10px; border: none; border-collapse: collapse;">
                <tr>
                    <td style="text-align: left; width: 80%; margin: 0; padding: 0;">&nbsp; </td>
                    <td style="text-align: left; width: 20%; margin: 0; padding: 0;">Purwakarta,
                        <?php echo date('d F Y', strtotime($date)); ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 80%; margin: 0; padding: 0;">&nbsp;</td>
                    <td style="text-align: left; width: 20%; margin: 0; padding: 0;">Kepala Desa Cigelam</td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 80%;  padding: 50px 0 0 0; margin: 0;">&nbsp;</td>
                    <td style="text-align: left; width: 20%;  padding: 50px 0 0 0; margin: 0;">
                        <u>(<?php echo $kepala_desa->nama; ?>)</u>
                    </td>
                </tr>
            </table>
            <div style="text-align: left; ">
                <p style="margin: 0px;">Keterangan:</p>
                <p style="margin: 0px;">1. Dinas Luar (Lampirkan Surat Tugas)</p>
                <p style="margin: 0px;">2. Sakit (Lampirkan Surat Dokter)</p>
                <p style="margin: 0px;">3. Cuti (Lampirkan Surat Cuti Dari Atasan)</p>
                <p style="margin: 0px;">4. Izin (Lampirkan Surat Izin Dari Atasan)</p>
            </div>
        </div>

    </page>
    <script type="text/javascript">
    window.onload = function() {
        window.print();
    }
    </script>
</body>

</html>