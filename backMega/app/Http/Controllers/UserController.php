<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as ResourcesUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use RuntimeException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);
        return ResourcesUser::collection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            User::create($request->all());
            return response()->json([
                "message" => "user record created"
            ], 200);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "message" => $e->getMessage()
                ],
                400
            );
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return new ResourcesUser($user);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "message" => $e->getMessage()
                ],
                400
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->all());
            return response()->json([
                "message" => "user has been edited"
            ], 200);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "message" => $e->getMessage()
                ],
                400
            );
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(
                [
                    "messsage" => "user has been deleted"
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    "message" => $e->getMessage()
                ],
                400
            );
        }
    }


    public function filterBetweenDates(Request $request)
    {
        try {
            $start = Carbon::parse($request->start);
            $end = Carbon::parse($request->end);
            if ($start > $end) {
                return response()->json(
                    [
                        "message" => "Data inicial maior que a final !"
                    ],
                    400
                );
            }
            $get_all_user = User::whereBetween('birth_date', [$start, $end])->paginate(15);
            return ResourcesUser::collection($get_all_user);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "message" => $e->getMessage()
                ],
                400
            );
        }
    }

    public function filterByNewestUsers()
    {
        try {
            $users = User::orderBy('birth_date', 'desc')->paginate(15);
            return ResourcesUser::collection($users);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "message" => $e->getMessage()
                ],
                400
            );
        }
    }
}
