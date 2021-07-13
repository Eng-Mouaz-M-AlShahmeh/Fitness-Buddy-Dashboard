<?php


namespace Modules\User\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\User;
use Modules\User\Http\Requests\UserRequest;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $users=User::orderBy('created_at','desc')->get();
        return view('user::index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('user::create');
 
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        /*if(isset($request->image)){
            $user->image=$request->image;
        }*/
        if($user->save()) {
            Toastr::success('Your User has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('user.index');
        }else{
            Toastr::success('Sorry! Something went wrong.', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $user=User::find($id);
        return view('user::show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        //$cities=City::all();
        //$nationalities=Nationality::all();
        //$getdetPlans=DepartmentPlan::where('dept_id','4')->pluck('plan_id');
        //$plans=Plan::whereIn('id',$getdetPlans)->get();
        return view('user::edit' ,compact('user'/*,'cities','nationalities','plans'*/));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        $user=User::findOrFail($id);
        $data = $request->validated();
        /*if(isset($request->image)){
            $user->image=$request->image;
        }*/
        $user->update($data);
        Toastr::success('Your User has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Toastr::success('Your User has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    
    public function updateStatus(Request $request)
    {
        $user=User::findOrFail($request->id);
        $user->status = $request->status;
        if($user->save()){
            return 1;
        }
        return 0;
    }
    
    
}
