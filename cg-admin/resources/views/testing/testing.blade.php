@extends('layouts.dashboard')
@section('content')
<div class="row">
	<div class="col-md-8 col-lg-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">Testing Ajax</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="frm_testing" name="frm_testing">
				    {!! csrf_field() !!}
					<input type="text" id="txtInput" name="txtInput" />&nbsp;<input type="button" value="TestAjaxloadurl" id="btnSubmit" name="btnSubmit">&nbsp;
					<input type="button" value="TestAjaxload" id="btnSubmit1" name="btnSubmit1">
					<br />
					<span id="respMsg"></span>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
{!!Html::script('/js/changepassword.js')!!}
@endsection