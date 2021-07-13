<?php

namespace Modules\Nationality\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Nationality\Http\Requests\NationalityRequest;
use Modules\Nutritionist\Entities\Nationality;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $nationalities = Nationality::get();
        return view('nationality::index',compact('nationalities'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('nationality::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(NationalityRequest $request)
    {
        $data = $request->validated();

        $nationalities = Nationality::create($data);

        if($nationalities->save()) {
            Toastr::success('Your Natinoality has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('nationality.index');
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
        return view('nationality::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $nationality=Nationality::findOrFail($id);
        return view('nationality::edit',compact('nationality'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(NationalityRequest $request,$id)
    {
        $nationality=Nationality::findOrFail($id);
        $data = $request->validated();
        $nationality->update($data);
        Toastr::success('Your Nationality has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('nationality.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $nationality=Nationality::findOrFail($id);
        $nationality->delete();
        Toastr::success('Your Nationality has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $nationality=Nationality::findOrFail($request->id);
        $nationality->status = $request->status;
        if($nationality->save()){
            return 1;
        }
        return 0;
    }
}
