@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="nav-tab-holder">
			    @include('partials.tab')
		 	</div>
		 	<hr>
			<div class="candidate-list panel panel-default">
				<div class="panel-body">
					<h4 class="">Candidates List - <a href="{{{ route('candidate.add') }}}" class="btn btn-success">
						<span class="glyphicon glyphicon-plus"></span> Add candidate
					</a></h4>
					<hr>
					@if($candidates->count() > 0)
						@foreach($candidates as $candidate)
							<div class="media list-{{{ $candidate->id }}}"> 
								<div class="media-left"> 
									<a href="#"> 
										<img alt="64x64" class="media-object" data-src="holder.js/64x64" src="{{{ asset('images/default.jpg') }}}" data-holder-rendered="true" style="width: 64px; height: 64px;"> 
									</a> 
								</div> 
								<div class="media-body"> 
									<h4 class="media-heading">{{{ $candidate->name }}}</h4>
									Experience: <span class="label label-success">{{{ $candidate->experience }}} Years</span>
									Expected Salary: <span class="label label-success">{{{ $candidate->expected_salary }}}</span>
								</div>
								<div class="media-right">
									<ul class="list-unstyled">
										<li>
											<div>
												<a href="{{{ route('candidate.edit', ['id' => $candidate->id]) }}}" class="btn btn-sm btn-warning">
													<span class="glyphicon glyphicon-pencil"></span> Edit
												</a>
											</div>
										</li>
										<li>
											<a href="{{{ route('candidate.delete', ['id' => $candidate->id]) }}}" class="btn btn-sm btn-danger candidate-delete" id="list-{{{ $candidate->id }}}">
												<span class="glyphicon glyphicon-remove"></span> Delete
											</a>
										</li>
								</div>
							</div>
						@endforeach
						{{ $candidates->links() }}
					@else
						<div class="alert alert-warning">Oops! No candidates found</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection