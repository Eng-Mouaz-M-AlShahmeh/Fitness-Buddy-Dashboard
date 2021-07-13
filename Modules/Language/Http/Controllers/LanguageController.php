<?php

namespace Modules\Language\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Language\Http\Requests\LanguageRequest;
use Modules\Nutritionist\Entities\Language;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $langs = Language::get();
        return view('language::index',compact('langs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('language::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(LanguageRequest $request)
    {
        $data = $request->validated();

        $langs = Language::create($data);

        if($langs->save()) {
            Toastr::success('Your Language has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('language.index');
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
        return view('language::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $lang=Language::findOrFail($id);
        return view('language::edit',compact('lang'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(LanguageRequest $request, $id)
    {
        $lang=Language::findOrFail($id);
        $data = $request->validated();
        $lang->update($data);
        Toastr::success('Your Language has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('language.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $lang=Language::findOrFail($id);
        $lang->delete();
        Toastr::success('Your Language has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $lang=Language::findOrFail($request->id);
        $lang->status = $request->status;
        if($lang->save()){
            return 1;
        }
        return 0;
    }
}
