<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservations extends Model
{
    use HasFactory;
    protected $attributes = [
        'status' => 'waiting for confirmation',
    ];
    protected $guarded = [];
}
