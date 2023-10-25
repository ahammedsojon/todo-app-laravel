<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Repository\CategoriesRepository;
use App\Services\Admin\AdminTodoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    public function create(Request $request){
        $rv = AdminTodoService::create($request);
        return response()->json($rv, 200);
    }
    public function List(Request $request)
    {
        $rv = AdminTodoService::List($request);
        return response()->json($rv, 200);
    }
    public function Update(Request $request)
    {
        $rv = AdminTodoService::Update($request);
        return response()->json($rv, 200);
    }
    public function Delete(Request $request)
    {
        $rv = AdminTodoService::Delete($request);
        return response()->json($rv, 200);
    }
}
