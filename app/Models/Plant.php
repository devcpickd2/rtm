<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Plant extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'plants'; // pastikan tabel sesuai

    protected $fillable = ['uuid', 'plant']; 

    // pakai route binding
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public static function getByName($name)
    {
        return self::where('plant', 'like', "%{$name}%")->first();
    }
}
