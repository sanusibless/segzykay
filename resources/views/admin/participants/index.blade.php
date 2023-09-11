  @extends('admin.layout')
  @section('title')
     Participants
  @endsection

  @section('content')
      <div class="card">
            <div class="card-body">
              <h5 class="card-title">Contestants</h5>

              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Active  <span class="badge bg-success ml-2">{{ $active_participants->count()}}</span></button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Withdrawal <span class="badge bg-danger ml-2">{{ $withdrawn_participants->count()}}</span></button>
                </li>
              </ul>
              <div class="tab-content pt-4" id="borderedTabContent">
                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                    <!-- Table with hoverable rows -->
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">S/N</th>
                          <th scope="col">Image</th>
                          <th scope="col">Name</th>
                          <th scope="col">Votes</th>
                          <th scope="col">Enrollment Date</th>
                          <th scope="col" class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($active_participants->get() as $active)
                        <tr>
                          <th scope="row">{{++$loop->index}}</th>
                          <td><img src="{{ url('storage/'. $active->image) }}" class="rounded-circle" alt="{{ $active->full_name }}'s image" width="50" height="50"></td>
                          <td>{{ $active->full_name }}</td>
                          <td>{{ $active->votes }}</td>
                          <td>{{ $active->created_at }}</td>
                          <td class="text-center">
                           <a href="{{ route('admin.participant.edit', ['user' => $active->id ]) }}" title="Edit" class="pr-3"><i class="bi bi-pencil text-success hover"></i></a>
                           <form action="{{ route('admin.participant.withdraw') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="user_id" value="{{ $active->id }}">
                             <button class="btn" title="Withdrawal" onclick="confirm('Are you sure you want to withdrawn this contestant? \n People will not be able to vote for this contestant anymore!');"><i class="bi bi-trash text-danger hover"></i></button>
                           </form>
                           
                          </td>
                        </tr>
                        @empty
                          <tr class="text-center py-3">
                            <td colspan="6">No Records</td>
                          </tr>
                        @endforelse
                    </table>
              <!-- End Table with hoverable rows -->

                </div>
                <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">S/N</th>
                          <th scope="col">Image</th>
                          <th scope="col">Name</th>
                          <th scope="col">Votes</th>
                          <th scope="col">Enrollment Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($withdrawn_participants->get() as $active)
                        <tr>
                          <th scope="row">{{++$loop->index}}</th>
                          <td><img src="{{ url('storage/'. $active->image) }}" class="rounded-circle" alt="{{ $active->full_name }}'s image" width="50" height="50"></td>
                          <td>{{ $active->full_name }}</td>
                          <td>{{ $active->votes }}</td>
                          <td>{{ $active->created_at }}</td>
                        </tr>
                        @empty
                          <tr class="text-center py-3">
                            <td colspan="6">No Records</td>
                          </tr>
                        @endforelse
                    </table>
                </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>
  @endsection