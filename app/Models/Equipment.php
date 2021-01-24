<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'brand_id', 'descricao', 'num_serie', 'problemas'];

    public function registry()
    {
        $this->belongsTo(Registry::class);
    }
}
