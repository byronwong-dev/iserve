<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();

        $completed_tasks = DB::table('todos')
                        ->select('user_id', DB::raw('count(*) as total'))
                        ->where('completed', true)
                        ->groupBy('user_id');

        $data = User::joinSub($completed_tasks, 'todos', function($join) {
            $join->on('users.id', '=', 'todos.user_id');
        })->orderBy($input['sort'] ?? 'total', $input['sort_direction'] ?? 'desc')->paginate(50);

        return view('todos', ['data' => $data]);

    }

    public function search(Request $request)
    {
        // we assume oauth token etc has been handled
        $input = $request->all();

        $todos = Todo::filter($input)->paginate($input['per_page'] ?? 50);

        return TodoResource::collection($todos);
    }

}
