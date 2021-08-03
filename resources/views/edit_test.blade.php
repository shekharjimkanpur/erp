@extends('layouts.app')

@section('content')
<style>
  .bootstrap-select>.dropdown-toggle{
    border:1px solid #ced4da;
    background:white;
  }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"><div class="container">
  <h2>Edit Test</h2>
  <!-- id	client_id	product_name	product_img_url	booking_date	due_date	letter_ref_no
  	letter_date	letter_img_url	total_amt	advc_amount -->

  <br>
  <form id="mainForm">
  <!--  -->
  {{ csrf_field() }}
  <div class='row'>
    <div class='col-md-12'>
  <label for="inputClientName">Select Client</label>
    <div class="form-row">
      <div class="form-group col-md-12">
        <select class="form-control" name='inputClientName' id="inputClientName">
          <option value="">Select Client</option>
          @foreach ($client as  $c)
          <option value="{{$c->id}}" @if($test_details[0]->client_name==$c->name) {{ 'selected' }}  @endif > {{$c->name}} </option>
          @endforeach
        </select>
        </div>
        </div>
        </div>
</div>

    <div class='row'>
    <div class='col-md-5'>

    <div class="form-group">
      <label for="inputProductName">Product Name:</label>
      <input type="text" class="form-control" id="product_name" value='{{$test_details[0]->product_name}}' name='product_name' placeholder="Enter product name">
    </div>
    </div>
    <div class='col-md-5'>
    <div class="form-group">
      <label for="formFileLg" class="form-label">Upload Product Image:</label>
      <input class="form-control form-control-md"  value='{{$test_details[0]->product_img_url}}' id="product_image" name='product_image' type="file" onchange="if(this.files[0]!=null){document.getElementById('previewProduct').src = window.URL.createObjectURL(this.files[0])} else{ $('#previewProduct').attr('src', '') }" />
    </div>
    </div>
    <div class='col-md-2'>
    <img id="previewProduct" src="{{ 'uploads/'.$test_details[0]->product_img_url }}" alt="" width="100" height="100">


    </div>
    </div>

    <div class='row'>
<div class='col-md-6'>

    <div class="form-group">
<label>Booking Date: </label>
    <div class="input-group date" data-date-format="mm-dd-yyyy">
      <input class="form-control" id='booking_date'  value='{{$test_details[0]->booking_date}}' name='booking_date' type="date"  />
    </div>
    </div>
    </div>

<div class='col-md-6'>

<div class="form-group"> 
<label>Due Date: </label>
    <div  class="input-group date" data-date-format="mm-dd-yyyy">
      <input class="form-control" id='due_date'  value='{{$test_details[0]->due_date}}' name='due_date' type="date"  />
    </div>
</div>
</div>
    </div>

    <div class='row'>
<div class='col-md-6'>

    <div class="form-group"> 
<label>Letter Reference Number: </label>
    <div  class="input-group date" data-date-format="mm-dd-yyyy">
      <input class="form-control" id='letter_ref_no' name='letter_ref_no'  value='{{$test_details[0]->letter_ref_no}}' type="text"  />
    </div>
    </div>
    </div>
<div class='col-md-6'>

<div class="form-group"> 
<label>Letter Date: </label>
    <div  class="input-group date" data-date-format="mm-dd-yyyy">
      <input class="form-control" id='letter_date' name='letter_date' value='{{$test_details[0]->letter_date}}' type="date"  />
    </div>
</div>
</div>
    </div>

    <div class='row'>
    <div class='col-md-10'>
<div class="form-group">
      <label for="formFileLg" class="form-label">Upload Letter Image:</label>
      <input class="form-control form-control-md" id="letter_img" name='letter_img_url' value='{{$test_details[0]->letter_img_url}}' type="file" onchange="if(this.files[0]!=null){document.getElementById('previewLetter').src = window.URL.createObjectURL(this.files[0])} else { $('#previewLetter').attr('src', '') }" />
      </div>
      </div>
      <div class='col-md-2'>
    <img id="previewLetter" src="{{ 'uploads/'.$test_details[0]->letter_img_url }}" alt="" with="100" height="100">
