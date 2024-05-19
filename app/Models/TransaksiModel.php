<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['id_user', 'tgl_transaksi', 'total_bayar', 'nama', 'alamat_jalan', 'kecamatan', 'kota', 'provinsi'];
}
