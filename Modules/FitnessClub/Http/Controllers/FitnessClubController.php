<?php

namespace Modules\FitnessClub\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\City\Entities\City;
use Modules\FitnessClub\Entities\FitnessClub;
use Modules\FitnessClub\Entities\FitnessClubRating;
use Modules\FitnessClub\Http\Requests\FitnessClubRequest;

class FitnessClubController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $clubs=FitnessClub::orderBy('created_at')->get();
        return view('fitnessclub::index',compact('clubs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $cities=City::all();
        return view('fitnessclub::create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(FitnessClubRequest $request)
    {
        $data=$request->validated();
        $club=FitnessClub::create($data);
        if(isset($request->image)){
            $club->image=$request->image;
        }
        if(isset($request->logo)){
            $club->logo=$request->logo;
        }
        if($club->save()) {
            Toastr::success('Your Fitness Club has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('fitness.club.index');
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
        $club=FitnessClub::findOrFail($id);
        $rates=FitnessClubRating::where('club_id',$club->id)->get();
        return view('fitnessclub::show',compact('club','rates'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $cities=City::all();
        $club=FitnessClub::findOrFail($id);
        return view('fitnessclub::edit',compact('cities','club'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(FitnessClubRequest $request, $id)
    {
        $club=FitnessClub::findOrFail($id);
        $data = $request->validated();
        if(isset($request->image)){
            $club->image=$request->image;
        }
        if(isset($request->logo)){
            $club->logo=$request->logo;
        }
        $club->update($data);
        Toastr::success('Your Fitness Club has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('fitness.club.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $club=FitnessClub::findOrFail($id);
        $club->delete();
        Toastr::success('Your Fitness Club has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $club=FitnessClub::findOrFail($request->id);
        $club->status = $request->status;
        if($club->save()){
            return 1;
        }
        return 0;
    }
}
