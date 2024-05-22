<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'comu_codi';
    protected $table = 'tb_comuna';
        
   
}