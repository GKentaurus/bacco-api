<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = "company";

  protected $fillable = [
    'idUser',
    'companyName',
    'documentType',
    'documentNumber',
    'verificationDigit',
    'billingEmail',
  ];

  protected $hidden = [];

  protected $casts = [];
}