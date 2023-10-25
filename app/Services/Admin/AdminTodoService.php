<?php

namespace App\Services\Admin;

use App\Models\CourseCategory;
use App\Models\Todos;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AdminTodoService
{

    public static function create($request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                ]
            );

            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $todo = new Todos();
            $todo->title = $request->title;
            $todo->complete = $request->complete;
            $todo->save();
            return ['status' => 200, 'msg' => 'Todo has been created successfully.'];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function List($request)
    {
        try {
            $rv = Todos::all();
            return ['status' => 200, 'data' => $rv];
        } catch (\Exception $e) {
            return ['status' => 500, 'error' => $e->getMessage()];
        }
    }
    public static function Update($request)
    {
        try {
            $input = $request->input();
            $validator = Validator::make($input, [
                'id' => 'required',
                'title' => 'required',
            ]);
            if ($validator->fails()) {
                return ['status' => 500, 'error' => $validator->errors()];
            }

            $todo = Todos::where('id', $input['id'])->first();
            $todo->title = $input['title'];
            $todo->complete = $input['complete'];
            $todo->save();
            return ['status' => 200, 'msg' => 'Todo has been updated successfully.'];
        } catch (\Exception $e) {
            return ['status' => 500, 'error' => $e->getMessage()];
        }
    }
    public static function Delete($request)
    {
        try {
            $input = $request->input();
            $validator = Validator::make($input, [
                'id' => 'required'
            ]);
            if ($validator->fails()) {
                return ['status' => 500, 'error' => $validator->errors()];
            }
            Todos::where('id', $input['id'])->delete();
            return ['status' => 200, 'msg' => 'Todo has been deleted successfully.'];
        } catch (\Exception $e) {
            return ['status' => 500, 'error' => $e->getMessage()];
        }
    }
}
