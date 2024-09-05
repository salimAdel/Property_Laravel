<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RoleBasedPrivilege;
use Illuminate\Http\Request;

class RoleBasedPrivilegeController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }

    public function index($role_Id)
    {
        try {
            $RoleBasedPrivilege = RoleBasedPrivilege::where('role_id', $role_Id)->get();
            return response()->json($RoleBasedPrivilege);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function update(Request $request, $role_Id)
    {
        try {
            $data = $request->validate([
                '*.id' => 'required|exists:role_based_privileges,id',
                '*.is_displayed' => 'required|boolean',
                '*.is_insert' => 'required|boolean',
                '*.is_update' => 'required|boolean',
                '*.is_delete' => 'required|boolean',
            ]);

            $RoleBasedPrivileges = RoleBasedPrivilege::where('role_id', $role_Id)->get();
            foreach ($data as $key => $value) {
                $RoleBasedPrivilege = $RoleBasedPrivileges->where('id', $value['id'])->first();
                $RoleBasedPrivilege->update($value);
            }
            return response()->json('RoleBasedPrivilege updated successfully');
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
