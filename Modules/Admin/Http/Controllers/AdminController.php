<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Http\Requests\AdminRequest;
use Modules\Auth\Entities\Admin;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $admins=Admin::where('id','!=' , Auth::guard('admin')->user()->id)->with('roles')->get();
        return view('admin::index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $allroles=Role::where('id' , '!=' , 1)->get();
        return view('admin::create',compact('allroles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(AdminRequest $request)
    {
        $data=$request->validated();
        $data['password']=$request->password;
        if(isset($request->image)){
        $data['image']=$request->image;
        }
        $admin=Admin::create($data);
        $admin->assignRole($request->role);
        \Brian2694\Toastr\Facades\Toastr::success('Your Admin Message has been Added successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $admintoedit=Admin::where('id',$id)->first();
        $admintoedit['roles']=DB::table('model_has_roles')->where('model_id',$id)->
        where('model_type','Modules\Auth\Entities\Admin')->select('role_id')->pluck('role_id');
        $allroles=Role::where('id' , '!=' , 1)->get();
        return view('admin::edit',compact('allroles','admintoedit'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(AdminRequest $request, $id)
    {
        $admintoupdate=Admin::where('id',$id)->first();
        $admintoupdate->name=$request->name;
        $admintoupdate->email=$request->email;
        $admintoupdate->image=$request->image;
        if($admintoupdate->password!=$request->password){
            $admintoupdate->password=$request->password;
        }
        if($request->roles) {
            $admintoupdate->roles()->sync($request->role);
        }
        $admintoupdate->save();
//        return   redirect()->route('admins.index')->with('success',' تم تعديل المدير بنجاح');
        \Brian2694\Toastr\Facades\Toastr::success('Your Admin Message has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $oneadmintodelete=Admin::where('id',$id)->first();
        $oneadmintodelete->delete();
//        return   redirect()->route('admins.index')->with('success',' تم مسح المدير بنجاح');
        \Brian2694\Toastr\Facades\Toastr::success('Your Admin Message has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