</div>
      
</div>
    
      <div class='row'>  
<div class='col-md-6'>

<div class="form-group">
      <label for="formFileLg" class="form-label">Total Amount:</label>
      <input class="form-control form-control-md" id="total_amt" name='total_amt' value='{{$test_details[0]->total_amt}}' type="number"  readonly="readonly"/>
</div>

</div>
    
<div class='col-md-6'>
<div class="form-group">
      <label for="formFileLg" class="form-label">Advance Amount: </label>
      <input class="form-control form-control-md" id="advc_amt" name='advc_amt' value='{{$test_details[0]->advc_amount}}' type="number" />
</div>
</div>
</div>

<div class='row'>
      <div class='col-md-6'>
    <label>Select Departments:</label>
    <div class="form-row">
      <div class="form-group col-md-12">
        <select class="form-control selectpicker" style='border:1px solid grey;' name='inputdepttName[]'  id="inputdepttName" multiple>
          <option  disabled>Select Departments</option>
          @foreach ($dept as  $d)
          <option value="{{$d->id}},{{$d->name}}" @if(strpos($dept_names,$d->name)) {{ 'selected' }} @endif > {{$d->name}} </option>
          @endforeach          

          <!-- <option value="2,Testing Dept 2">Testing Dept 2</option>
          <option value="3,Testing Dept 3">Testing Dept 3</option>
          <option value="4,Testing Dept 4">Testing Dept 4</option> -->
        </select>
      </div>
      </div>
      </div>
      <div class='col-md-3'>
      <div class="form-group">
            <br/>
            <button type="button " class='btn btn-md btn-warning' style="width:100%" id="open_testmethod_modal" data-toggle="modal" data-target="#testMethodModal">Add New Test Method</button>
      </div>
      </div>
      <div class='col-md-3'>
      <div class="form-group">
            <br/>
          <button type="button" class='btn btn-md btn-success' style="width:100%" id="open_testmethod_params_modal" data-toggle="modal" data-target="#testMethodParamsModal">Add New Test Parameter</button>
      </div>
      </div>
<div id='test_method' class='col-md-12'>
<?php
 $i=0;
 ?>

@foreach($departments as $department)
<div class='row' style='padding-bottom:10px;'>
<div class='col-md-2'>{{ $department }} :</div>
<div class='col-md-3'>
  <select class='form-control test_method_select' name='test_method_select[]' onchange='change_func(this);'  >
  <option value=''>Select Test Method</option>

  @foreach ($method as  $c)
            <option value="{{$c->id}}" @if($test_details[$i]->test_method_id==$c->id ) {{ 'selected' }} @endif > {{$c->test_method}} </option>
            @endforeach
           
</select>
</div>
<div class='col-md-3'>
  <select class='form-control test_method_param_select selectpicker' onchange='change_func_params(this);' title='Select Test Parameter' name='test_method_params_select[]'  multiple>
<?php 
$params=$test_params[$i];
foreach($params as $param)
{
?>
<option value=" {{ $test_details[$i]->dept_id }},{{ $test_details[$i]->test_method_id }},{{ $param->test_param_id }} " @foreach(explode(',',$test_details[$i]->test_param_id) as $param_id )  @if($param_id == $param->test_param_id ) {{ 'selected' }} @endif @endforeach > {{ $param->test_param_name }}/ {{ $param->test_param_price }} </option>
<?php
}
?>

{{ $i++ }}
</select>
</div></div>
@endforeach
</div>
      </div>  
        <button type="button" id="mainFormSubmit" class="btn btn-primary">Submit</button>
 </form>
</div>

