<?php

namespace Modules\TrainerContact\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TrainerContact\Entities\TrainerContact;
use PDF;

class TrainerContactController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $contacts=TrainerContact::orderBy('id','desc')->get();
        return view('trainercontact::index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('trainercontact::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $contacts=TrainerContact::find($id);
        return view('trainercontact::show',compact('contacts'));
    }
    
       
    // generate pdf
    function pdf($id)
    {
        $contacts=TrainerContact::find($id);
        
        //$dompdf = new Dompdf();
        //$dompdf->loadHtml('hello world');

        $pdf = PDF::loadView('trainercontact::pdf', ['contacts'=>$contacts])->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);;
        return $pdf->stream('download.pdf');
        
        //$contacts=ClubContact::find($id);
        //$pdf = \App::make('dompdf.wrapper');
        //$pdf->PDF::loadView('clubcontact.pdf', $contacts);
        //return $pdf->downlaod('Contact.pdf');
    }
    
    /* 
    function convert_contact_data_to_html($id)
    {
     $contacts=ClubContact::find($id);

    }
    */
    
    
    
    

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('trainercontact::edit');
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
        $contact= TrainerContact::findOrFail($id);
        $contact->delete();
        Toastr::success('Your Trainer Contact has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
