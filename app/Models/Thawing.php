<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Thawing extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'thawings';

    protected $primaryKey = 'uuid';  

    public $incrementing = false;
    protected $keyType   = 'string';

    protected $fillable = [
        'date', 'kondisi_ruangan', 'jenis_produk', 'kode_produksi', 'jumlah', 
        'kondisi_produk', 'keterangan_kondisi', 'suhu_ruangan', 'mulai_thawing', 'selesai_thawing', 'kondisi_produk_setelah', 'keterangan_kondisi_setelah', 'jumlah_setelah', 'suhu_produk', 'catatan',
        'username', 'nama_produksi', 'status_produksi', 'nama_spv', 'status_spv', 'catatan_spv', 'username_updated', 'tgl_update_produksi', 'tgl_update_spv'
    ];
}
