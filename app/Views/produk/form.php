<?= $this->extend('template/layout') ?>

<?= $this->section('judul') ?>
    Form Produk
<?= $this->endSection() ?>

<?= $this->section('konten') ?>
<form action="<?= base_url('produk/proses_input') ?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="id_produk_pk" value="<?= isset($id_produk)?$id_produk:'' ?>">
	<table>
		<tr>
			<td>ID Produk</td>
			<td>:</td>
			<td>
				<input type="text" name="id_produk" value="<?= $default_id ?>">
			</td>
		</tr>
		<tr>
			<td>Nama Produk</td>
			<td>:</td>
			<td>
				<input type="text" name="nama_produk" value="<?= $default_nama ?>">
			</td>
		</tr>
		<tr>
			<td>Deskripsi Produk</td>
			<td>:</td>
			<td>
				<textarea name="deskripsi"><?= $default_deskripsi ?></textarea>
			</td>
		</tr>
		<tr>
			<td>Stok</td>
			<td>:</td>
			<td>
				<input type="number" name="stok_produk" min="0" value="<?= $default_stok ?>">
			</td>
		</tr>
		<tr>
			<td>Harga Jual</td>
			<td>:</td>
			<td>
				<input type="number" name="harga_jual" min="0" max="100000" value="<?= $default_harga ?>">
			</td>
		</tr>
		<tr>
			<td>Foto Produk</td>
			<td>:</td>
			<td>
				<input type="file" name="foto_produk">
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<input type="submit" name="submit" value="Simpan Data">
			</td>
		</tr>
	</table>
</form>
<?= $this->endSection() ?>