<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exercise;

class users extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    // public function exercise()
    // {
    //     return $this->belongsToMany(Exercise::class, 'usersexercise', 'id_user_id', 'id_exercise')
    //         ->withPivot('correct', 'answer');
    // }

    public function exercise()
    {
        return $this->belongsToMany(Exercise::class, 'usersexercise', 'id_user_id', 'id_exercise')->withPivot('id');
    }

}
