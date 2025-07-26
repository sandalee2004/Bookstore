<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}