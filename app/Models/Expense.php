<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    
    public function user()
    {
        return $this->hasOne(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
