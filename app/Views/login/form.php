<?= $this->extend('template/layout') ?>

<?= $this->section('judul') ?>
    Form Login
<?= $this->endSection() ?>

<?= $this->section('konten') ?>

<form action="<?= base_url('login/proses_login') ?>" method="POST" enctype="multipart/form-data">
    <p style="color: red">
        <?= $error_msg ?>
    </p>
    <table>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td>
                <input type="text" name="username">
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td>
                <input type="password" name="password" >
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" name="submit" value="Login">
            </td>
        </tr>
    </table>
</form>


<?= $this->endSection() ?>