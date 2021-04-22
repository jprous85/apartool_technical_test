<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'apartments';

    protected $fillable = [
        'category_id', 'name', 'description', 'quantity', 'active', 'deleted_at'
    ];
}
