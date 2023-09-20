<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;

    // ProductComment.php
    public function replies()
    {
        return $this->hasMany(ProductReply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
