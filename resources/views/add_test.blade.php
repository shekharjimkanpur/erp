@extends('layouts.app')

@section('content')
<style>
  #app > main > div > form > div:nth-child(7) > div:nth-child(1) > div > div > div > button{
    border:1px solid #ced4da;
    background:white;
  }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"><div class="container">
  <h2>Add Test</h2>
  <!-- id	client_id	product_name	product_img_url	booking_date	due_date	letter_ref_no
  	letter_date	letter_img_url	total_amt	advc_amount -->

  <br>
  <form method="POST" action="#">
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
          <option value="{{$c->id}}"> {{$c->name}} </option>
          @endforeach
        </select>
        </div>
        </div>
        </div>
</div>

    <div class='row'>
<div class='col-md-6'>

    <div class="form-group">
      <label for="inputProductName">Product Name:</label>
      <input type="text" class="form-control" id="product_name" name='product_name' placeholder="Enter product name">
    </div>

    </div>
<div class='col-md-6'>

    <div class="form-group">
      <label for="formFileLg" class="form-label">Upload Product Image:</label>
      <input class="form-control form-control-md"  id="product_image" name='product_image' type="file" />
    </div>

    </div>
    </div>

    <div class='row'>
<div class='col-md-6'>

    <div class="form-group">
<label>Booking Date: </label>
    <div class="input-group date" data-date-format="mm-dd-yyyy">
      <input class="form-control" id='booking_date' name='booking_date' type="date"  />
    </div>
    </div>
    </div>

<div class='col-md-6'>

<div class="form-group"> 
<label>Due Date: </label>
    <div  class="input-group date" data-date-format="mm-dd-yyyy">
      <input class="form-control" id='due_date' name='due_date' type="date"  />
    </div>
</div>
</div>
    </div>

    <div class='row'>
<div class='col-md-6'>

    <div class="form-group"> 
<label>Letter Reference Number: </label>
    <div  class="input-group date" data-date-format="mm-dd-yyyy">
      <input class="form-control" id='letter_ref_no' name='letter_ref_no' type="text"  />
    </div>
    </div>
    </div>
<div class='col-md-6'>

<div class="form-group"> 
<label>Letter Date: </label>
    <div  class="input-group date" data-date-format="mm-dd-yyyy">
      <input class="form-control" id='letter_date' name='letter_date' type="date"  />
    </div>
</div>
</div>
    </div>

    <div class='row'>
<div class='col-md-12'>
<div class="form-group">
      <label for="formFileLg" class="form-label">Upload Letter Image:</label>
      <input class="form-control form-control-md" id="letter_img" name='letter_img' type="file" />
      </div>
      </div>
      
</div>
    
      <div class='row'>  
<div class='col-md-6'>

<div class="form-group">
      <label for="formFileLg" class="form-label">Total Amount:</label>
      <input class="form-control form-control-md" id="total_amt" name='total_amt' type="number" />
</div>

</div>
    
<div class='col-md-6'>
<div class="form-group">
      <label for="formFileLg" class="form-label">Advance Amount: </label>
      <input class="form-control form-control-md" id="advc_amt" name='advc_amt' type="number" />
</div>
</div>
</div>

<div class='row'>
      <div class='col-md-12'>
    <label>Select Departments:</label>
    <div class="form-row">
      <div class="form-group col-md-12">
        <select class="form-control selectpicker" style='border:1px solid grey;' name='inputdepttName[]'  id="inputdepttName" multiple>
          <option  disabled>Select Departments</option>
          @foreach ($dept as  $d)
          <option value="{{$d->id}},{{$d->name}}"> {{$d->name}} </option>
          @endforeach
          
          <!-- <option value="2,Testing Dept 2">Testing Dept 2</option>
          <option value="3,Testing Dept 3">Testing Dept 3</option>
          <option value="4,Testing Dept 4">Testing Dept 4</option> -->
        </select>
      </div>
      </div>
      </div>
