<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User\Role;
use App\Models\User\Permission;
use App\Http\Requests\Admin\User\AdminUserRequest;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('role:user-admin,show-admin-user');
	    $this->middleware('role:user-admin,create-user')->only(['create', 'store']);
		$this->middleware('role:user-admin,edit-user')->only(['edit', 'update','activation','roles','rolesStore']);
		$this->middleware('role:user-admin,delete-user')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('xx');
        $admins = User::where('user_type', 1)->get();
        return view('admin.user.admin-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allUsers = User::where('user_type', 0)->where('activation', 1)->get();
        return view('admin.user.admin-user.create', compact('allUsers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        $inputs = $request->all();
        $user_id = $inputs['user_id'];
        $inputs['user_type'] = 1;
        $user = User::find($user_id);
        $user->update($inputs);
        return to_route('admin.user.admin-user.index')->with('swal-success', 'ادمین جدید با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.admin-user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, User $user)
    {
        $inputs = $request->all();
        $user->update($inputs);
        return to_route('admin.user.admin-user.index')->with('swal-success', 'ادمین سایت شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->forceDelete();
        return to_route('admin.user.admin-user.index')->with('swal-success', 'ایتم مورد نظر با موفقیت حذف شد ');
    }


    public function activation(User $user)
    {
        $user->activation = $user->activation == 0 ? 1 : 0;
        $result = $user->save();
        if ($result) {

            if ($user->activation == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function roles(User $admin)
    {
        //dd($admin->roles);
        $roles = Role::all();
        return view('admin.user.admin-user.roles', compact('admin', 'roles'));
    }

    public function rolesStore(Request $request, User $admin)
    {
        if ($admin->activation == 1) {
            $validated = $request->validate([
                'roles' => 'sometimes|exists:roles,id|array',
            ]);
            $admin->roles()->sync($request->roles);
            return to_route('admin.user.admin-user.index')->with('swal-success', 'نقش ها با موفقیت ثبت شدند');
        } else {
            return to_route('admin.user.admin-user.index')->with('swal-error', 'برای انجام عملیات , اکانت کاربر باید فعال شود ');
        }
    }


    public function permissions(User $admin)
    {
        $permissions = Permission::all();
        return view('admin.user.admin-user.permissions', compact('admin', 'permissions'));
    }

    public function permissionsStore(Request $request, User $admin)
    {
        if ($admin->activation == 1) {
            $validated = $request->validate([
                'permissions' => 'sometimes|exists:permissions,id|array',
            ]);
            $admin->permissions()->sync($request->permissions);
            return to_route('admin.user.admin-user.index')->with('swal-success', 'دسترسی ها با موفقیت ثبت شدند');
        } else {
            return to_route('admin.user.admin-user.index')->with('swal-error', 'برای انجام عملیات , اکانت کاربر باید فعال شود ');
        }
    }


}
