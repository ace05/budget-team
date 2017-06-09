@extends('layouts.default')

@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="nav-tab-holder">
		    @include('partials.tab')
	 	</div>
	 	<hr>
	 	<div class="search-form text-center">
	 		<h3>Add Candidate</h3>
	 		<hr>
	 		{!! Form::open(['route' => 'candidate.add', 'class' => 'form-horizontal']) !!}
	 			<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
	 				{!! Form::text('name', old('name'), ['class' => 'form-control input-lg', 'placeholder' => 'Name']) !!}
	 				@if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{{ $errors->first('name') }}}</strong>
                        </span>
                    @endif
			   	</div>
	 			<div class="form-group {{ $errors->has('experience') ? ' has-error' : '' }}">
	 				{!! Form::number('experience', old('experience'), ['class' => 'form-control input-lg', 'placeholder' => 'Experience', "min" => '1']) !!}
	 				@if ($errors->has('experience'))
                        <span class="help-block">
                            <strong>{{{ $errors->first('experience') }}}</strong>
                        </span>
                    @endif
			   	</div>
			   	<div class="form-group {{ $errors->has('expected_salary') ? ' has-error' : '' }}">
			   		{!! Form::text('expected_salary', old('expected_salary'), ['class' => 'form-control  input-lg', 'placeholder' => 'Expected salary per month']) !!}
			   		@if ($errors->has('expected_salary'))
                        <span class="help-block">
                            <strong>{{{ $errors->first('expected_salary') }}}</strong>
                        </span>
                    @endif
			 	</div>
			   	<div class="form-group">
			   		{!! Form::submit('Add', ['class' => 'btn btn-primary btn-lg']) !!}
			   	</div>
	 		{!! Form::close() !!}
	 	</div>
		<hr>
		<div class="result"></div>
	</div>
</div>

@endsection