<div class="modal fade" id="testMethodModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Test Standard</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>

          <div class="form-group">
            <label >Test Standard Name</label>
              <input type="text" class="form-control" id="inputModalTestMethodsName"  placeholder="Enter New Test Standard">
            </div>

            <button type="button" id="btn-testMethods-submit" class="btn btn-primary">Submit</button>
          </form>


        </div>
        
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="testMethodParamsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Test Parameter</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>

          <div class="form-group">
            <select class="form-control" name='inputTestParamTest' id="inputTestParamTest">
            <option value="">Select Test Method</option>
            @foreach ($method as  $c)
            <option value="{{$c->id}}"> {{$c->test_method}} </option>
            @endforeach
          </select>
            <br>
            <label >Test Parameter Name</label>
              <input type="text" class="form-control" id="inputModalTestMethodsParamsName"  placeholder="Enter Test Parameter Name">
            </div>
            <label >Test Parameter Price</label>
              <input type="number" class="form-control" id="inputModalTestMethodsParamsPrice"  placeholder="Enter Test Parameter Price">
            </div>

            <button type="button" id="btn-testMethodsParams-submit" class="btn btn-primary">Submit</button>
          </form>
          

        </div>
        
      </div>
    </div>
  </div>

<script>

  var NewlyAddedMethods="";
  function generate_test_method(id)
  {
   
    var method="@foreach ($method as  $m)  <option value='replaceit,{{$m->id}}'> {{$m->test_method}} </option> @endforeach";
    var method=method+NewlyAddedMethods;
    return method.replaceAll('replaceit',id); 
  }

  $( document ).ready(function() {
    $.noConflict();
    $('.selectpicker').selectpicker();
  });

$('#inputdepttName').change(function(){
     ChangeDept();
});

function ChangeDept()
{
  $('#total_amt').val("0");
  a=$("#inputdepttName").val();
      dropotp='';
      if(a!=null)
      {
      a.forEach(function(b){
        
        c=b.split(',');
        var abc=generate_test_method(c[0]);

        dropotp+="<div class='row' style='padding-bottom:10px;'><div class='col-md-2'>"+c[1]+":</div><div class='col-md-3'><select class='form-control test_method_select' name='test_method_select[]' onchange='change_func(this);'  ><option value=''>Select Test Standard</option>"+abc+"</select></div><div class='col-md-3'><select class='form-control test_method_param_select selectpicker' onchange='change_func_params(this);' title='Select Test Parameter' name='test_method_params_select[]'  multiple></select></div></div>";

      });
            
    }
      $('#test_method').html(dropotp);
      $(' .selectpicker').selectpicker('refresh');
      
}

