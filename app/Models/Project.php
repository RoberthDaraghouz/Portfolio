<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Project extends Model{
    use HasFactory;

    protected $fillable = [
        'name',
        'development_year',
        'category_id',
        'project_type',
        'production_link',
        'preview_link',
        'github_link',
        'description',
        'details',
        'tools',
        'image_url',
    ];

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }
}