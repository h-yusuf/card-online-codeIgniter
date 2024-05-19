<?= $this->extend('template/layout') ?>

<?= $this->section('judul') ?>
    List Keranjang Belanja
<?= $this->endSection() ?>

<?= $this->section('konten') ?>

<table border="1">
    <tr>
        <th>Nama Produk</th>
        <th>Jumlah Beli</th>
        <th>Harga</th>
        <th>Opsi</th>
    </tr>
    <?php

    $total = 0;
    foreach ($data_keranjang as $index => $row) { ?>

    <tr>
        <td><?= $row->nama_produk ?></td>
        <td><?= $row->jumlah_beli ?></td>
        <td><?= ($row->harga*$row->jumlah_beli) ?></td>
        <td>
            <a href="<?= 'keranjang/proses?id_keranjang='.$row->id_keranjang.'&aksi=hapus' ?>">Hapus</a>
        </td>
    </tr>
    <?php 
        $total += $row->harga*$row->jumlah_beli; 
    } 
    ?>

    <tr>
        <td colspan="2">Total Belanja</td>
        <td colspan="2"><?= $total ?></td>
    </tr>
</table>
<hr/>
<a href="<?= base_url('keranjang/checkout') ?>">Cekout Transaksi</a>

<?= $this->endSection() ?>