<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';

    protected $fillable = ['type_id', 'brand_id', 'descricao', 'num_serie', 'problemas', 'registry_id'];

    public function registry()
    {
        return $this->belongsTo(Registry::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function type()
    {
        return $this->belongsTo(EquipmentType::class);
    }
}
