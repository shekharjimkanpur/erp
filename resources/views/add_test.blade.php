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
          <option>Red Chief</option>
          <option>Puma</option>
          <option>Adidas</option>
          <option>Versace</option>
        </select>
      </div>

      
    </div>



    <label>Select Departments</label>
    <div class="form-row">
      <div class="form-group col-md-10">
        <select class="form-control selectpicker" id=" inputdepttName" multiple>
          <option value="">Select Departments</option>
          <option>Testing Dept 1</option>
          <option>Testing Dept 2</option>
          <option>Testing Dept 3</option>
          <option>Testing Dept 4</option>
        </select>
      </div>

      <div class="form-group col-md-2">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#deptModal">Add New Department</button>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>


  

  



</div>

<script>
 
  $( document ).ready(function() {
    $.noConflict();
    $('.selectpicker').selectpicker();
    
});

</script>
@endsection