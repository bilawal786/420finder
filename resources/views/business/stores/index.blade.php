@extends('layouts.app')

    @section('title', '420 Finder')
    
    @section('content')

    <section class="mt-5 pt-5 pb-0">
        <div class="container-fluid px-0">
          <div class="row">
              <div class="col-md-2 pe-0">
                @include('partials/business-sidebar')
              </div>
              <div class="col-md-10 p-5 bg-light">
                <div class="card mb-5">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <h4>My Stores</h4>
                      </div>
                      <div class="col-md-6 text-end">
                        <a href="{{ route('addnewstore') }}" class="appointment-btn" style="margin-left: 0px !important;">Add New</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="table responsive">
                      
                      <table class="table">
                        <thead>
                          <th>#</th>
                          <th>Business Name</th>
                          <th>Type</th>
                          <th>View Store</th>
                          <th>Login to account</th>
                          <th>Created At</th>
                        </thead>
                        <tbody>
                          @if($stores->count() > 0)
                            @foreach($stores as $index => $store)
                              <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $store->business_name }}</td>
                                <td>
                                  {{ $store->business_type }}
                                </td>
                                <td>
                                  @if($store->business_type == 'Dispensary')
                                    <a href="{{ route('dispensarysingle', ['name' => $store->business_name, 'id' => $store->id]) }}" target="_blank">View</a>
                                  @else
                                    <a href="{{ route('deliverysingle', ['name' => $store->business_name, 'id' => $store->id]) }}" target="_blank">View</a>
                                  @endif
                                </td>
                                <td>
                                  @if($store->business_type == 'Dispensary')
                                    <a href="https://dispensaries.jeremiahc1.sg-host.com/" class="text-warning" target="_blank">Login</a>
                                  @else
                                    <a href="https://deliveries.jeremiahc1.sg-host.com/" class="text-warning" target="_blank">Login</a>
                                  @endif
                                </td>
                                <td></td>
                              </tr>
                              @endforeach
                          @else

                          @endif
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </section>

@endsection