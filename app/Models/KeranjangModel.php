<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
	protected $table      = 'keranjang';
	protected $primaryKey = 'id_keranjang';

	protected $useAutoIncrement = true;
	protected $returnType     = 'array';

	protected $allowedFields = ['id_produk', 'id_user', 'jumlah_beli'];
}
