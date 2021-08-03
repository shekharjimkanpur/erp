<?php

namespace App\Http\Controllers;
use App\Models\Image;
use Illuminate\Http\Request;
use DB;

class add_test extends Controller
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
        $method=$this->test_method();
        $test_dept=$this->test_dept();
        $client=$this->test_client();
        return view("add_test", ["method"=>$method,'dept'=>$test_dept,'client'=>$client]);
    }
    public function test_method(){
        $method=DB::SELECT('SELECT * FROM `erp_test_method`');
        return $method; 
    }
    public function test_dept(){
        $method=DB::SELECT('SELECT * FROM `erp_department`');
        return $method; 
    }
    public function test_client(){
        $client=DB::SELECT('SELECT * FROM `erp_client`');
        return $client; 
    }

    public function add_newtest(Request $request)
    {
       
        $request->validate([ 'letter_img' => 'required|image|mimes:jpeg,png,jpg,pdf',
                            'product_image' => 'required|image|mimes:jpeg,png,jpg,pdf',
                            'product_name'=>'required',
                            'booking_date'=>'required',
                            'due_date'=>'required',
                            'letter_date'=>'required',
                            'letter_ref_no'=>'required',
                            'advc_amt'=>'required',
                            'total_amt'=>'required',
                            'inputClientName'=>'required',
                            ]);
                        

        
        $product_name =  $request->input('product_name');
        $inputClientName=$request->input('inputClientName');
        
        
        // $product_image =  $request->input('product_image');
        $booking_date =  $request->input('booking_date');
        $due_date =  $request->input('due_date');
        $letter_date =  $request->input('letter_date');
        // $letter_img =  $request->input('letter_img');
        $letter_ref_no =  $request->input('letter_ref_no');
        $advc_amt =  $request->input('advc_amt');
        $total_amt =  $request->input('total_amt');
        $inputdepttName =  $request->input('inputdepttName');
        $letter_img = $request->file('letter_img');
        //you also need to keep file extension as well
        $name_full = 'letter_'.$product_name.'_'.$this->generateRandomString().'.'.$letter_img->getClientOriginalExtension();
        //$name= 'letter_'.$this->generateRandomString();
        
        
        // $image = new Image;
        // $path = $letter_img->storeAs(public_path().'/uploads', $name, 'public');  
        $letter_img->move('uploads',$name_full);
        
        // $image->name = $name;
        // $image->path = '/uploads/'.$path;
        // $image->save();
        $letter_img_url=$name_full;
        //producct image 
        $product_image = $request->file('product_image');

        $name_full = 'product_'.$product_name.'_'.$this->generateRandomString().'.'.$product_image->getClientOriginalExtension();
        //$name= 'product_'.$product_name.'_'.$this->generateRandomString();
        // $image = new Image;
        $product_image->move('uploads',$name_full);
        // $path = $product_image->storeAs(public_path().'/uploads', $name, 'public');  
        // $image->name = $name;
        // $image->path = '/uploads/'.$path;
        $product_image=$name_full;

        //$users = DB::insert('select id, name from users');


        $results = DB::insert( DB::raw("insert into erp_test_product(client_id,product_name,product_img_url,
        booking_date,due_date,letter_ref_no,letter_date,letter_img_url,total_amt,advc_amount) 
        values(:client_id,:product_name,:product_img_url,:booking_date,:due_date,:letter_ref_no,:letter_date,
        :letter_img_url,:total_amt,:advc_amount)"), array(
            'client_id'=>$inputClientName,
            'product_name'=>$product_name,
            'product_img_url'=>$product_image,
            'booking_date'=>$booking_date,
            'due_date'=>$due_date,
            'letter_ref_no'=>$letter_ref_no,
            'letter_date'=>$letter_date,
            'letter_img_url'=>$letter_img_url,
            'total_amt'=>$total_amt, 
            'advc_amount'=>$advc_amt
          ));
        if($request)       
        {
            $id = DB::getPdo()->lastInsertId();
            $query='insert into test_dept_util (test_id,dept_id,test_method_id,test_param_id) values ';    
            for ($i = 0; $i < count($request->input('test_method_params_select')); $i++) {

                $arr= explode(',',$request->input('test_method_params_select')[$i]);
                $dept=$arr[0];
                $test_method=$arr[1];
                $test_param=$arr[2];
                $query=$query.'('.$id.','.$dept.','.$test_method.','.$test_param.'),';
              }
              $query=rtrim($query,',');
              $results = DB::insert( DB::raw($query));
            return "Successfully added!";     
        }
            else
            return "Error! Please try again.";
    }


    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getTestParams(Request $request)
    {
    $test =  $request->input('test');

        if($test!="")
        {
            
                $result = DB::select("SELECT c.id as test_param_id,c.name as test_param_name,c.price as test_param_price FROM `erp_test_method` a inner join test_params c on a.id=c.test_method_id where a.id=:test_method_id", array(
                    'test_method_id' => $test,
                ));
                return $result;
            
        }
        else
        {
            return "Error";
        }
    }


