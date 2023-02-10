<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoContent extends Model
{
    use HasFactory;

    protected $table = 'video_contents';
    protected $fillable = [
        'title',
        'category_id',
        'thumbnail',
        'video',
        'status',
        'duration', 'description'
    ];

    public function category(){
        return $this->belongsTo(Categories::class);
    }
}
