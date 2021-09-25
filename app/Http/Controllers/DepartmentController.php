<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DepartmentController extends Controller
{
    public function index()
    {
        $testing_data=$this->test_method_data();
        return view('dept',['testing_data'=>$testing_data]);
    }

    public function test_method_data(){
        $method=DB::SELECT('SELECT a.*,c.is_done as isdone,e.test_method as test_method ,d.id as test_param_id,d.name as test_param_name FROM `erp_test_product` a left join test_dept_util c on a.id=c.test_id left join test_params d on c.test_param_id=d.id left join erp_test_method e on c.test_method_id=e.id  where c.dept_id=1');
        return $method;
    }
}
