@extends('layouts.app')

@section('content')
<style>
    .obv{
        border:1px solid silver;
        background:white;
    }
    body{
        background-color:#f5f1f1;
    }
   
</style>
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-9 container">
        <h3>Add Obervations</h3>
        </div>
    </div>

    <div class="row">

        <div class="col-md-9 obv container ">
            <form class="form-inline">
            <table class="table ">
                <thead>
                <tr>
                    <th>
                        Test Parameter
                    </th>
                    <th>Observed value</th>
                    <th style="text-align: center; vertical-align: middle;">
                        Test Method
                    </th>
                    <th>
                       &nbsp;
                    </th>
                    </tr>
                </thead>
                <tbody id="obv_dynamic">
                    <tr>
                    <td>{{$data[0]->test_param}}</td>
                    <td id="firstObvInput"><input type="text" id="firstObvInputText" class="form-control col-md-8"/></td>
                    <td rowspan="1000" style="text-align: center; vertical-align: middle;">{{$data[0]->test_method}}</td>
                    <td></td>
                    </tr>
                </tbody>
            
            </table>
            </form>
            <button type="button"class="btn btn-secondary" id="add_sub_param">Add Sub Parameter</button>
            <br><br>
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                     <button type="button"class="btn btn-success btn-block" id="submit" onclick="submit()">Submit</button>
                </div>
            </div>
            <br>
        </div>
    
    </div>
</div>
<script>
    var count=0
$('#add_sub_param').click(function(){
    
    var td='<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="test_param1[]"  onchange="change_func(this);" type="text" class="form-control col-md-8" /></td>';
    td=td+'<td><input name="test_param_val[]" onchange="change_func(this);" type="text" class="form-control col-md-8"/></td>';
    
    td=td+'<td><button type="button"class="btn btn-danger" onclick="removeRow(this)" id="add_sub_param">Delete</button></td></tr>';
    $('#obv_dynamic').append(td);
    count=count+1;
    checkFirstRow();
});

function removeRow(val){
    $(val).parent().parent().remove();
    count=count-1;
    checkFirstRow();
}

function checkFirstRow(){
    if(count==0){
        $('#firstObvInput').html('<input id="firstObvInputText" type="text" class="form-control col-md-8"/>');
    }
    else{
        $('#firstObvInput').html('');
    }
}

$("#firstObvInputText").change(function(){$(this).removeClass('is-invalid')});


  function change_func(data){
    if($(data).val()!=''){
    $(data).removeClass('is-invalid');
  } 
  }
function submit()
{
    if(count==0)
    {
        i=0;
        if($('#firstObvInputText').val()==""){ $('#firstObvInputText').addClass('is-invalid'); i=1; }
        if(i==0)
        {
            
            $('.loader').modal('show');
            var saveData = $.ajax({
                type: 'POST',
                url: "{{ route('postParams')}}",
                data: {"_token": "{{ csrf_token() }}",type:"single",util_id:{{$data[0]->test_util_id}},val:$('#firstObvInputText').val() },
                success: function(resultData) {
                  if(resultData=="Error")
                  {
                    swal("Something went wrong");
                    $('.loader').modal('hide');
                  }
                  
                  swal("Successful!");
                  setTimeout(function(){ window.location="{{route('dept')}}"; }, 2000);
                    $('.loader').modal('hide');
                  }
          });
          saveData.fail(function() { swal("Something went wrong"); $('.loader').modal('hide');  });
        }
    }
    else{
        i=0;
        $("[name^=test_param1]").each(function () {
                  if($(this).val()=="")
                  {
                    $(this).addClass('is-invalid');
                    i=1;
                  }
                  });
        $("[name^=test_param_val]").each(function () {
                  if($(this).val()==null)
                  {
                    $(this).parent().addClass('is-invalid');
                    i=1;
                  }
                  });

        if(i==0)
        {
            var test_param = $("[name^=test_param1]").map(function(){
                return $(this).val();
                }).get().join("*#sep#*");

                var test_param_val = $("[name^=test_param_val]").map(function(){
                return $(this).val();
                }).get().join("*#sep#*");

            $('.loader').modal('show');
            var saveData = $.ajax({
                type: 'POST',
                url: "{{ route('postParams')}}",
                data: {"_token": "{{ csrf_token() }}",type:"multiple",util_id:{{$data[0]->test_util_id}},sub_param:test_param,val:test_param_val },
                success: function(resultData) {
                  if(resultData=="Error")
                  {
                    swal("Something went wrong");
                    $('.loader').modal('hide');
                  }
                  
                  swal("Successful!");
                  setTimeout(function(){ window.location="{{route('dept')}}"; }, 2000);
                    $('.loader').modal('hide');
                  }
          });
          saveData.fail(function() { swal("Something went wrong"); $('.loader').modal('hide');  });
        }
    }
}
</script>
@endsection