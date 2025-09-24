<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Submission extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'submissions';

    protected $primaryKey = 'uuid';  

    public $incrementing = false;
    protected $keyType   = 'string';

    protected $fillable = [
        'date', 'plant', 'sample_type', 'sample_storage', 'lab_request_micro', 'lab_request_chemical', 'report',
        'username', 'nama_spv', 'status_spv', 'catatan_spv', 'username_updated', 'tgl_update_spv'
    ];
    
    protected $casts = [
        'sample_storage' => 'array',
        'lab_request_micro' => 'array',
        'lab_request_chemical' => 'array',
        'report' => 'array', 
    ];
}