$("#product_name").change(function(){$(this).removeClass('is-invalid')});
  $("#letter_img").change(function(){$(this).removeClass('is-invalid')});
  $("#product_image").change(function(){$(this).removeClass('is-invalid')});

  $("#booking_date").change(function(){$(this).removeClass('is-invalid')});
  $("#due_date").change(function(){$(this).removeClass('is-invalid')});
  $("#letter_date").change(function(){$(this).removeClass('is-invalid')});

  $("#advc_amt").change(function(){$(this).removeClass('is-invalid')});
  $("#letter_ref_no").change(function(){$(this).removeClass('is-invalid')});
  $("#total_amt").change(function(){$(this).removeClass('is-invalid')});

  $("#inputClientName").change(function(){$(this).removeClass('is-invalid')});
  $("#inputdepttName").change(function(){$(this).parent().removeClass('is-invalid')}); 
  
  function check_total_amt()
  {
   
    var total_amt=0;
    $("[name^=test_method_params_select]").each(function () {
                  if($(this).val()!=null)
                  {
                    var option_all = $(this).find("option:selected").map(function () {
                      return $(this).text();
                     }).get().join(',');
                    var arrs=option_all.split(',')
                    for(var arr of arrs)
                      {
                        var amt = parseFloat(arr.split("₹").pop());
                        total_amt=total_amt+amt; 
                      }
                      
                   
                  }
                  });
   $('#total_amt').removeClass('is-invalid')
   $('#total_amt').val(total_amt);
  }


  function change_func_params(data)
{
  if($(data).val()!=''){
    $(data).parent().removeClass('is-invalid');
  } 
   check_total_amt();
} 
function change_func(data)
{
  if($(data).val()!=''){
    $(data).removeClass('is-invalid');
    $('.loader').modal('show');
          var ids=$(data).val().split(',');
          var saveData = $.ajax({
                type: 'GET',
                url: "addtest/getTestParams",
                data: {test:ids[1]},
                success: function(resultData) {
                  if(resultData=="Error")
                    location.reload();
                  var options="";
                    if($.trim(resultData))
                    {
                      debugger;
                    

                      // var html="<h5>Department List</h5><br>";
                      
                      for(var arr of resultData)
                      {
                          
                          
                        options=options+"<option value='"+ids[0]+","+ids[1]+","+arr['test_param_id']+"'>"+arr['test_param_name']+" / ₹"+arr['test_param_price']+"</option>"
                      }
                   
                    }
                    
                    $(data).parents().eq(1).find('.test_method_param_select .selectpicker').html(options);
                    $('.selectpicker').selectpicker('refresh')
                    $('.loader').modal('hide');
                  }
          });
          saveData.error(function() { swal("Something went wrong"); $('.loader').modal('hide');  });
          $('.loader').modal('hide');
  }
}

$('#mainFormSubmit').click(function() {
      var i=0;

    
  
    if($('#product_name').val()==""){ $('#product_name').addClass('is-invalid'); i=1; }
    if($('#letter_img').val()==""){
       $('#letter_img').addClass('is-invalid'); i=1;
        }
        else{
          var ext = $('#letter_img').val().split('.').pop().toLowerCase();
                    if($.inArray(ext, ['pdf','png','jpg','jpeg']) == -1) {
                        swal('Invalid file in letter image!');
                        $('#letter_img').addClass('is-invalid'); i=1;
                    }
        }
    if($('#product_image').val()==""){
       $('#product_image').addClass('is-invalid');
        i=1;
         }
         else{
          var ext = $('#product_image').val().split('.').pop().toLowerCase();
                    if($.inArray(ext, ['pdf','png','jpg','jpeg']) == -1) {
                        swal('Invalid file in product image!');
                        $('#product_image').addClass('is-invalid'); i=1;
                    }
        }
    if($('#booking_date').val()==""){ $('#booking_date').addClass('is-invalid'); i=1; }
    if($('#due_date').val()==""){ $('#due_date').addClass('is-invalid'); i=1; }
    if($('#letter_date').val()==""){ $('#letter_date').addClass('is-invalid'); i=1; }
    if($('#advc_amt').val()==""){ $('#advc_amt').addClass('is-invalid'); i=1; }
    if($('#letter_ref_no').val()==""){ $('#letter_ref_no').addClass('is-invalid'); i=1; }
    if($('#total_amt').val()=="" || $('#total_amt').val()=="0"){ $('#total_amt').addClass('is-invalid'); i=1; }
    if($('#inputClientName').val()==""){ $('#inputClientName').addClass('is-invalid'); i=1; }
    if($('#inputdepttName').val()==null){ $('#inputdepttName').parent().addClass('is-invalid'); i=1; }
    $("[name^=test_method_select]").each(function () {
                  if($(this).val()=="")
                  {
                    $(this).addClass('is-invalid');
                    i=1;
                  }
                  });
                  $("[name^=test_method_params_select]").each(function () {
                  if($(this).val()==null)
                  {
                    $(this).parent().addClass('is-invalid');
                    i=1;
                  }
                  });



    if(i==0)
    {
      
      $('.loader').modal('show');
      var formData = new FormData(document.getElementById("mainForm"));
    $.ajax({
        url: 'submit_test',
        type: 'POST',              
        data:formData,
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        // cache : false,
        contentType:false,
    processData: false,
        success: function(result)
        {
            // location.reload();
            
            
        $('.loader').modal('hide');
        swal(result);
            location.reload();
        },
        error: function(data)
        {
          swal("Something went wrong! Please refresh and try again.");

            console.log(data);
        }
    });
    }

    // $.ajax({
    //           type: 'POST',
    //           url: "/submit_test",
    //           data: {'product_name':$('product_name').val(),'product_image':$('#product_image').val(),'booking_date':$('#booking_date').val(),'due_date':$('#due_date').val(),'letter_ref_no':$('#letter_ref_no').val(),'letter_date':$('#letter_date').val(),'letter_img':$('#letter_img').val(),'total_amt':$('#total_amt').val(),'advc_amt':$('#advc_amt').val(),'inputdepttName':$('#inputdepttName')},
    //           success: function(resultData) { alert(resultData) }
    //     });


});




