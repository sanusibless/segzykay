@extends('participants.layout')

@section('content')
	<div class="container my-5 py-5 text-dark">
		<div class="d-flex justify-content-center">
			@forelse($participants as $participant)
  			<div class="mr-3 mb-4">
  				<div class="card shadow rounded-5" style="width: 15rem;">
				  <img src="{{ url('storage/'.$participant->image) }}" class="card-img-top rounded-3" alt="{{ $participant->full_name . ' image'}}">
				  <div class="card-body">
				    <h6 class="card-title"> Name: {{ $participant->full_name }}</h6>
				    <p class="card-text">Total Votes: {{ $participant->votes ?? 0 }}</p>
				    <div class="text-center">
				    	<a href="{{ route('participants.show', ['user' => $participant->id ]) }}" class="btn btn-primary d-block mx-auto">Vote</a>
				    </div>
				  </div>
				</div>
  			</div>
  			@empty
  			<p class="text-center">No contestants yet</p>
  			@endforelse
		</div>
		<div>
			<p class="text-center">You want to be a contestant? <a href="{{ route('participants.create') }}">Register here</a>
		</div>
  	</div>
@endsection