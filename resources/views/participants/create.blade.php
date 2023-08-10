<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
  <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <title>Register - SegzyKay Media Concept</title>
</head>
<body class="bg-light">
	<section class="">
		<div class="w-50 mx-auto bg-white my-5 h-75 rounded" id="participant-form">
		<form action="{{ route('participants.store') }}" method="POST" class="py-5 text-dark w-75 mx-auto" enctype="multipart/form-data">
			@csrf
			<fieldset class="mb-3">
				<legend>Personal Information</legend>
				<h6>Name</h6>
				<div class="d-flex flex-column flex-lg-row mb-2">
					<div class="form-group mr-2">
						<input type="text" name="firstname" value="{{ old('firstname') }}"placeholder="First Name" class="form-control border rounded">
						@error('firstname') <small class="text-danger">{{ $message }}</small> @enderror
					</div>
					<div class="form-group mr-2">
						<input type="text" name="lastname" value="{{ old('lastname') }}"placeholder="Last Name" class="form-control border rounded">
						@error('lastname') <small class="text-danger">{{ $message }}</small> @enderror
					</div>
					<div class="form-group mr-2">
						<input type="text" name="midname" value="{{ old('midname') }}"placeholder="Middle Name" class="form-control border rounded">
						@error('midname') <small class="text-danger">{{ $message }}</small> @enderror
					</div>		
				</div>
				<div class="d-flex flex-column flex-lg-row mb-2">
					<div class="form-group  w-50 mr-2">
						<label>Email</label>
						<input type="email" name="email" value="{{ old('email') }}"placeholder="e.g john@example.com" class="form-control border rounded">
						@error('email') <small class="text-danger">{{ $message }}</small> @enderror
					</div>
					<div class="form-group w-50 ">
						<label>Phone Number</label>
						<input type="tel" class="form-control"value="{{ old('phone') }}" pattern="[0-9]{4}[0-9]{3}[0-9]{4}" placeholder="" name="phone">
						@error('phone') <small class="text-danger">{{ $message }}</small> @enderror
					</div>
				</div>
				<div class="d-flex flex-column flex-lg-row mb-2">
					<div class="form-group w-50 mr-2">
						<label>Date of Birth</label>
						<input type="date" name="dob"value="{{ old('dob') }}" class="form-control border rounded d-block">
						@error('dob') <small class="text-danger">{{ $message }}</small> @enderror
					</div>
					<div class="form-group w-50">
						<label>Gender</label>
						<select class="form-control"value="{{ old('gender') }}" name="gender">
							<option value="m" disabled>Male</option>
							<option value="f" selected>Female</option>
						</select>
						@error('gender') <small class="text-danger">{{ $message }}</small> @enderror
					</div>
				</div>
			</fieldset>
			<fieldset class="mb-3">
				<legend>Address</legend>
				<div class="d-flex flex-column flex-lg-row">
					<div class="form-group mr-2">
						<label>Street</label>
						<input type="text" value="{{ old('street') }}"placeholder="" class="form-control" name="street">
						@error('street') <small class="text-danger">{{ $message }}</small> @enderror
					</div>
					<div class="form-group mr-2">
						<label>City</label>
						<input type="text" value="{{ old('city') }}"placeholder="" class="form-control input-sm" name="city">
						@error('city') <small class="text-danger">{{ $message }}</small> @enderror
					</div>
					<div class="form-group mr-2">
						<label>State</label>
						<input type="text" value="{{ old('state') }}" list="state" class="form-control" name="state" placeholder="Type to search">
						<datalist id="state">
							<option value="Ondo" selected>
							<option value="Osun">
							<option value="Lagos">
						</datalist>
						@error('state') <small class="text-danger">{{ $message }}</small> @enderror
					</div>
				</div>
			</fieldset>
			<fieldset class="mb-3">
				<legend>Profile Image</legend>
				<input type="file" name="image" class="form-control">
				@error('image') <small class="text-danger">{{ $message }}</small> @enderror
			</fieldset>
			<div class="pt-4 text-center">
				<button type="submit" class="btn btn-outline-primary">Create</button>
			</div>
		</form>
	</div>

	</section>
  <script src="{{ url('js/jquery.js') }}"></script>
  <script src="{{ url('js/bootstrap.js') }}"></script>
  <script src="{{ url('js/popper.js') }}"></script>

</body>
</html>