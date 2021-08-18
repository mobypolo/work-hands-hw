<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SomeRand extends Model
{
    use HasFactory;
    protected $table = 'some_rands';
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'second_name',
    ];

    public function getAttribute($name)
    {
        return parent::getAttribute(Str::snake($name));
    }

    public function setAttribute($name, $value)
    {
        return parent::setAttribute(Str::snake($name), $value);
    }
}
