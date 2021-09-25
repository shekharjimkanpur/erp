<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class DepartmentController extends Controller
{
    //
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __construct()
    {
        if(!session()->has('dept_id'))
        {
            // return route('dept_login');
            return view("dept_login");

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
