<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'cat_id'; // your actual PK name
    public $incrementing = true;      // or false if not auto-incrementing
    protected $keyType = 'int';       // or 'string' if your PK is string

    protected $fillable = [
        'name',
    ];

    public function reports()
    {
        return $this->hasMany(AnonymousReport::class);
    }

    // Tell Laravel to use 'cat_id' for route model binding
    public function getRouteKeyName()
    {
        return 'cat_id';
    }
}
