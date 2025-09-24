<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Sample_retain extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'sample_retains';

    protected $primaryKey = 'uuid';  

    public $incrementing = false;
    protected $keyType   = 'string';

    protected $fillable = [
        'nama_produk', 'kode_produksi', 'analisa', 'username', 'nama_spv', 'status_spv', 'catatan_spv', 'username_updated', 'tgl_update_spv'
    ];
    
    protected $casts = [
        'analisa' => 'array'
    ];
}
