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
        return view('home');
    }

    public function addClient(Request $request)
    {
        $name =  $request->input('name');
        $phone =  $request->input('phone');
        $gst =  $request->input('gst');
        $email =  $request->input('email');
        $address =  $request->input('address');
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

    public function addDept(Request $request)
    {
       

        $name =  $request->input('name');
        $email =  $request->input('email');
        $pass =  $request->input('sec');
        //$users = DB::insert('select id, name from users');
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
}
