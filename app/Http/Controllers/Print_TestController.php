<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class Print_TestController extends Controller
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
    
    public function index(Request $request)
    {
        $test_id=$request->input('id');

        $testing_data=$this->test_product_data($test_id);
        
        for ($i=0; $i <count($testing_data) ; $i++) { 
            $product=DB::SELECT('SELECT * FROM `obv_table` where  test_util_id='.$testing_data[$i]->test_util_id);
            // foreach($product as $pd)
            // {
            $testing_data[$i]->test_param_data=$product;
            // }
        }
        // return $testing_data;
        return view('show_print',['testing_data'=>$testing_data]);
    }

    public function test_product_data($test_id){
        $product=DB::SELECT('SELECT 
        etp.test_gen_id,etp.client_id,etp.status,etp.product_name as product_name,etp.product_img_url,etp.booking_date,etp.due_date,etp.letter_ref_no,etm.test_method as test_method,etp.letter_date,etp.letter_img_url,etp.total_amt,etp.advc_amount,etp.inserted_time,ec.name as client_name,ec.address as client_address,ec.gst_no as client_gst,tdu.id as test_util_id,tdu.is_done,tp.name as param_name,tp.price
         FROM `erp_test_product` etp  left join erp_client ec on ec.id=etp.client_id left join test_dept_util tdu on tdu.test_id=etp.id left join erp_department ed on 
                ed.id=tdu.dept_id left join erp_test_method etm on etm.id=tdu.test_method_id left join test_params tp on tp.id=tdu.test_param_id
                where etp.id='.$test_id);
        return $product;
    }
}
