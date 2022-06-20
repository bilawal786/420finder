@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="mt-5 pt-5">
        <div class="container mt-4">
          <div class="row py-5">
              <div class="col-md-6 offset-md-3 border p-5">
                <h5 class="card-title text-center bg-light py-5 shadow-sm">
                  <img src="{{ asset('addbusiness.png') }}" alt="420 Finder Logo" class="w-25">
                </h5>
                <div class="mt-4">
                  <h5 class="pb-3"><strong>Business submitted</strong></h5>
                  <p>
                    Thanks for submitting your business to 420 Finder! Our account team will reach out to you once they have verified your information.
                  </p>
                  <p>
                    If you have any questions in the meantime, please don’t hesistate to contact us.
                  </p>
                  <div class="row">
                    <div class="col-md-12">
                      <a href="{{ route('index') }}" class="btn w-100 btn-outline-dark">Back to 420 Finder</a>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </section>

@endsection
