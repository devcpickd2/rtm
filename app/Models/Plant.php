<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Plant extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = ['uuid', 'username', 'plant']; 


    //pakai route binding
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
