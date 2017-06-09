@extends('layouts.default')

@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="nav-tab-holder">
		    @include('partials.tab')
	 	</div>
	 	<hr>
	 	<div class="search-form text-center">
	 		{!! Form::open(['url' => '/filter/team', 'class' => 'form-inline search-form text-center']) !!}
	 			<div class="validation-errors"></div>
	 			<div class="form-group">
	 				{!! Form::number('junior', old('junior'), ['class' => 'form-control', 'placeholder' => 'Junior Developers Count', "min" => '1']) !!}
			   	</div>
			   	<div class="form-group">
			   		{!! Form::number('senior', old('senior'), ['class' => 'form-control', 'placeholder' => 'Senior Developers Count', "min" => '1']) !!}
			 	</div>
			   	<div class="form-group">
			   		{!! Form::text('budget', old('budget'), ['class' => 'form-control', 'placeholder' => 'Budget']) !!}
			   	</div>
			   	<div class="form-group">
			   		{!! Form::submit('Find', ['class' => 'btn btn-primary']) !!}
			   	</div>
	 		{!! Form::close() !!}
	 	</div>
		<hr>
		<div class="result"></div>
	</div>
</div>

@endsection