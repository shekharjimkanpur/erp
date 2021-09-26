@extends('layouts.dept_app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  <style>
  body{
      background-color:#F1F1F1 !important;
  }
  </style>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
$(document).ready( function () {
    $.noConflict();
    $('#table_id').DataTable();
} );
</script>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <!-- <div class="card-header">Testing List</div> -->

                <div class="card-body">
                    
                
                    
                    <h4>Testing List</h4>
                    <hr>
<div class='row'>
<div class='col-lg-12'>
                    <table id="table_id" class="display">
    <thead>
        <tr>
            
            <th>Test Id</th>
            
            <th>Test Parameter Name</th>
            
            <th>Created on</th>
            <th>Testing status</th>
            <th>actions</th>

        </tr>
    </thead>
    <tbody>
    @foreach ($testing_data as  $tests)
        <tr>
            <td>{{$tests->test_gen_id}}</td>
            <td>{{$tests->test_param_name}}</td>
            
            
            <td>{{$tests->booking_date}}</td>
            
            <td>@if($tests->isdone=='1') Completed @else Pending @endif</td>
            
            <td>  
            <a type="button" id='edit_test' href='edit_test?id={{ $tests->id }}'  class='btn btn-sm btn-primary'>Add Params</a>
            <!-- <button type="button" class='btn btn-sm btn-primary'>add</button> -->
            <!-- <button type="button" id='delete_test' class='btn btn-sm btn-danger'>Delete</button> -->
                     </td>
        </tr>
        @endforeach
      </tbody>
</table>

</div>
</div>


</section>
                </div>
            </div>
        </div>
    </div>
</div>

 

   
@endsection