<div id='test_method' class='col-md-12'>

</div>
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<script>
  function generate_test_method(id)
  {
   
    var method="@foreach ($method as  $m)  <option value='achcha_word,{{$m->id}}'> {{$m->test_method}} </option> @endforeach";
    return method.replaceAll('achcha_word',id); 
  }

  $( document ).ready(function() {
    $.noConflict();
    $('.selectpicker').selectpicker();
  });

$('#inputdepttName').change(function(){
// console.log($("#inputdepttName").val());
a=$("#inputdepttName").val();
dropotp='';
a.forEach(function(b){
  
  c=b.split(',');
  var abc=generate_test_method(c[0]);

dropotp+="<div class='row' style='padding-bottom:10px;'><div class='col-md-2'>"+c[1]+":</div><div class='col-md-3'><select class='form-control test_method_select' name='test_method_select[]' onchange='change_func(this);'  ><option value=''>Select Test Method</option>"+abc+"</select></div></div>";

});
$('#test_method').html(dropotp);

});

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
  $("#inputdepttName").change(function(){$(this).removeClass('is-invalid')}); 
  
   function change_func(data)
{
  if($(data).val()!=''){
    $(data).removeClass('is-invalid');
  }
}

$('form').submit(function(event) {
    event.preventDefault();
    var i=0;
    // 'letter_img' => 'required|image|mimes:jpeg,png,jpg,pdf',
    //                         'product_image' => 'required|image|mimes:jpeg,png,jpg,pdf',
    //                         'product_name'=>'required',
    //                         'booking_date'=>'required',
    //                         'due_date'=>'required',
//inputClientName
//inputdepttName
    //                         'letter_date'=>'required',
    //                         'letter_ref_no'=>'required',
    //                         'advc_amt'=>'required',
    //                         'total_amt'=>'required',
    
  // $(this).change(function(){$(this).removeClass('is-invalid')});

  // $("[name^=test_method_select]").each(function (i, j) {
                 
  //                   $(this).change(function(){$(this).removeClass('is-invalid')});
                 
  //                 });

  
    if($('#product_name').val()==""){ $('#product_name').addClass('is-invalid'); i=1; }
    if($('#letter_img').val()==""){
       $('#letter_img').addClass('is-invalid'); i=1;
        }
        else{
          var ext = $('#letter_img').val().split('.').pop().toLowerCase();
                    if($.inArray(ext, ['pdf','png','jpg','jpeg']) == -1) {
                        alert('Invalid file in letter image!');
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
                        alert('Invalid file in product image!');
                        $('#product_image').addClass('is-invalid'); i=1;
                    }
        }
    if($('#booking_date').val()==""){ $('#booking_date').addClass('is-invalid'); i=1; }
    if($('#due_date').val()==""){ $('#due_date').addClass('is-invalid'); i=1; }
    if($('#letter_date').val()==""){ $('#letter_date').addClass('is-invalid'); i=1; }
    if($('#advc_amt').val()==""){ $('#advc_amt').addClass('is-invalid'); i=1; }
    if($('#letter_ref_no').val()==""){ $('#letter_ref_no').addClass('is-invalid'); i=1; }
    if($('#total_amt').val()==""){ $('#total_amt').addClass('is-invalid'); i=1; }
    if($('#inputClientName').val()==""){ $('#inputClientName').addClass('is-invalid'); i=1; }
    if($('#inputdepttName').val()==""){ $('#inputdepttName').addClass('is-invalid'); i=1; }
    $("[name^=test_method_select]").each(function (i, j) {
                  if($(this).val()=="")
                  {
                    $(this).addClass('is-invalid');
                    i=1;
                  }
                  });



    if(i==0)
    {
      
      $('.loader').modal('show');
    var formData = new FormData(this);
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
        alert(result);
            location.reload();
        },
        error: function(data)
        {
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
@endsection