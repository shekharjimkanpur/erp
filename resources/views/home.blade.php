@extends('layouts.app')

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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class='row'>
                    <div class='col-lg-2 col-md-3'>
                    <button type="button" class='btn btn-md btn-primary' data-toggle="modal" data-target="#clientModal">Add New Client</button>

                    </div>
                    <div class='col-lg-2 col-md-3'>
                    <button type="button" class='btn btn-md btn-primary' data-toggle="modal" data-target="#deptModal">Add New Dept.</button>
                    </div>
                    <div class='col-lg-8 col-md-6'>
                    <a type="button" id='add_test' href='{{route("addtest")}}' class='btn btn-md btn-primary'>Add New Test</a>

                    </div>
                    </div> 
                    <br>
                    <br>
                    
                    <h4>Testing List</h4>
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
    @foreach ($testing_data as  $tests)
        <tr>
            <td>SHN/HSN-SAC-{{$tests->id}}</td>
            <td>{{$tests->product_name}}</td>
            
            <td>{{ $tests->name }}</td>
            
            <td>{{$tests->booking_date}}</td>
            
            <td>@if($tests->total_dept==$tests->total_done) Completed @else Pending @endif</td>
            
            <td>  
            <button type="button" id='edit_test' class='btn btn-sm btn-primary'>Edit</button>
            <!-- <button type="button" class='btn btn-sm btn-primary'>add</button> -->
            <button type="button" id='delete_test' class='btn btn-sm btn-danger'>Delete</button>
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

<!-- Modal -->
<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Client</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>

          <div class="form-group">
            <label >Name</label>
              <input type="text" class="form-control" id="inputModalClientName"  placeholder="Enter Client Name">
            </div>

            <div class="form-group">
              <label >Phone</label>
              <input type="number" class="form-control" id="inputModalClientPhone"  placeholder="Enter Phone">            
            </div>

            <div class="form-group">
            <label >GST NO.</label>
              <input type="text" class="form-control" id="inputModalClientGst"  placeholder="Enter Client GST No">
            </div>

            <div class="form-group">
              <label >Email</label>
              <input type="email" class="form-control" id="inputModalClientEmail"  placeholder="Enter Email">            
            </div>

            <div class="form-group">
            <label >Address</label>
              <input type="text" class="form-control" id="inputModalClientAddress"  placeholder="Enter Address">
            </div>
            
            <button id="btn-client-submit" type="button" class="btn btn-primary">Submit</button>
          </form>


        </div>
        
      </div>
    </div>
  </div>

  <div class="modal fade" id="deptModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Department</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>

          <div class="form-group">
            <label >Department Name</label>
              <input type="text" class="form-control" id="inputModalDeptName"  placeholder="Enter Dept. Name">
            </div>

            <div class="form-group">
              <label >Department Email</label>
              <input type="email" class="form-control" id="inputModalDeptEmail"  placeholder="Enter Email">
              
            </div>
            <div class="form-group">
            <label>Password</label>
              <input type="password" class="form-control" id="inputModalDeptPassword"  placeholder="Enter Password">
            </div>

            
            
            <button type="button" id="btn-dept-submit" class="btn btn-primary">Submit</button>
          </form>


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
<script>
  $("#inputModalClientName").change(function(){$(this).removeClass('is-invalid')});
  $("#inputModalClientPhone").change(function(){$(this).removeClass('is-invalid')});
  $("#inputModalClientGst").change(function(){$(this).removeClass('is-invalid')});
  $("#inputModalClientEmail").change(function(){$(this).removeClass('is-invalid')});
  $("#inputModalClientAddress").change(function(){$(this).removeClass('is-invalid')});
  $('#btn-client-submit').click(function(){
    var i=0;
      if($('#inputModalClientName').val()=="")
      {
        $('#inputModalClientName').addClass('is-invalid');
        i=1;
      }
      if($('#inputModalClientPhone').val()=="")
      {
        $('#inputModalClientPhone').addClass('is-invalid');
        i=1;
      }
      if($('#inputModalClientGst').val()=="")
      {
        $('#inputModalClientGst').addClass('is-invalid');
        i=1;
      }
      if($('#inputModalClientEmail').val()=="")
      {
       
        $('#inputModalClientEmail').addClass('is-invalid');
        i=1;
      }
      else{
        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
          if (!testEmail.test($('#inputModalClientEmail').val()))
          {
            $('#inputModalClientEmail').addClass('is-invalid');
          i=1;
          }

      }
       if($('#inputModalClientAddress').val()=="")
      {
        $('#inputModalClientAddress').addClass('is-invalid');
        i=1;
      }
      if(i==0)
      {
        $('.modal').modal('hide');
        $('.loader').modal('show');
            var saveData = $.ajax({
              type: 'POST',
              url: "home/addclient",
              data: {"_token": "{{ csrf_token() }}",name:$('#inputModalClientName').val(),phone:$('#inputModalClientPhone').val(),gst:$('#inputModalClientGst').val(),email:$('#inputModalClientEmail').val(),address:$('#inputModalClientAddress').val()},
              success: function(resultData) { alert(resultData);location.reload(); }
        });
        saveData.error(function() { alert("Something went wrong"); });
        $('.loader').modal('hide');
      }
  });
  </script>

  <script>
    $("#inputModalDeptName").change(function(){$(this).removeClass('is-invalid')});
  $("#inputModalDeptEmail").change(function(){$(this).removeClass('is-invalid')});
  $("#inputModalDeptPassword").change(function(){$(this).removeClass('is-invalid')});
  $('#btn-dept-submit').click(function(){
    var i=0;
      if($('#inputModalDeptName').val()=="")
      {
        $('#inputModalDeptName').addClass('is-invalid');
        i=1;
      }
      if($('#inputModalDeptEmail').val()=="")
      {
        $('#inputModalDeptEmail').addClass('is-invalid');
        i=1;
      }
      if($('#inputModalDeptPassword').val()=="")
      {
        $('#inputModalDeptPassword').addClass('is-invalid');
        i=1;
      }
      
      
      if(i==0)
      {
        $('.modal').modal('hide');
        $('.loader').modal('show');
            var saveData = $.ajax({
              type: 'POST',
              url: "home/adddept",
              data: {"_token": "{{ csrf_token() }}",name:$('#inputModalDeptName').val(),email:$('#inputModalDeptEmail').val(),sec:$('#inputModalDeptPassword').val()},
              success: function(resultData) { alert(resultData); location.reload(); }
        });
        saveData.error(function() { alert("Something went wrong"); });
        $('.loader').modal('hide');
      }
  });
    </script>
@endsection
