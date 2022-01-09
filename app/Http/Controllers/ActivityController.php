<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;


class ActivityController extends Controller
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
                    "message" => "Activity with ID " . $id . " Not Found",
                    "data" => $data,
                ], 404);
            } else {
                return response()->json([
                    "status" => "Not Found",
                    "message" => "Have not an Activity",
                    "data" => $data,
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "Internal Server Error",
                "message" => "Sorry, We get some Errors.",
            ]);
        }
    }



    public function index()
    {
        $data = Activity::orderBy('id');
        return $this->response($data, 'get');
    }


    protected function fail_validation($field, $activity)
    {
        return response()->json([
            "status" => "Bad Request",
            "message" => $field . " cannot be null",
            "data" => $activity->orderBy('id')
        ], 400);
    }
    public function store(Request $request)
    {

        try {
            $activity = new Activity();

            if (!$request->input('title')) {
                return $this->fail_validation('title', $activity);
            }
            if (!$request->input('email')) {
                return $this->fail_validation('email', $activity);
            }

            $activity->title = $request->input('title');
            $activity->email = $request->input('email');
            $activity->save();

            return response()->json([
                "status" => "Success",
                "message" => "Success",
                'data' => [
                    'created_at' => $activity->created_at,
                    'updated_at' => $activity->updated_at,
                    'id' => $activity->id,
                    'title' => $activity->title,
                    'email' => $activity->email,
                ]
            ], 201);
        } catch (\Throwable $th) {
            return $this->response([], 'false');
        }
    }

    public function show($id)
    {
        $data = Activity::where('id', $id);
        return $this->response($data, 'first', $id);
    }

    public function update(Request $request, $id)
    {
        try {
            $activity = Activity::find($id);
            if ($activity) {

                if (!$request->input('title')) {
                    return $this->fail_validation('title', $activity);
                }

                $activity->title = $request->input('title');
                if ($request->input('email')) {
                    $activity->email = $request->input('email');
                }
                $activity->save();

                return response()->json([
                    "status" => "Success",
                    "message" => "Success",
                    'data' => $activity
                ]);
            } else {
                return $this->response(Activity::where('id', $id), 'first', $id);
            }
        } catch (\Throwable $th) {
            return $this->response([], 'false');
        }
    }

    public function destroy($id)
    {
        try {
            $activity = Activity::find($id);
            if ($activity) {
                $activity->delete();
                return response()->json([
                    "status" => "Success",
                    "message" => "Success",
                    "data" => Activity::orderBy('id'),
                ]);
            } else {
                return $this->response(Activity::where('id', $id), 'first', $id);
            }
        } catch (\Throwable $th) {
            return $this->response([], 'false');
        }
    }
}
