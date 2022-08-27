<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditoSector extends Model
{
    use HasFactory;

    protected $table = 'credito_sectores';

    protected $primaryKey = 'id';

    protected $fillable = [
        'sector',
        'descripcion',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s'
    ];
}
