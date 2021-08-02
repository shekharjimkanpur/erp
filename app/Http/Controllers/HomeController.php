<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $testing_data=$this->test_method_data();
        return view('home',['testing_data'=>$testing_data]);
    }

    public function test_method_data(){
        $method=DB::SELECT('SELECT a.*,b.name,count(c.dept_id) as total_dept,sum(c.is_done) as total_done FROM `erp_test_product` a inner join erp_client b on a.client_id=b.id left join test_dept_util c on a.id=c.test_id group by a.id');
        return $method;
    }
    
    //SELECT a.*,b.name,count(c.dept_id) as total_dept,sum(c.is_done) as total_done FROM `erp_test_product` a inner join erp_client b on a.client_id=b.id left join test_dept_util c on a.id=c.test_id group by a.id


    public function addClient(Request $request)
    {
        
        $name =  $request->input('name');
        $phone =  $request->input('phone');
        $gst =  $request->input('gst');
        $email =  $request->input('email');
        $address =  $request->input('address');
        if($name!="" && $phone!="" && $gst!="" && $email!="" && $address!="" )
        {
            //$users = DB::insert('select id, name from users');
            $results = DB::insert( DB::raw("insert into erp_client(name,address,gst_no,email,number) values(:name,:address,:gst,:email,:phone)"), array(
                'name' => $name,
                'phone' => $phone,
                'gst' => $gst,
                'email' => $email,
                'address' => $address,
            ));
            if($request)       
                return "Successfully added!";
            else
                return "Error! Please try again.";
        }
        else
            return "Error! Please try again.";
    }

    public function addDept(Request $request)
    {
       

        $name =  $request->input('name');
        $email =  $request->input('email');
        $pass =  $request->input('sec');
        if($name!="" && $email!="" && $pass!="" )
        {
            $results = DB::insert( DB::raw("insert into erp_department(name,email,password) values(:name,:email,:pass)"), array(
                'name' => $name,
                'email' => $email,
                'pass' => $pass,
            ));
            if($request)       
                return "Successfully added!";
            else
                return "Error! Please try again.";
        }
        else
            return "Error! Please try again.";
    }

    public function addtestMethods(Request $request)
    {
       

        $name =  $request->input('name');

        if($name!="")
        {
            $results = DB::select( DB::raw("insert into erp_test_method(test_method) values(:name)"), array(
                'name' => $name,
            ));
            if($request)
                { 
                $id = DB::getPdo()->lastInsertId();     
                return "<option value='replaceit,".$id."'>".$name."</option>";
                }
            else
                return "Error";
        }
        else
            return "Error";
    }

    public function addtestMethodsParams(Request $request)
    {
       
        $method =  $request->input('method');
        $name =  $request->input('name');
        $price =  $request->input('price');

        if($method!="" && $name!="" && $price!="")
        {
            $results = DB::select( DB::raw("insert into erp_test_method(test_method_id,name,price) values(:test_method_id,:name,:price)"), array(
                'test_method_id' => $method,
                'name' => $name,
                'price' => $price
            ));
            if($request)
                { 
                   
                return "Done";
                }
            else
                return "Error";
        }
        else
            return "Error";
    }
    
   
    
    // public function getDepts(Request $request)
    // {
       

    //     $test =  $request->input('test');

    //     if($test!="")
    //     {
    //         $results = DB::select( DB::raw("SELECT a.id as test_id,b.id as dept_id ,b.name as dept_name,a.test_method_id as test_method_id FROM `test_dept_util` a INNER join erp_department b on a.dept_id=b.id where a.test_id=:name"), array(
    //             'name' => $test,
    //         ));
    //         $json_response = array();
    //         foreach ( $results as $row ) {
    //             $row_array = (array) $row;
    //             $ord_id = $row->test_method_id;
            
    //             $orders2 = DB::select( DB::raw("SELECT c.id as test_param_id,c.name as test_param_name,c.price as test_param_price FROM `erp_test_method` a inner join test_params c on a.id=c.test_method_id where a.id=:test_method_id"), array(
    //                 'test_method_id' => $ord_id,
    //             ));
    //             foreach ( $orders2 as $vorder2 ) {
    //                 $row_array['test_params'][] = $vorder2;
    //             }
    //             $json_response[] = $row_array;
    //         }
    //         return json_encode($json_response);
            
    //     }
    //     else
    //         return "Error";
    // }
}
