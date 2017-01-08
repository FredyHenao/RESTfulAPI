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
    protected $hidden = ['created_at','updated_at'];

    public function vehiculos()
    {
        //relacion de uno a muchos un fabricante tiene muchos vehiculos
      return  $this->HasMany('Apis\Vehiculo');
    }
}
