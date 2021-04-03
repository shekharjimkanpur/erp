@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  
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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class='row'>
                    <div class='col-lg-2'>
                    <button type="button" id='add_test' class='btn btn-md btn-primary'>Add New Test</button>
                    </div>
                    <div class='col-lg-2'>
                    <button type="button" class='btn btn-md btn-primary'>Add New User</button>
                    </div>
                    <div class='col-lg-6'>
                    <button type="button" class='btn btn-md btn-primary'>Add New Client</button>
                    </div>
                    </div> 
                    <br>
                    <br>
                    
                    <h2>Testing List</h2>
                    <hr>
<div class='row'>
<div class='col-lg-12'>
                    <table id="table_id" class="display">
    <thead>
        <tr>
            
            <th>Test Id</th>
            <th>Test name</th>
            <th>Client Name</th>
            
            <th>Created on</th>
            <th>Testing status</th>
            <th>actions</th>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
            
            <td>Row 1 Data 3</td>
            
            <td>Row 1 Data 4</td>
            
            <td>Row 1 Data 5</td>
            
            <td>  
            <button type="button" id='edit_test' class='btn btn-sm btn-primary'>Edit</button>
            <!-- <button type="button" class='btn btn-sm btn-primary'>add</button> -->
            <button type="button" id='delete_test' class='btn btn-sm btn-danger'>Delete</button>
                     </td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
            
            <td>Row 2 Data 3</td>
            
            <td>Row 2 Data 4</td>
            
            <td>Row 2 Data 5</td>
            
            <td>
            
            <button type="button" class='btn btn-sm btn-primary'>Edit</button>
            <!-- <button type="button" class='btn btn-sm btn-primary'>add</button> -->
            <button type="button" class='btn btn-sm btn-danger'>Delete</button>
            </td>
        </tr>
    </tbody>
</table>

</div>
</div>
<!-- <form  action="/public/generate-pdf">
<p>&nbsp;</p>
<h5 class="text-center">Enter Details here.</h5>
<section class="container">
<div class="table table-responsive">
<table class="table table-responsive table-striped table-bordered">
<thead>
	<tr>
    	<td>Test Parameter</td>
    	<td>Observed value</td>
    	<td>Test method</td>
    </tr>
</thead>
<tbody id="TextBoxContainer">
</tbody>
<tfoot>
  <tr>
    <th colspan="5">
    <button id="btnAdd" type="button" class="btn btn-primary" data-toggle="tooltip" data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add&nbsp;</button>
     <button id="btnsub" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Submit&nbsp;</button>
    </th>
  </tr>
</tfoot>
</table>
</div>
</form> -->

</section>
                    <!-- You are logged in! -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
$(function () {
    $("#btnAdd").bind("click", function () {
        var div = $("<tr />");
        div.html(GetDynamicTextBox(""));
        $("#TextBoxContainer").append(div);
    });
    $("body").on("click", ".remove", function () {
        $(this).closest("tr").remove();
    });
});
function GetDynamicTextBox(value) {
    return '<td><input name = "DynamicTextBox1[]" type="text" value = "' + value + '" class="form-control" /></td>' + '<td><input name = "DynamicTextBox2[]" type="text" value = "' + value + '" class="form-control" /></td>'+'<td><input name = "DynamicTextBox3[]" type="text" value = "' + value + '" class="form-control" /></td>';
}


</script>  

@endsection
