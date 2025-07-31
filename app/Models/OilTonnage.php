<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OilTonnage extends Model
{
    protected $table = 'oil_tonnages';

    protected $fillable = [
        'volume',
        'density',
        'temperature',
        'vcf',
        'tonnage',
    ];
    
}
