<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "usuarios";
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;
    protected $fillable = ['id_usuario', 'nom_usuario', 'email', 'curriculum', 'foto'];
}
