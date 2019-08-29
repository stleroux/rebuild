<?php

namespace App\Http\Controllers\Users;

use DB;
use Session;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RemoveAllPermissionsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Get user
        $user = User::findOrFail($request->id);

        // Get all permissions
        $permissions = Permission::all();

        foreach ($permissions as $p) {
            DB::table('permission_user')->where('user_id', '=', $user->id)->delete();
        }
        
        Session::flash ('success', 'All permissions successfully removed!');
        return redirect()->route('users.edit', $user->id);
    }
}