<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class exercise extends Model
{
    use HasFactory;

    protected $table = 'exercise';

    protected $fillable = ['title', 'explanation', 'correct_answer'];

    public function user()
    {
        return $this->belongsToMany(User::class, 'usersexercise', 'id_exercise', 'id_user_id')
            ->withPivot('correct', 'answer');
    }
}
