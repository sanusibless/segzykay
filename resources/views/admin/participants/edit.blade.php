  @extends('admin.layout')
  @section('title')
     Edit {{ $user->firstname }}
  @endsection

  @section('content')
      <div class="card">
            <div class="card-body pt-4">
              <h5 class="card-title text-center py-3">Edit {{ $user->full_name }}</h5>
                <div class="text-center py-5">
                    <img src="{{ url('storage/' . $user->image ) }}" alt="{{ $user->full_name }}'s image" class="rounded-circle" style="width: 200px; height: 200px;">
                  </div>
                  <form action="{{ route('participants.update', ['user' => $user->id]) }}" method="POST" class="text-dark w-75 mx-auto" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <fieldset class="mb-5">
                      <legend>Personal Information</legend>
                      <h6>Name</h6>
                      <div class="row g-3">
                        <div class="col-md-4">
                          <input type="text" name="firstname" value="{{ old('firstname') ?? $user->firstname }}"placeholder="First Name" class="form-control border rounded">
                          @error('firstname') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-4">
                          <input type="text" name="lastname" value="{{ old('lastname') ?? $user->lastname }}"placeholder="Last Name" class="form-control border rounded">
                          @error('lastname') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-4">
                          <input type="text" name="midname" value="{{ old('midname') ?? $user->midname }}"placeholder="Middle Name" class="form-control border rounded">
                          @error('midname') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>    
                        <div class="col-md-6">
                          <label class="form-label">Email</label>
                          <input type="email" name="email" value="{{ old('email') ?? $user->email }}" disabled placeholder="e.g john@example.com" class="form-control border rounded">
                          @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Phone Number</label>
                          <input type="tel" class="form-control"value="0{{ old('phone') ?? $user->phone }}" pattern="[0-9]{4}[0-9]{3}[0-9]{4}" placeholder="" name="phone">
                          @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Date of Birth</label>
                          <input type="date" name="dob"value="{{ old('dob') ?? $user->dob }}" class="form-control border rounded d-block">
                          @error('dob') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Gender</label>
                          <select class="form-control" value="{{ $user->gender }}" name="gender">
                            <option value="m" disabled>Male</option>
                            <option value="f" selected>Female</option>
                          </select>
                          @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                      </div>
                    </fieldset>
                    <fieldset class="mb-3">
                      <legend>Address</legend>
                      <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Street</label>
                          <input type="text" value="{{ old('street') ?? $user->street }}"placeholder="" class="form-control" name="street">
                          @error('street') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">City</label>
                          <input type="text" value="{{ old('city') ?? $user->city }}"placeholder="" class="form-control input-sm" name="city">
                          @error('city') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">State</label>
                          <input type="text" value="{{ old('state') ?? $user->state }}" list="state" class="form-control" name="state" placeholder="Type to search">
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
                      <button type="submit" class="btn btn-outline-primary">Save Changes</button>
                    </div>
                  </form>
            </div>
          </div>
  @endsection