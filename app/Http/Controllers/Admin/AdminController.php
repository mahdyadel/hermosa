<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminRequest;

// REPOSITORIES
use App\Repositories\AdminRepo;

use Auth;

class AdminController extends Controller {

    protected $user;

    public function __construct(AdminRepo $user) {
        // INITIATE USER REPO
        $this->user = $user;
        // AUTH MIDDLEWARE
        $this->middleware('auth');
        // PREMISSIONS MIDDLEWARE
        $this->middleware('permission:CREATE_ADMINS')->only(['create', 'store']);
        $this->middleware('permission:READ_ADMINS')->only('index');
        $this->middleware('permission:UPDATE_ADMINS')->only(['edit', 'update']);
        $this->middleware('permission:DELETE_ADMINS')->only('destroy');
    }

    public function index(Request $request) {
        $user    = auth()->user();
        $salonId = in_array($user->type, ["SALON_OWNER", "SALON_ADMIN"]) && $user->salon_id ? $user->salon_id : null;
    
        $users   = $this->user->filter($request->search, $salonId);
        return view('admin.index', compact('users'));
    }

    public function create() {
        return view('admin.create');
    }

    public function store(AdminRequest $request) {

        // INITIALIZATION
        $data = $request->all();
        $data['type']     = in_array(auth()->user()->type, ['SALON_OWNER', 'SALON_ADMIN']) ? 'SALON_ADMIN' : 'ADMIN';
        $data['salon_id'] = @auth()->user()->salon_id;

        // CREATE NEW ADMIN 
        $user = $this->user->create($data);

        // APPENED PERMISSIONS TO CREATED ADMIN
        $user->syncPermissions($request->user_permissions);

        // RETURN TO VIEW WITH SUCCESS MESSAGE
        return redirect('/admins')->with(['success' => __('messages.has_been_created')]);
    }

    public function edit($id) {
        $user = $this->user->find($id);
        $this->rightSalonPermission($user->salon_id);
        return view('admin.edit', compact('user'));
    }

    public function update(request $request, $id) {   
        // INITIALIZATION
        $data = $request->password ? $request->all() : $request->except('password');

        // FIND THE ADMIN
        $user = $this->user->find($id);

        $this->rightSalonPermission($user->salon_id);

        // UPDATE ADMIN DATA
        $user->update($data);

        // UPDATE PERMISSIONS
        $user->syncPermissions($request->user_permissions);

        // RETURN TO VIEW WITH SUCESS MESSAGE
        return redirect('/admins')->with(['success' => __('messages.has_been_updated')]);
    }

    public function destroy($id) {
        // CHECK IF THE CURRENT ADMIN IS NOT THE TARGET ADMIN TO DELETE
        if(Auth::user()->id != $id) {
            // FIND ADMIN
            $user = $this->user->find($id);

            $this->rightSalonPermission($user->salon_id);

            // DELETE
            $user->delete();
            // REDIRECT WITH SUCCESS MESSAGE
            return redirect('/admins')->with(['success' => __('messages.has_been_deleted')]);
        }
        return redirect('/admins');
    }

    public function rightSalonPermission($id) {
        $user  = auth()->user();
        if(in_array($user->type, ['SALON_OWNER', 'SALON_ADMIN']) && $user->salon_id != $id) {
            abort(403, 'Access denied');
        }
    }

}