<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasModel extends Model
{
    use HasFactory;
    protected $table = 'tbberkas_berkas';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
}
