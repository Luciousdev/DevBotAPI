<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use App\Models\exercise;
use App\Models\userexercise;
use Illuminate\Support\Facades\DB;


class ApiController extends Controller
{
    public function getLink(Request $req)
    {
        // Validate the request
        $req->validate([
            'userId' => 'required|numeric',
        ]);

        $userId = $req->userId;

        $user = users::where('user_id', $userId)->first();

        if (!$user) {
            $user = Users::create(['user_id' => $userId]);
        }

        // Get a random exercise
        $randomExercise = Exercise::inRandomOrder()->first();

        $user->exercise()->attach($randomExercise, [
            'correct' => null,
            'answer' => null,
        ]);


        $query = "SELECT *
            FROM `usersexercise`
            WHERE `id_user_id` = $user->id AND `id_exercise` = $randomExercise->id
            ORDER BY `id` DESC
            LIMIT 1;";


        $pivotRecord = DB::select($query);

        if (!empty($pivotRecord)) {
            $id = $pivotRecord[0]->id;
            $link = url("/exercise/{$id}");
        } else {
            $link = 'Something happened, please report this issue';
        }

        return response()->json([
            'link' => $link
        ]);
    }
}
