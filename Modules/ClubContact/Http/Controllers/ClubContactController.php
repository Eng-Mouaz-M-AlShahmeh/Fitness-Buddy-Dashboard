<?php

namespace Modules\ClubContact\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ClubContact\Entities\ClubContact;
//use Barryvdh\DomPDF\Facade as PDF;
use PDF;
//use Dompdf\Dompdf;


class ClubContactController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $contacts=ClubContact::orderBy('id','desc')->get();
        return view('clubcontact::index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('clubcontact::create');
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
        $contacts=ClubContact::find($id);
        return view('clubcontact::show',compact('contacts'));
    }
    
    
    // generate pdf
    function pdf($id)
    {
        $contacts=ClubContact::find($id);
        
        //$dompdf = new Dompdf();
        //$dompdf->loadHtml('hello world');

        $pdf = PDF::loadView('clubcontact::pdf', ['contacts'=>$contacts])->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);;
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
        return view('clubcontact::edit');
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
        $contact= ClubContact::findOrFail($id);
        $contact->delete();
        Toastr::success('Your Club Contact has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
