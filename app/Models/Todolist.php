<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;
    protected $table = 'todolist';

    protected $fillable = ['title', 'description', 'is_completed', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
