<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;


    protected $fillable = [
        'book_title',
        'book_author',
        'book_price',
        'book_quantity'
    ];

    public function issuances():HasMany{
        return $this->hasMany(Issuance::class);
    }

}





