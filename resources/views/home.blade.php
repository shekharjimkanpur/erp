@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<form  action="/public/generate-pdf">
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
</form>
</section>
                    You are logged in!
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
