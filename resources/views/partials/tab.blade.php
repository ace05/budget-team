<ul class="nav nav-tabs row" role="tablist">
    <li role="presentation" class="@if(Request::segment(1) !== 'candidates') active @endif col-sm-6">
      	<a href="{{{ route('home') }}}" aria-controls="home" role="tab" > 
      		<span class="glyphicon glyphicon-search"></span>
      		Find Team
      	</a>
    </li>
  	<li role="presentation" class="@if(Request::segment(1) === 'candidates') active @endif col-sm-6">
  		<a href="{{{ route('candidate.list') }}}" aria-controls="profile" role="tab" >
  			<span class="glyphicon glyphicon-user"></span>
      		Candidates
  		</a>
  	</li>
</ul>