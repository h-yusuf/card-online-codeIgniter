<?= $this->extend('template/layout') ?>

<?= $this->section('judul') ?>
    Riwayat Transaksi
<?= $this->endSection() ?>

<?= $this->section('konten') ?>

<table border="1">
    <tr>
        <th>No.</th>
        <th>Nama Tujuan Pengiriman</th>
        <th>Alamat Jalan</th>
        <th>Kecamatan</th>
        <th>Kota</th>
        <th>Provinsi</th>
        <th>Tanggal</th>
        <th>Total Pembelian</th>
    </tr>
    <?php foreach ($data_trans as $index => $row) { ?>
    <tr>
        <td><?= $index+1 ?></td>
        <td><?= $row->nama ?></td>
        <td><?= $row->alamat_jalan ?></td>
        <td><?= $row->kecamatan ?></td>
        <td><?= $row->kota ?></td>
        <td><?= $row->provinsi ?></td>
        <td><?= date("d-M-Y", strtotime($row->tgl_transaksi)) ?></td>
        <td><?= 'Rp '.number_format($row->total_bayar) ?></td>
    </tr>
    <?php } ?>
</table>

<?= $this->endSection() ?>