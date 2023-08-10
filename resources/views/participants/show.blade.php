@extends('participants.layout')

@section('content')
	<div class="container my-5 py-5 d-flex justify-content-center text-dark">
		<div class="d-flex shadow w-50 justify rounded-3">
			<div class="w-25">
				<img src="{{ url('storage/'.$participant->image) }}" class="img-fluid img-flush">
			</div>
			<div class="w-75">
				<h6>Name: {{ $participant->full_name }}</h6>
				<small>Total Votes: {{ $participant->votes ?? 0 }}</small>
				<p>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
					  Vote
					</button>
				</p>
			</div>
		</div>
	</div>

	<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade text-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $participant->full_name }}</h5>
        <button type="button" class="btn btn-sm btn-close btn-danger" data-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        	<div>
        		<form class="form" action="{{ route('participants.vote', ['user' => $participant->id] ) }}" method="POST">
        			@csrf
        			<div class="form-group">
        				<label>The number of votes you want to buy</label>
	        			<input type="number" step="1" min="10" name="votes" class="form-control">
	        			@error('votes') <p class="text-danger">{{ $message }}</p>@enderror
        			</div>
        			<div class="text-center">
        				<button class="btn btn-primary" @disabled($errors->isNotEmpty())>Buy</button>
        			</div>
        		</form>
        	</div>
      </div>
    </div>
  </div>
</div>

@endsection