<?php


namespace Src\Infrastructure\ORMConnect;

use Illuminate\Database\Eloquent\Model;

final class CategoryORMConnect extends Model
{
    protected $table = 'categories';
    protected $guarded = [];
}
