<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'category_id',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    public function childCategories(): HasMany
    {
        return $this->hasMany(PostCategory::class, 'category_id');
    }

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }
}
