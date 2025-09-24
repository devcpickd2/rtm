<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Sample_bulanan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'sample_bulanans';

    protected $primaryKey = 'uuid';  

    public $incrementing = false;
    protected $keyType   = 'string';

    protected $fillable = [
        'date', 'plant', 'sample_bulan', 'sample_storage', 'sample', 'catatan',
        'username', 'nama_warehouse', 'status_warehouse', 'nama_spv', 'status_spv', 'catatan_spv', 'username_updated', 'tgl_update_warehouse', 'tgl_update_spv'
    ];
    
    protected $casts = [
        'sample' => 'array', 
    ];
}
