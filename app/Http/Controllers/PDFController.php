<?php
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use PDF;
  
class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(Request $request)
    {
        $array1= $request->input('DynamicTextBox1');
        $data = ['title' => 'ERP','arr1' => $array1];
        $pdf = PDF::loadView('myPDF', $data);
  
        return $pdf->download('erp.pdf');
    }
}