<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\users;
use App\Models\Exercise;

class usersexercise extends Model
{
    use HasFactory;

    protected $fillable = ['id_user_id', 'id_exercise', 'correct', 'answer'];

    public function user()
    {
        return $this->belongsTo(users::class, 'id_user_id');
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'id_exercise');
    }
}
