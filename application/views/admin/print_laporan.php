<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Transaksi</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #222;
            margin: 30px;
            line-height: 1.5;
            font-size: 13px;
        }

        @page {
            size: A4 portrait;
            margin: 18mm;
        }

        /* ================= HEADER ================= */

        .report-header {
            text-align: center;
            border-bottom: 3px solid #222;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .report-header h1 {
            margin: 0;
            font-size: 28px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .company {
            margin: 6px 0;
            font-size: 14px;
            color: #555;
        }

        .report-header h2 {
            margin: 18px 0 5px;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .periode {
            margin: 0;
            font-size: 15px;
            font-weight: bold;
        }

        /* ================= SUMMARY ================= */

        .summary {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin: 25px 0;
        }

        .summary-box {
            flex: 1;
            border: 1px solid #d9d9d9;
            border-radius: 10px;
            background: #f8f8f8;
            padding: 18px;
            text-align: center;
        }

        .summary-title {
            font-size: 13px;
            color: #666;
            margin-bottom: 8px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .summary-value {
            font-size: 30px;
            font-weight: bold;
            color: #222;
        }

        .money {
            font-size: 20px;
        }

        /* ================= INFO ================= */

        .report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            background: #fafafa;
            border-radius: 8px;
        }

        .report-info strong {
            display: block;
            margin-bottom: 4px;
        }

        /* ================= TABLE ================= */

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background: #efefef;
            border: 1px solid #999;
            padding: 10px;
            font-size: 13px;
            text-transform: uppercase;
        }

        table td {
            border: 1px solid #bbb;
            padding: 9px;
            font-size: 13px;
            vertical-align: middle;
        }

        tbody tr:nth-child(even) {
            background: #fafafa;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        tfoot th {
            background: #e5e5e5;
            font-size: 14px;
            padding: 12px;
        }

        /* ================= SIGNATURE ================= */

        .signature {
            width: 260px;
            margin-left: auto;
            margin-top: 70px;
            text-align: center;
        }

        .signature p {
            margin: 0;
        }

        .signature .space {
            height: 70px;
        }

        /* ================= PRINT ================= */

        @media print {

            body {
                margin: 0;
                color: #000;
            }

            .summary-box {
                break-inside: avoid;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
            }

            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }
        }
    </style>
</head>

<body>

    <?php
    $laporan = is_array($laporan) ? $laporan : [];

    $pending = 0;
    $dikonfirmasi = 0;
    $dibatalkan = 0;
    $total_pendapatan = 0;

    foreach ($laporan as $l) {

        switch ($l->status_pemesanan) {

            case 'pending':
                $pending++;
                break;

            case 'dikonfirmasi':
                $dikonfirmasi++;
                $total_pendapatan += $l->total_bayar;
                break;

            case 'dibatalkan':
                $dibatalkan++;
                break;

            case 'selesai':
                $total_pendapatan += $l->total_bayar;
                break;
        }
    }
    ?>

    <div class="report-header">

        <h1>HASTAKA HOLIDAY TOUR & TRAVEL</h1>

        <p class="company">
            Sistem Informasi Pemesanan Paket Wisata
        </p>

        <hr>

        <h2>LAPORAN TRANSAKSI</h2>

        <p class="periode">
            Periode
            <strong>
                <?= date('d F Y', strtotime($tgl_mulai)); ?>
                -
                <?= date('d F Y', strtotime($tgl_selesai)); ?>
            </strong>
        </p>

    </div>

    <div class="summary">

        <div class="summary-box">
            <div class="summary-title">
                Pending
            </div>

            <div class="summary-value">
                <?= $pending; ?>
            </div>
        </div>

        <div class="summary-box">
            <div class="summary-title">
                Dikonfirmasi
            </div>

            <div class="summary-value">
                <?= $dikonfirmasi; ?>
            </div>
        </div>

        <div class="summary-box">
            <div class="summary-title">
                Dibatalkan
            </div>

            <div class="summary-value">
                <?= $dibatalkan; ?>
            </div>
        </div>

        <div class="summary-box">
            <div class="summary-title">
                Pendapatan
            </div>

            <div class="summary-value money">
                Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?>
            </div>
        </div>

    </div>

    <div class="report-info">

        <div>
            <strong>Tanggal Cetak</strong><br>
            <?= date('d F Y H:i'); ?>
        </div>

        <div style="text-align:right">
            <strong>Total Transaksi</strong><br>
            <?= count($laporan); ?> Transaksi
        </div>

    </div>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Kode Booking</th>
                <th>Pelanggan</th>
                <th>Paket</th>
                <th>Keberangkatan</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>

            <?php if (!empty($laporan)): ?>

                <?php foreach ($laporan as $i => $l): ?>

                    <tr>

                        <td class="text-center">
                            <?= $i + 1; ?>
                        </td>

                        <td>
                            <?= $l->kode_booking; ?>
                        </td>

                        <td>
                            <?= $l->nama_lengkap; ?>
                        </td>

                        <td>
                            <?= $l->nama_paket; ?>
                        </td>

                        <td>
                            <?= date('d-m-Y', strtotime($l->tgl_keberangkatan)); ?>
                        </td>

                        <td class="text-right">
                            Rp <?= number_format($l->total_bayar, 0, ',', '.'); ?>
                        </td>

                        <td class="text-center">
                            <?= ucfirst($l->status_pemesanan); ?>
                        </td>

                        <td>
                            <?= date('d-m-Y H:i', strtotime($l->tgl_transaksi)); ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="8" class="text-center">
                        Tidak ada data
                    </td>
                </tr>

            <?php endif; ?>

        </tbody>

        <tfoot>

            <tr>

                <th colspan="5" style="text-align:right">
                    Total Pendapatan
                </th>

                <th style="text-align:right">
                    Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?>
                </th>

                <th colspan="2"></th>

            </tr>

        </tfoot>

    </table>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
    <br><br><br>

    <div class="signature">

        <p>
            Bandung,
            <?= date('d F Y'); ?>
        </p>

        <p>
            Administrator
        </p>

        <br><br><br>

        <strong>
            (______________________)
        </strong>

    </div>

</body>

</html>