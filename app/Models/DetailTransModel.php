<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransModel extends Model
{
    protected $table      = 'detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['id_transaksi', 'id_produk', 'harga', 'jumlah_beli'];
}
