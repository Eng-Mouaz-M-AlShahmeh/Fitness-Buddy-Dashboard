<?php

namespace Modules\Classes\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Classes\Http\Requests\ClassRequest;
use Modules\Nutritionist\Entities\Classes;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $classes=Classes::get();
        return view('classes::index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('classes::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ClassRequest $request)
    {
        $data = $request->validated();
        $classes = Classes::create($data);
        if($classes->save()) {
            Toastr::success('Your Class has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('class.index');
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
        return view('classes::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $class= Classes::findOrFail($id);
        return view('classes::edit',compact('class'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ClassRequest $request, $id)
    {
        $class= Classes::findOrFail($id);
        $data = $request->validated();
        $class->update($data);
        Toastr::success('Your Class has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('class.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $class= Classes::findOrFail($id);
        $class->delete();
        Toastr::success('Your Class has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        $class= Classes::findOrFail($request->id);
        $class->status = $request->status;
        if($class->save()){
            return 1;
        }
        return 0;
    }
}
