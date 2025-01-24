<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homeowner extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'initial', 'first_name', 'last_name'];
}
