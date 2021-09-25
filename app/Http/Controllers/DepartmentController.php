<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class DepartmentController extends Controller
{
    public function __construct()
    {
        if(!session()->has('dept_id'))
        {
            // return route('dept_login');
            return view("dept_login");

        }
    }
    
    public function index()
    {
        $testing_data=$this->test_method_data();
        return view('dept',['testing_data'=>$testing_data]);
    }

    public function test_method_data(){
        $method=DB::SELECT('SELECT a.*,c.is_done as isdone,e.test_method as test_method ,d.id as test_param_id,d.name as test_param_name FROM `erp_test_product` a left join test_dept_util c on a.id=c.test_id left join test_params d on c.test_param_id=d.id left join erp_test_method e on c.test_method_id=e.id  where c.dept_id=1');
        return $method;
    }

    
    
    

    public function get_dept_login($id,$pass)
    {
    $result = DB::select("SELECT * FROM `erp_department` where email='".$id."' and password='".$pass."'");
    return $result;

    }

    public function login(Request $request){
        if ($request->isMethod('post')) {    
        $result=$this->get_dept_login($request->input('id'),$request->input('pass'));
        // return $result;
        if(count($result)>0)
        {
            // Session::set('dept_id', $result->id);
            Session::put('dept_id', $result[0]->id);
            return view("dept", ["dept_id"=>Session::get('dept_id')]);
        }
        }
        else{
        if(!session()->has('dept_id'))
        {
            return view("dept_login");
        }
        else{
            return view("dept", ["dept_id"=>Session::get('dept_id')]);
        }
    }
    }

}