public function edit_test(Request $request)
{
    $test_details=$this->test_details($request->input('id'));
    // print_r($test_details);
    $method=$this->test_method();
    $test_dept=$this->test_dept();
    $client=$this->test_client();
    
    $test_det=json_encode($test_details,true);
    
    $test_det=json_decode($test_det,true);
    
    $test_params=array();
    for($i=0;$i<sizeof($test_det);$i++)
    {
    $test_param=$this->test_params($test_det[$i]['test_method_id']);
    array_push($test_params,$test_param);
    }

    // print_r()
    $dept_names='';
    $departments=array();
    
    for($i=0;$i<sizeof($test_det);$i++){
    $dept_names=$dept_names.','.$test_det[$i]['dept_name'];
    array_push($departments,$test_det[$i]['dept_name']);
    }

    // $dept=implode(',',json_decode($test_details[0]['dept_name'],true));
    // return $test_det[0]['dept_name'];
    return view("edit_test", ["test_details"=>$test_details,"method"=>$method,'dept'=>$test_dept,'client'=>$client,'dept_names'=>$dept_names,'departments'=>$departments,'test_params'=>$test_params]);
    // return view("add_test", ["test_details"=>$test_details]);
}

public function test_params($id)
{

    $result = DB::select("SELECT c.id as test_param_id ,c.name as test_param_name,c.price as test_param_price FROM `erp_test_method` a inner join test_params c on a.id=c.test_method_id where a.id=:test_method_id", array(
        'test_method_id' => $id,
    ));
    return $result;

}
public function test_details($id)
{
    $test_details=DB::SELECT('SELECT a.id as product_id,a.client_id,a.status,a.product_name,a.product_img_url,a.booking_date,a.due_date,a.letter_ref_no,a.letter_date,a.letter_img_url as letter_img,a.total_amt,a.advc_amount,b.name as client_name,c.test_id,c.dept_id,c.test_method_id,GROUP_CONCAT(c.test_param_id) as test_param_id,d.name as dept_name FROM `erp_test_product` a inner join `erp_client` b on a.client_id=b.id inner join test_dept_util c on c.test_id=a.id inner join erp_department d on d.id=c.dept_id where  a.id='.$id.' GROUP by test_method_id ');
    return $test_details;
}


