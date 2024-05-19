<?= $this->extend('template/layout') ?>

<?= $this->section('judul') ?>
    Form Checkout Transaksi
<?= $this->endSection() ?>

<?= $this->section('konten') ?>

<form method="POST" action="<?= base_url('keranjang/checkout_proses') ?>">
    <table border="0">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>
                <input type="text" name="nama">
            </td>
        </tr>
        <tr>
            <td>Alamat Jalan dan Kelurahan</td>
            <td>:</td>
            <td>
                <textarea name="alamat_jalan"></textarea>
            </td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td>
                <input type="text" name="kecamatan">
            </td>
        </tr>
        <tr>
            <td>Kota</td>
            <td>:</td>
            <td>
                <input type="text" name="kota">
            </td>
        </tr>
        <tr>
            <td>Provinsi</td>
            <td>:</td>
            <td>
                <input type="text" name="provinsi">
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" name="" value="Chekcout">
            </td>
        </tr>
    </table>
</form>

<?= $this->endSection() ?>