<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Verifikasi_sanitasi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'verifikasi_sanitasis';

    protected $primaryKey = 'uuid';  

    public $incrementing = false;
    protected $keyType   = 'string';
    public $timestamps = false;

    protected $fillable = [
        'date', 'shift', 'pukul', 
        'area', 'mesin', 'cleaning_agents', 'keterangan', 'catatan',
        'username', 'nama_produksi', 'status_produksi', 'nama_spv', 'status_spv', 'catatan_spv', 'username_updated', 'tgl_update_produksi', 'tgl_update_spv'
    ];
}
