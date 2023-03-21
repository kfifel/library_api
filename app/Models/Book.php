<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'number_pages',
        'location',
        'status',
        'content',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
