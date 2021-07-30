<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function updator()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'creator',
        'updator',
        'created_at' => 'datetime:D, d/m/Y h:m A',
        'updated_at' => 'datetime:D, d/m/Y h:m A',
    ];
}
