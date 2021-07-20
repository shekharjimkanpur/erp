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
        $method=DB::SELECT('SELECT a.*,b.name FROM `erp_test_product` a inner join erp_client b on a.client_id=b.id');
        return $method;
    }

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
            $results = DB::insert( DB::raw("insert into erp_test_method(test_method) values(:name)"), array(
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
}
