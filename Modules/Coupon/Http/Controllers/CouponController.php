<?php

namespace Modules\Coupon\Http\Controllers;

use App\Models\PushNotification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\User;
use Modules\Coupon\Entities\Coupon;
use Modules\Coupon\Entities\CouponUser;
use Modules\Coupon\Http\Requests\CouponRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $coupons=Coupon::orderBy('created_at')->get();
        return view('coupon::index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('coupon::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CouponRequest $request)
    {
        $data = $request->validated();
        $coupon = Coupon::create($data);
        if($coupon->save()) {
            $users= User::where('logged','1')
                ->select('id','firebase_token')->get();
            foreach ($users as $user) {
                $usercoupons = CouponUser::create([
                    'user_id' => $user->id,
                    'coupon_id' => $coupon->id,
                ]);
            }
            $users= User::where('logged','1')->pluck('firebase_token')->first();
            PushNotification::send_details($users,'fitness-buddy',$request->code,1);
            $usercoupons->save();
            Toastr::success('Your Coupon has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('coupon.index');
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
        return view('coupon::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('coupon::edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CouponRequest $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $data = $request->validated();
        $coupon->update($data);
        $users= User::where('logged','1')
            ->select('id','firebase_token')->get();
        foreach ($users as $user) {
            $usercoupons = CouponUser::create([
                'user_id' => $user->id,
                'coupon_id' => $id,
            ]);
        }
        $users= User::where('logged','1')->pluck('firebase_token')->first();
        PushNotification::send_details($users,'fitness-buddy',$request->code,1);
        $usercoupons->save();
        Toastr::success('Your Coupon has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        Toastr::success('Your Coupon has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $coupon = Coupon::findOrFail($request->id);
        $coupon->status = $request->status;
        if($coupon->save()){
            return 1;
        }
        return 0;
    }
}
