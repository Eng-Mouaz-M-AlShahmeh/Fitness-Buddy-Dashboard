<?php

namespace Modules\Activity\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Activity\Http\Requests\ActivityRequest;
use Modules\FitnessClub\Entities\ClubActivity;
use Modules\FitnessClub\Entities\FitnessClub;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $activities=ClubActivity::get();
        return view('activity::index',compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $clubs=FitnessClub::all();
        return view('activity::create',compact('clubs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ActivityRequest $request)
    {
        $data = $request->validated();

        $activity = ClubActivity::create($data);

        if($activity->save()) {
            Toastr::success('Your Club Activity has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('activity.index');
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
        return view('activity::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $activity = ClubActivity::findOrFail($id);
        $clubs=FitnessClub::all();
        return view('activity::edit',compact('clubs','activity'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ActivityRequest $request, $id)
    {
        $activity = ClubActivity::findOrFail($id);
        $data = $request->validated();
        $activity->update($data);
        Toastr::success('Your Club Activity has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('activity.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $activity = ClubActivity::findOrFail($id);
        $activity->delete();
        Toastr::success('Your Club Activity has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
