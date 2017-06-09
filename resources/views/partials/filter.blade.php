<div class="junior-list panel panel-default">
	<div class="panel-body">
		<h4>Junior Developers - Budget <span class="label label-success">{{{ $juniorBudget }}}</span></h4>
		<hr>
		@if(empty($juniors) === false)
			@foreach($juniors as $junior)
				<div class="media"> 
					<div class="media-left"> 
						<a href="#"> 
							<img alt="64x64" class="media-object" data-src="holder.js/64x64" src="{{{ asset('images/default.jpg') }}}" data-holder-rendered="true" style="width: 64px; height: 64px;"> 
						</a> 
					</div> 
					<div class="media-body"> 
						<h4 class="media-heading">{{{ $junior['name'] }}}</h4>
						Experience: <span class="label label-success">{{{ $junior['experience'] }}} Years</span>
						Expected Salary: <span class="label label-success">{{{ $junior['expected_salary'] }}}</span>
					</div> 
				</div>
			@endforeach
		@else
			<div class="alert alert-warning">Oops! You may increase your budget</div>
		@endif
	</div>
</div>
<div class="senior-list panel panel-default">
	<div class="panel-body">
		<h4>Senior Developers - Budget <span class="label label-success">{{{ $seniorBudget }}}</span></h4>
		<hr>
		@if(empty($seniors) === false)
			@foreach($seniors as $senior)
				<div class="media"> 
					<div class="media-left"> 
						<a href="#"> 
							<img alt="64x64" class="media-object" data-src="holder.js/64x64" src="{{{ asset('images/default.jpg') }}}" data-holder-rendered="true" style="width: 64px; height: 64px;"> 
						</a> 
					</div> 
					<div class="media-body"> 
						<h4 class="media-heading">{{{ $senior['name'] }}}</h4>
						Experience: <span class="label label-success">{{{ $senior['experience'] }}} Years</span>
						Expected Salary: <span class="label label-success">{{{ $senior['expected_salary'] }}}</span>
					</div> 
				</div>
			@endforeach
		@else
			<div class="alert alert-warning">Oops! You may increase your budget</div>
		@endif
	</div>
</div>