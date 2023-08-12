@extends('admin.layout')

@section('title')
  Revenue
@endsection

@section('content')
	<!-- Revenue Card -->
            <div class="col-12">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <div class="d-flex align-items-center pt-3 justify-content-center">
                    <div class="px-4 d-none d-md-block">
                      <h3>Total Revenue: </h3>
                    </div>
                    <div class="d-flex align-items-center px-4">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                      </div>
                      <div class="ps-3">
                        <h6><strong>{{ $total_revenue }}</strong></h6>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->
            <div class="bg-white rounded shadow">
              <div class="py-3 text-center">
                <h3>Revenues from contestants</h3>
              </div>
                @forelse($revenues as $revenue)
                <div class="card info-card revenue-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center pt-3">
                      <div class="w-25" >
                        <img src="{{ url('storage/'. $revenue->user->image) }}" alt="'img ">
                      </div>
                      <div class="w-75 d-flex align-items-center px-4">
                        <div class="ps-3">
                          <h4> Name: <strong>{{ $revenue->user->full_name }}</strong></h4>
                          <h6> Email : {{ $revenue->user->email }} </h6>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div>
                    {{ $revenues->links() }}
                  </div>
                </div>
                @empty
                <div class="text-center pb-3 ">
                  <small class="text-muted">Revenue will be display here</small>
                </div>
                @endforelse
            </div>
@endsection