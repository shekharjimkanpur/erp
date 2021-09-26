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
        if(!session()->has('dept_id'))
        {
            return view("dept_login");
        }
        $testing_data=$this->test_method_data(Session::get('dept_id'));
        // return $testing_data;
        return view('dept',['testing_data'=>$testing_data]);
    }

    public function test_method_data($id){
        $method=DB::SELECT('SELECT a.*,c.is_done as isdone,e.test_method as test_method ,c.id as test_util_id,d.name as test_param_name FROM `erp_test_product` a left join test_dept_util c on a.id=c.test_id left join test_params d on c.test_param_id=d.id left join erp_test_method e on c.test_method_id=e.id  where c.dept_id='.$id);
        return $method;
    }

    public function get_util_details($id)
    {
    $test_details=DB::SELECT('SELECT a.id as test_util_id,a.test_method_id,b.name as test_param,c.test_method as test_method FROM `test_dept_util` a left join test_params b on a.test_param_id=b.id left join erp_test_method c on a.test_method_id=c.id WHERE a.id='.$id);
    return $test_details;
    }

    
    public function addParams(Request $request)
    {
        if(!session()->has('dept_id'))
        {
            return redirect()->route('dept');
        }
        $test_param_id=$request->input('id');
        $data=$this->get_util_details($test_param_id);
        // return $testing_data;
        return view('addParams',['data'=>$data]);
    }

    public function addParamsDB(Request $request)
    {
        if($request->input('type')=="single")
        {
            $request->validate(['util_id'=>'required',
                            'val'=>'required',
                            ]);
            
            $results = DB::insert( DB::raw("insert into obv_table(test_util_id,test_obv_value)
            values(:id,:val)"), array(
                                'id'=>$request->input('util_id'),
                                'val'=>$request->input('val')
                              ));
            if($results){
                DB::update( DB::raw("update test_dept_util set is_done=1 where id=".$request->input('util_id')));
                return "success";
            }
            else{
                return "Error";
            }
        }
        else if($request->input('type')=="multiple")
        {
            $request->validate(['util_id'=>'required',
                            'sub_param'=>'required',
                            'val'=>'required',
                            ]);
             $id=$request->input('util_id');
             $params=explode("*#sep#*",$request->input('sub_param'));
             $vals=explode("*#sep#*",$request->input('val'));
             $query='insert into obv_table (test_util_id,test_sub_param,test_obv_value) values ';  
            
             

             for ($i = 0; $i < count($params); $i++) {      
                $query=$query.'('.$id.',"'.$params[$i].'","'.$vals[$i].'"),';
             }      
             $query=rtrim($query,',');
             
             $results = DB::insert( DB::raw($query));

             if($results){
                DB::update( DB::raw("update test_dept_util set is_done=1 where id=".$request->input('util_id')));
                return "success";
            }
            else{
                return "Error";
            }      
        }
        else{
            return "Error";
        }
        
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
        
            return redirect()->route('dept');
        }
        }
        else{
        if(!session()->has('dept_id'))
        {
            return view("dept_login");
        }
        else{
            // return Session::get('dept_id');
            // $this->index();
            return redirect()->route('dept');
        }
    }
    }

}
