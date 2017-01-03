<?php

namespace Apis;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    protected $table = 'tb_fabricantes';
    protected $fillable = [
      'nombre',
      'telefono',
    ];

    public function vehiculos()
    {
        $this->HasMany('Vehiculo');
    }
}
