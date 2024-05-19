<html>

<?= $this->include('template/call_head') ?>

<body class="sidebar-mini" style="height: auto;">

<div class="wrapper">

<?= $this->include('template/navbar') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 1592px;">
<?= $this->include('template/page_header') ?>
<!-- Main content -->
 <section class="content">
 <?= $this->include('template/page_konten') ?> 
 </section>
 
 <!-- /.content -->
 
</div>
<!-- /.content-wrapper -->
<?= $this->include('template/call_footer') ?>
</div>
<?= $this->include('template/call_js') ?>
</body>
</html>