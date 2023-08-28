@extends('admin.layout')
@section('title')
	Settings
@endsection

@section('meta-request')
 <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')
	<div class="card">
            <div class="card-body">
              <h5 class="card-title">Settings</h5>
              <!-- Default Accordion -->
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Face of SeqzyKay
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    	<form class="col-12 col-sm-8 col-md-6 mx-auto" action="{{ route('admin.settings.save') }}" method="POST" id="face_of_segzykay_form">
                    		@csrf
                    		@method('PUT')
                    		<div class="d-flex justify-content-between mb-3">
                          <div>
                            <label class="form-check-label" for="face_of_segzykay">Launch Face of SegzyKay</label>
                            <small class="d-block"><span class="text-danger">*</span> if it is this switch off, Face of SegzyKay will be close</small>
                          </div>
                    		 <div class="form-check form-switch mb-3">
                          @if($settings)
		                        <input  class="form-check-input" type="checkbox" name="start" id="face_of_segzykay" @checked($settings->start == "on")>
                          @else
                           <input class="form-check-input" type="checkbox" name="start" id="face_of_segzykay">
                          @endif
                   			</div>
                   			</div>
                    			<div id="face_of_segzykay_settings">
                    				<div class="form-group mb-3">
                    					<label class="form-label">Start Date</label>
                    					<input value="{{ $settings->start_date ?? old('start_date') }}" class="form-control disable" type="date" name="start_date" >
                              @error('start_date') <small class="text-danger">{{ $message }}</small>@enderror
                    				</div>
                    				<div class="">
                    					<div class="form-group mb-3">
	                    					<label class="form-label">End Date</label>
	                    					<input value="{{ $settings->end_date ?? old('end_date') }}" class="form-control disable" type="date" name="end_date" >
                                @error('end_date') <small class="text-danger">{{ $message }}</small>@enderror
                    					</div>
                    					
                    				</div>
                    				<div class="">
                    					<div class="form-group mb-3">
                    						<label class="form-label">Number of Contestant</label>
                    					<input value="{{ $settings->number_of_contestant ?? old('number_of_contestant') }}" class="form-control disable" type="number" name="number_of_contestant" step="1" min="18">
                              @error('number_of_contestant') <small class="text-danger">{{ $message }}</small>@enderror
                    					</div>
                    					
                    				</div>
                    				<div class="">
                    					<div class="form-group mb-3">
                    						<label class="form-label">Minimum age</label>
                    					<input value="{{ $settings->min_age ?? old('min_age') }}" class="form-control disable" type="number" name="min_age" >
                              @error('min_age') <small class="text-danger">{{ $message }}</small>@enderror
                    					</div>
                    				</div>
                            <div class="d-flex justify-content-center">
                            <button class="btn btn-sm btn-primary">
                              Save Changes
                            </button>
                          </div>
                    			</div>
                    			
                    	</form>
                    </div>
                  </div>
                </div>
              </div><!-- End Default Accordion Example -->

            </div>
          </div>
       @push('scripts')
       <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
       	<script>
         
          let faceofSegzykay = document.getElementById('face_of_segzykay');
          let faceofSegzykayForm = document.getElementById('face_of_segzykay_form');
          let face_of_segzykay_settings = document.getElementById('face_of_segzykay_settings');
          const disableInputs = document.getElementsByClassName('disable');
          let arrayDisableInputs = Array.from(disableInputs);

          // hiding the settings input if start is unchecked 
          if(faceofSegzykay.checked == true) {
              face_of_segzykay_settings.style.display = "block"
            } else {
              face_of_segzykay_settings.style.display = "none";
            }

          // toggling the settings inputs
          faceofSegzykay.addEventListener('change', (e) => {
            e.preventDefault();

            if(faceofSegzykay.checked == true) {
              face_of_segzykay_settings.style.display = "block"
            } else {
              let settings = {{ Js::from($settings) }};

              if(settings != null) {

                 confirm("Are you sure you want to stop Face of Segzykay?");

                 face_of_segzykay_settings.style.display = "none";

                 let formData = new FormData(faceofSegzykayForm);

                formData.delete("start");
                formData.delete("start_date");
                formData.delete("end_date");
                formData.delete("number_of_contestant");
                formData.delete("min_age");

                fetch("{{ route('admin.settings.save') }}",{
                  method: "POST",
                  body: formData
                }).then( resp => {
                  if(resp.ok) {
                      toastr.success('Face of Segzykay has been stopped!');
                      toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-center",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                      }
                  }
                })
                .catch(error => {
                  toastr.error(error.message);
                  toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-center",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                      };
                })

                faceofSegzykayForm.reset();
                window.location.reload();
                } else {
                  face_of_segzykay_settings.style.display = "none";
                  toastr.info('You did not launch Face of Segzykay');
                   toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-center",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                      }
                }
            }
          })

          // submiting the settings
          faceofSegzykayForm.addEventListener("submit", (e) => {

            e.preventDefault(); // preventing default behaviour
            e.stopPropagation(); // stop propagation

            let formData = new FormData(faceofSegzykayForm);

            fetch("{{ route('admin.settings.save') }}",{
                  method: "POST",
                  body: formData
                }).then( resp => {
                  if(resp.ok) {
                      toastr.success('Face of Segzykay successfully launched!');
                      toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-center",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                      }
                  }
                })
                .catch(error => {
                  toastr.error(error.message);
                  toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-center",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                      }
                });
          })
       	</script>
       @endpush
@endsection
