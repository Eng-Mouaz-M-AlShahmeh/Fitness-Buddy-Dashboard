<?php

namespace Modules\Dashboard\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Entities\Admin;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $numbers_of_users = DB::SELECT("select id, count(*) as count, date(created_at) as date from users WHERE  verified_status='1' and date(created_at) >= DATE(NOW()) - INTERVAL 7 DAY GROUP BY date(created_at)");
        $numbers_of_rests_orders = DB::SELECT("select id, count(*) as count, date(created_at) as date from order_resturants WHERE date(created_at) >= DATE(NOW()) - INTERVAL 7 DAY GROUP BY date(created_at)");
        $numbers_of_clubs_orders = DB::SELECT("select id, count(*) as count, date(created_at) as date from fitness_club_orders WHERE date(created_at) >= DATE(NOW()) - INTERVAL 7 DAY GROUP BY date(created_at)");
        $numbers_of_nutritionists_orders = DB::SELECT("select id, count(*) as count, date(created_at) as date from nutritionist_orders WHERE date(created_at) >= DATE(NOW()) - INTERVAL 7 DAY GROUP BY date(created_at)");
        $numbers_of_trainers_orders = DB::SELECT("select id, count(*) as count, date(created_at) as date from trainer_orders WHERE date(created_at) >= DATE(NOW()) - INTERVAL 7 DAY GROUP BY date(created_at)");

        return view('dashboard::index',compact('numbers_of_users','numbers_of_rests_orders',
        'numbers_of_clubs_orders','numbers_of_nutritionists_orders','numbers_of_trainers_orders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function logout(){
        Auth::logout();
        return redirect()->route('login');

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function editProfile(){
        return view('dashboard::profile')->with('admin',Auth::guard('admin'));

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function updateProfile(Request $request,$id)
    {
        $user=Admin::where('id',$id)->first();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->image=$request->image;
        if($user->password!=$request->password)
        {
            $user->password=$request->password;
        }
        if($user->save()){
            Toastr::success('Your Profile has been updated successfully!','Success',["positionClass" => "toast-top-right"]);
            return back();
        }
        Toastr::error('Sorry! Something went wrong.','False',["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