</script>

<script>
  
  $("#inputModalTestMethodsName").change(function(){$(this).removeClass('is-invalid')});
  $('#btn-testMethods-submit').click(function(){
    var i=0;
      
      if($('#inputModalTestMethodsName').val()=="")
      {
       
        $('#inputModalTestMethodsName').addClass('is-invalid');
        i=1;
      }
      
      if(i==0)
      {
        $('#open_testmethod_modal').click();
        $('.loader').modal('show');
            var saveData = $.ajax({
              type: 'POST',
              url: "home/addtestMethods",
              data: {"_token": "{{ csrf_token() }}",name:$('#inputModalTestMethodsName').val()},
              success: function(resultData) {
                if(resultData=="Error")
                    location.reload();
                
                NewlyAddedMethods+=resultData;
                $("#inputTestParamTest").append(resultData.replaceAll('replaceit,',""));

                ChangeDept();
                swal("Successfully Added!");
                $('#inputModalTestMethodsName').val("");
                $('.loader').modal('hide');
                 }
        });
        saveData.error(function() { swal(result);("Something went wrong");location.reload(); });
        $('.loader').modal('hide');
      }
  });
  </script>
   <script>
    $("#inputTestParamTest").change(function(){$(this).removeClass('is-invalid')});
  $("#inputModalTestMethodsParamsName").change(function(){$(this).removeClass('is-invalid')});
  $("#inputModalTestMethodsParamsPrice").change(function(){$(this).removeClass('is-invalid')});
    $('#btn-testMethodsParams-submit').click(function(){
      debugger;
      var j=0;
      if($('#inputTestParamTest').val()=="")
      {
        j=1;
        $('#inputTestParamTest').addClass('is-invalid');
      }
      if($('#inputModalTestMethodsParamsName').val()=="")
      {
        j=1;
        $('#inputModalTestMethodsParamsName').addClass('is-invalid');
      }
      if($('#inputModalTestMethodsParamsPrice').val()=="")
      {
        j=1;
        $('#inputModalTestMethodsParamsPrice').addClass('is-invalid');
      }
      if(j==0)
      {
        $('#open_testmethod_params_modal').click();
        $('.loader').modal('show');
            var saveData = $.ajax({
              type: 'POST',
              url: "home/addtestMethodsParams",
              data: {"_token": "{{ csrf_token() }}",method:$('#inputTestParamTest').val(),name:$('#inputModalTestMethodsParamsName').val(),price:$('#inputModalTestMethodsParamsPrice').val()},
              success: function(resultData) {
                if(resultData=="Error")
                    location.reload();
                ChangeDept();
                swal("Successfully Added!");
                $('#inputTestParamTest').val("");
                $('#inputModalTestMethodsParamsName').val("");
                $('#inputModalTestMethodsParamsPrice').val("");
                
                $('.loader').modal('hide');
                 }
        });
        saveData.error(function() { swal("Something went wrong");location.reload(); });
        $('.loader').modal('hide');
      }
    });
  </script>

@endsection