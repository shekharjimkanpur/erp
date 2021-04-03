@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"><div class="container">
  <h2>Add Test</h2>

  <br>
  <form>
    <div class="form-group">
      <label for="inputProductName">Product Name</label>
      <input type="text" class="form-control" id="inputProductName" placeholder="Enter product name">

    </div>
    <label for="inputClientName">Select Client</label>
    <div class="form-row">
      <div class="form-group col-md-10">
        <select class="form-control  id=" inputClientName">
          <option value="">Select Client</option>
          <option>abc</option>
          <option>def</option>
          <option>ghi</option>
          <option>jkl</option>
        </select>
      </div>

      <div class="form-group col-md-2">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#clientModal">Add New Client</button>
      </div>
    </div>



    <label>Select Departments</label>
    <div class="form-row">
      <div class="form-group col-md-10">
        <select class="form-control selectpicker" id=" inputdepttName" multiple>
          <option value="">Select Departments</option>
          <option>abc</option>
          <option>def</option>
          <option>ghi</option>
          <option>jkl</option>
        </select>
      </div>

      <div class="form-group col-md-2">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#deptModal">Add New Department</button>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>


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
            <label >Client Name</label>
              <input type="text" class="form-control" id="inputModalClientName"  placeholder="Enter Client Name">
            </div>

            <div class="form-group">
            <label >Client GST NO.</label>
              <input type="text" class="form-control" id="inputModalClientGst"  placeholder="Enter Client GST No">
            </div>

            <div class="form-group">
              <label >Client Email</label>
              <input type="email" class="form-control" id="inputModalClientEmail"  placeholder="Enter Email">
              
            </div>
            <div class="form-group">
            <label >Client Address</label>
              <input type="text" class="form-control" id="inputModalClientAddress"  placeholder="Enter Address">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
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
              <input type="text" class="form-control" id="inputModalDeptName"  placeholder="Enter Client Name">
            </div>

            <div class="form-group">
              <label >Department Email</label>
              <input type="email" class="form-control" id="inputModalDeptEmail"  placeholder="Enter Email">
              
            </div>
            <div class="form-group">
            <label>Password</label>
              <input type="text" class="form-control" id="inputModalDeptPassword"  placeholder="Enter Password">
            </div>

            
            
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>


        </div>
        
      </div>
    </div>
  </div>



</div>

<script>
 
  $( document ).ready(function() {
    $.noConflict();
    $('.selectpicker').selectpicker();
    
});

</script>
@endsection