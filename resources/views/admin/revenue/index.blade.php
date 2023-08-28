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
                    <div class="px-4 text-left d-none d-md-block">
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
              <table class="table w-50 mx-auto">
                      <thead>
                        <tr>
                          <th scope="col">S/N</th>
                          <th scope="col">Image</th>
                          <th scope="col">Name</th>
                          <th scope="col" >Amount </th>
                        </tr>
                      </thead>
                      <tbody>
                @forelse($revenues as $revenue)
                        <tr class="py-auto">
                          <th scope="row">{{++$loop->index}}</th>
                          <td><img src="{{ url('storage/'. $revenue->user->image) }}" class="rounded-circle" alt="{{ $revenue->user->full_name }}'s image" width="50" height="50"></td>
                          <td>{{ $revenue->user->full_name }}</td>
                          <td class="">{{ $revenue->amount }}</td>
                        </tr>
                        @empty
                          <tr class="text-center py-3 text-muted">
                            <td colspan="6">Revenue from  each parrticipants will be here display here</td>
                          </tr>
                        @endforelse
                    </table>
            </div>
@endsection