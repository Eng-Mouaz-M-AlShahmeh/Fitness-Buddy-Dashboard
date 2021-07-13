<?php

namespace Modules\Department\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Department\Entities\Department;
use Modules\Department\Entities\DepartmentPlan;
use Modules\DepartmentPlans\Entities\DepartmentPlans;
use Modules\FitnessClub\Entities\FitnessClub;
use Modules\Nutritionist\Entities\Nutritionist;
use Modules\Plan\Entities\Plan;
use Modules\Resturant\Entities\Resturant;
use Modules\Trainer\Entities\Trainer;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function departments()
    {
        $lang=getallheaders()['Lang'];
        $departments = Department::where('status',1)->get();
        $res_item = [];
        $res_list = [];
        foreach ($departments as $dept) {
            $res_item['id'] = $dept->id;
            $res_item['name'] = $dept->translate($lang)->name;
            $res_item['image'] = $dept->image;
            $res_item['desc'] = $dept->translate($lang)->title;
            if ($dept->id=='1')
            {
                $res_item['count'] =Resturant::where('dept_id','1')->where('status','1')->count() ." + ".$dept->translate($lang)->name;
            }else if ($dept->id=='2'){
                $res_item['count'] =FitnessClub::where('dept_id','2')->where('status','1')->count()." + ".$dept->translate($lang)->name;
            }else if($dept->id=='3'){
                $res_item['count'] =Nutritionist::where('dept_id','3')->where('status','1')->count()." + ".$dept->translate($lang)->name;
            }else{
                $res_item['count'] =Trainer::where('dept_id','4')->where('status','1')->count()." + ".$dept->translate($lang)->name;
            }

            $res_list[] = $res_item;
        }
        $data=$res_list;



        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'alldepartments',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function showDepartmentPlans(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('department_id'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $lang=getallheaders()['Lang'];
        $getDepartmentplans=DepartmentPlan::where('dept_id',$request->department_id)->pluck('plan_id');
        $getPlans=Plan::whereIn('id',$getDepartmentplans)->get();
        $allplans = array();
        $i = 0;
        foreach ($getPlans as $departmentplans) {
            $allplans[$i] = array(
                'id'=>$departmentplans->id,
                'name' => $departmentplans->translate($lang)->name,
            );
            $i++;
        }
        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'allplans',
            'data' => isset($allplans) ? $allplans : [],
        ];
        return \Response::json($response, 200);

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
        return view('department::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('department::edit');
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
