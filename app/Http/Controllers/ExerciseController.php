<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\customFunctions\CustomStuff;

class ExerciseController extends Controller
{
    public function index($id) {
        $query = "SELECT
            `usersexercise`.*,
            `exercise`.*,
            `users`.*,
            `exercise`.`id` AS `exercise_id`,
            `users`.`id` AS `users_id`
        FROM `usersexercise`
        INNER JOIN `exercise` ON `usersexercise`.`id_exercise` = `exercise`.`id`
        INNER JOIN `users` ON `usersexercise`.`id_user_id` = `users`.`id`
        WHERE `usersexercise`.`id` = :id
        ";

        $params = ['id' => $id];
        $exercise = DB::select($query, $params);
        // $exercise = [];// DEBUG

        if (!empty($exercise)) {
            return view('exercise', ['data' => $exercise[0], 'authorized' => null]);
        } else {
            return view('exercise', ['data' => null]);
        }
    }

    public function authorization(Request $req) {
        $customFunctions = new CustomStuff();


        $req->validate([
            'user_id' => 'required|numeric',
        ]);

        if($customFunctions->is_serialized($req->userIdForm)) {
            $data = unserialize($req->userIdForm);
        } else {
            $data = $req->userIdForm;
        }

        $query = "SELECT * from users WHERE user_id = :id";

        $params = ['id' => $data->user_id];
        $exercise = DB::select($query, $params);

        if ($exercise[0]->user_id == $data->user_id) {
            return view('exercise')->with('authorized', true)->with('data', $data);
        } else {
            return view('exercise', ['data' => null, 'authorized' => false]);
        }
    }
}
