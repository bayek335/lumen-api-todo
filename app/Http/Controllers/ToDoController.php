<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;


class ToDoController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */


    protected function response($data, $method, $id = null)
    {
        try {

            $count = $data->get()->count();

            if ($count > 0) {
                return response()->json([
                    "status" => "Success",
                    "message" => "Success",
                    "data" => $data->$method(),
                ]);
            } else if ($count <= 0 && $id >= 0) {
                return response()->json([
                    "status" => "Not Found",
                    "message" => "Todo with ID " . $id . " Not Found",
                    "data" => $data,
                ], 404);
            } else {
                return response()->json([
                    "status" => "Not Found",
                    "message" => "Have not an Todo",
                    "data" => $data,
                ], 404);
            }
        } catch (\Throwable $th) {
            dd($th);
            return response()->json([
                "status" => "Internal Server Error",
                "message" => "Sorry, We get some Errors." . $th,
            ]);
        }
    }



    public function index(Request $request)
    {
        $data = ToDo::orderBy('id');
        if ($request->activity_group_id ?? false) {
            $data_wirh_query = $data->where('activity_group_id', $request->activity_group_id)->get();
            return response()->json([
                "status" => "Success",
                "message" => "Success",
                "data" => $data_wirh_query,
            ]);
        }
        return $this->response($data, 'get');
    }


    protected function fail_validation($field, $todo)
    {
        return response()->json([
            "status" => "Bad Request",
            "message" => $field . " cannot be null",
            "data" => $todo->orderBy('id')
        ], 400);
    }
    public function store(Request $request)
    {

        try {
            $todo = new ToDo();
            if (!$request->input('activity_group_id')) {
                return $this->fail_validation('activity_group_id', $todo);
            }
            if (!$request->input('title')) {
                return $this->fail_validation('title', $todo);
            }

            $todo->title = $request->input('title');
            $todo->activity_group_id = $request->input('activity_group_id');
            $todo->is_active = 1;
            $todo->priority = 'very-high';
            $todo->save();

            return response()->json([
                "status" => "Success",
                "message" => "Success",
                'data' => [
                    'created_at' => $todo->created_at,
                    'updated_at' => $todo->updated_at,
                    'id' => $todo->id,
                    'title' => $todo->title,
                    'activity_group_id' => $todo->activity_group_id,
                    "is_active" => boolval($todo->is_active),
                    'priority' => $todo->priority,
                ]
            ], 201);
        } catch (\Throwable $th) {
            return $this->response([], 'false');
        }
    }

    public function show($id)
    {
        $data = ToDo::where('id', $id);
        return $this->response($data, 'first', $id);
    }

    public function update(Request $request, $id)
    {
        $title = $request->input('title');
        $is_active = $request->input('is_active');
        try {
            $todo = ToDo::find($id);
            if ($todo) {

                if ($title ?? false) {
                    if (!$title) {
                        return $this->fail_validation('title', $todo);
                    }
                    $todo->title = $request->input('title');
                    $todo->save();
                } else if ($is_active ?? false) {
                    if (!$is_active) {
                        return $this->fail_validation('is_active', $todo);
                    }
                    $todo->is_active = $request->input('is_active');
                    $todo->save();
                }

                return response()->json([
                    "status" => "Success",
                    "message" => "Success",
                    'data' => $todo
                ]);
            } else {
                return $this->response(ToDo::where('id', $id), 'first', $id);
            }
        } catch (\Throwable $th) {
            return $this->response([], 'false');
        }
    }

    public function destroy($id)
    {
        try {
            $todo = ToDo::find($id);
            if ($todo) {
                $todo->delete();
                return response()->json([
                    "status" => "Success",
                    "message" => "Success",
                    "data" => toDo::orderBy('id'),
                ]);
            } else {
                return $this->response(toDo::where('id', $id), 'first', $id);
            }
        } catch (\Throwable $th) {
            return $this->response([], 'false');
        }
    }
}
