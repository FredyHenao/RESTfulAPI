<?php

namespace Apis;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'tb_vehiculo';
    protected $primaryKey = 'serie';
    protected $fillable = [
        'color',
        'cilindraje',
        'potencia',
        'peso',
    ];

    public function fabricantes()
    {
        $this->BelongsTo('Fabricante');
    }
}
