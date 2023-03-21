<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory;
    public $table ='slider';
    protected $fillable = [
        'image', 
        'image_url', 
    ];
    public function getImageUrlAttribute(){
        return Storage::disk('public')->url($this->image);
    }
}
