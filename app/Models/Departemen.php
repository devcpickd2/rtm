<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid; 

class Departemen extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'departemens';

    protected $fillable = ['nama', 'uuid'];
}