public function update_test(Request $request)
{
   
    $request->validate([ 'letter_img' => 'required|image|mimes:jpeg,png,jpg,pdf',
                        'product_image' => 'required|image|mimes:jpeg,png,jpg,pdf',
                        'product_name'=>'required',
                        'booking_date'=>'required',
                        'due_date'=>'required',
                        'letter_date'=>'required',
                        'letter_ref_no'=>'required',
                        'advc_amt'=>'required',
                        'total_amt'=>'required',
                        'inputClientName'=>'required',
                        ]);
                    

    $test_product_id=$request->input('test_id');
    $product_name =  $request->input('product_name');
    $inputClientName=$request->input('inputClientName');
    
    
    // $product_image =  $request->input('product_image');
    $booking_date =  $request->input('booking_date');
    $due_date =  $request->input('due_date');
    $letter_date =  $request->input('letter_date');
    // $letter_img =  $request->input('letter_img');
    $letter_ref_no =  $request->input('letter_ref_no');
    $advc_amt =  $request->input('advc_amt');
    $total_amt =  $request->input('total_amt');
    $inputdepttName =  $request->input('inputdepttName');
    $letter_img = $request->file('letter_img');
    //you also need to keep file extension as well
    $name_full = 'letter_'.$product_name.'_'.$this->generateRandomString().'.'.$letter_img->getClientOriginalExtension();
    //$name= 'letter_'.$this->generateRandomString();
    
    
    // $image = new Image;
    // $path = $letter_img->storeAs(public_path().'/uploads', $name, 'public');  
    $letter_img->move('uploads',$name_full);
    
    // $image->name = $name;
    // $image->path = '/uploads/'.$path;
    // $image->save();
    $letter_img_url=$name_full;
    //producct image 
    $product_image = $request->file('product_image');

    $name_full = 'product_'.$product_name.'_'.$this->generateRandomString().'.'.$product_image->getClientOriginalExtension();
    //$name= 'product_'.$product_name.'_'.$this->generateRandomString();
    // $image = new Image;
    $product_image->move('uploads',$name_full);
    // $path = $product_image->storeAs(public_path().'/uploads', $name, 'public');  
    // $image->name = $name;
    // $image->path = '/uploads/'.$path;
    $product_image=$name_full;

    //$users = DB::insert('select id, name from users');


    $results = DB::statement( DB::raw("update erp_test_product set (client_id=:client_id,
    product_name=:product_name,product_img_url=:product_img_url,
    booking_date=:booking_date,due_date=:due_date,letter_ref_no=:letter_ref_no
    ,letter_date=:letter_date,letter_img_url=:letter_img_url,total_amt=:total_amt,advc_amount=:advc_amount)
     where id=:test_product_id 
 "), array(
        'client_id'=>$inputClientName,
        'product_name'=>$product_name,
        'product_img_url'=>$product_image,
        'booking_date'=>$booking_date,
        'due_date'=>$due_date,
        'letter_ref_no'=>$letter_ref_no,
        'letter_date'=>$letter_date,
        'letter_img_url'=>$letter_img_url,
        'total_amt'=>$total_amt, 
        'advc_amount'=>$advc_amt,
        'test_product_id'=>$test_product_id
      ));

      $test_util_id = DB::select("SELECT id FROM test_dept_util where test_id=:test_method_id", array(
        'test_method_id' => $test_product_id,
    ));
    if($request)       
    {
        $id = $test_product_id;
        $query='insert into test_dept_util (id, test_id,dept_id,test_method_id,test_param_id) values ';    
        for ($i = 0; $i < count($request->input('test_method_params_select')); $i++) {


            $arr= explode(',',$request->input('test_method_params_select')[$i]);
            $dept=$arr[0];
            $test_method=$arr[1];
            $test_param=$arr[2];
            $query=$query.'('.$test_util_id[$i].','.$id.','.$dept.','.$test_method.','.$test_param.'),';
          }

          $query=rtrim($query,',');
          $query=$query.' ON DUPLICATE KEY UPDATE test_id=VALUES(test_id),dept_id=VALUES(dept_id)
          ,test_method_id=VALUES(test_method_id),test_param_id=VALUES(test_param_id)';

          $results = DB::insert( DB::raw($query));
        return "Successfully added!";     
    }
        else
        return "Error! Please try again.";
}


}
