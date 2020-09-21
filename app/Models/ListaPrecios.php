<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ListaPrecios extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = 'lista_precios';

  protected $fillable = [
    'nombreLista'
  ];

  protected $hidden = [];

  protected $casts = [];
}
