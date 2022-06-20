@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="mt-5 pt-5">
        <div class="container mt-4">
          <div class="row">
              <div class="col-md-6 offset-md-3">
                <h5 class="card-title text-center py-3">
                  <img src="{{ asset('assets/img/logo.png') }}" alt="420 Finder Logo" class="w-25">
                </h5>
                <form action="{{ route('saveabusiness') }}" method="POST" class="mb-5" id="add-business">
                  @csrf
                  <div class="">
                    <h5><strong>Add your business</strong></h5>
                    <p>Complete and submit the form below. Your business will appear on 420 Finder <strong>after our account team contacts you</strong> and verifies the information.</p>
                    <p>If you are submitting this application on behalf of a company or other legal entity, you represent that you have the authority to bind such entity to the terms and conditions set forth herein.</p>
                  </div>
                  <div>
                    <h5 class="pt-5 pb-3"><strong>Contact</strong></h5>
                    <div class="row">
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">First name*</label>
                          <input type="text" name="first_name" class="form-control" required="">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Last name*</label>
                          <input type="text" name="last_name" class="form-control" required="">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Phone number*</label>
                          <input type="text" name="phone_number" class="form-control" required="" id="phoneNumber">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Business role*</label>
                          <select name="role" class="form-control" required="">
                            <option value="">Select a business role</option>
                            <option value="Advertising Manager">Advertising Manager</option>
                            <option value="COO">COO</option>
                            <option value="Finance Manager">Finance Manager</option>
                            <option value="Partner">Partner</option>
                            <option value="President">President</option>
                            <option value="Marketing Manager">Marketing Manager</option>
                            <option value="Operations Manager">Operations Manager</option>
                            <option value="Other">Other</option>
                          </select>
                        </div>
                      </div>
                        <div class="form-group pb-3">
                            <label for="">Email*</label>
                            <input type="email" name="email" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" required="">
                        </div>
                    </div>
                    <h5 class="pt-5 pb-3"><strong>Business</strong></h5>
                    <div class="row">
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Business name*</label>
                          <input type="text" name="business_name" class="form-control" required="">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Business type*</label>
                          <select name="business_type" class="form-control" required="">
                            <option value="">Select a business type</option>
                            <option value="Brand">Brand</option>
                            <option value="Dispensary">Dispensary</option>
                            <option value="Delivery">Delivery</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Country*</label>

                          <input type="text" name="country" readonly required="" class="form-control" value="United States">

                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group pb-3">
                          <label for="">Address Line 1</label>
                          <input type="text" name="address_line_1" class="form-control" required="">
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group pb-3">
                          <label for="">Address Line 2</label>
                          <input type="text" name="address_line_2" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">City</label>
                          <input type="text" name="city" class="form-control" required="">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">State / Province</label>
                          <input type="text" name="state_province" class="form-control" required="">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Postal code</label>
                          <input type="text" name="postal_code" class="form-control" required="">
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group pb-3">
                          <label for="">Website</label>
                          <input type="text" name="website" class="form-control" required="">
                        </div>
                      </div>
                    </div>
                    <h5 class="pt-5 pb-3"><strong>License</strong></h5>
                    <div class="row">
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">License number*</label>
                          <input type="text" name="license_number" class="form-control" required="">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">License type</label>
                          <select name="license_type" class="form-control" required="">
                            <option value="">Select a license type</option>
                            <option value="Adult-Use Cultivation">Adult-Use Cultivation</option>
                            <option value="Adult-Use Mfg">Adult-Use Mfg.</option>
                            <option value="Adult-Use Nonstorefront">Adult-Use Nonstorefront</option>
                            <option value="Adult-Use Retail">Adult-Use Retail</option>
                            <option value="Distributor">Distributor</option>
                            <option value="Event">Event</option>
                            <option value="Medical Cultivation">Medical Cultivation</option>
                            <option value="Medical Mfg">Medical Mfg</option>
                            <option value="Medical Nonstorefront">Medical Nonstorefront</option>
                            <option value="Medical Retail">Medical Retail</option>
                            <option value="Microbusiness">Microbusiness</option>
                            <option value="Testing Lab">Testing Lab</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Expiration</label>
                          <input type="date" name="license_expiration" class="form-control" required="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="form-group pt-3 pb-4">
                      <label for="">
                        <input type="checkbox" required=""> I have read and agree to the above terms and conditions.*
                      </label>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn appointment-btn w-100" style="margin-left: 0;" id="add-business-submit">Add Business</button>
                    </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#add-business").submit(function () {
                $("#add-business-submit").attr("disabled", true);
                return true;
            });

            $('#phoneNumber').on('change', function() {
                let phoneNumber = $('#phoneNumber').val();
                let x = phoneNumber.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                phoneNumber = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');

                $('#phoneNumber').val(phoneNumber);
            });

        });
    </script>
@endpush
