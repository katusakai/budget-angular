<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $roles = Role::all('id', 'name');

        if ($roles) {
            return $this->sendResponse($roles, 'A list of roles has been shown');
        } else {
            return $this->sendError('Roles was not found', [], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $roleId
     * @param $userId
     * @return JsonResponse
     */
    public function update($roleId, $userId)
    {
        $user = User::find($userId);
        $role = Role::find($roleId)->name;

        if ($role !== 'super-admin') {
            if ($user->hasRole($role)) {
                $user->removeRole($role);
                $message = "Role '{$role}' was removed from user '{$user->email}'";
            } else {
                $user->assignRole($role);
                $message = "Role '{$role}' was assigned to user '{$user->email}'";
            }
        } else {
            $message = "Role {$role} cannot be changed";
        }

        return $this->sendResponse('', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
