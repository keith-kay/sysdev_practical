<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vcf extends Model
{
    protected $table = 'vcftable';

    protected $fillable = [
        'density',
        'temperature',
        'vcf',
    ];
}
