@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold">Vendor Details</h3>
              <h6 class="font-weight-normal"> <a href="{{ url('admin/admins/vendor') }}">Back</a></h6>
            </div>
            <div class="col-12 col-xl-4">
             <div class="justify-content-end d-flex">
              <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                 <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                  <a class="dropdown-item" href="#">January - March</a>
                  <a class="dropdown-item" href="#">March - June</a>
                  <a class="dropdown-item" href="#">June - August</a>
                  <a class="dropdown-item" href="#">August - November</a>
                </div>
              </div>
             </div>
            </div>
          </div>
        </div>
      </div>

    <div class="row">
     <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Personal Information</h4>
          {{-- <p class="card-description">
            Basic form layout
          </p> --}}

            @include('admin.message')
            <div class="form-group">
              <label for="exampleInputUsername1">Email</label>
              <input type="email" class="form-control"  value="{{$vendorDetails['vendor_personal']['email'] }}" readonly="" id="exampleInputUsername1" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="vendor_name">Vendor Name</label>
                <input type="phone" class="form-control" name="vendor_name" id="vendor_name" value="{{$vendorDetails['vendor_personal']['name'] }}" placeholder="Enter Name" readonly="" >
              </div>
              <div class="form-group">
                <label for="vendor_address">Address</label>
                <input type="phone" class="form-control" name="vendor_address" id="vendor_address" value="{{$vendorDetails['vendor_personal']['address'] }}" placeholder="Address" readonly="">
              </div>
              <div class="form-group">
                <label for="vendor_city">City </label>
                <input type="phone" class="form-control" name="vendor_city" id="vendor_city" value="{{$vendorDetails['vendor_personal']['city'] }}"  placeholder="City" readonly="">
              </div>

              <div class="form-group">
                <label for="vendor_state">State</label>
                <input type="phone" class="form-control" name="vendor_state" id="vendor_state" value="{{$vendorDetails['vendor_personal']['state'] }}" placeholder="State" readonly="">
              </div>
              <div class="form-group">
                <label for="vendor_country">Country</label>
                <input type="phone" class="form-control" name="vendor_country" id="vendor_country"value="{{$vendorDetails['vendor_personal']['country'] }} }}" placeholder="Country" readonly="">
              </div>
              <div class="form-group">
                <label for="vendor_pincode">PinCode</label>
                <input type="phone" class="form-control" name="vendor_pincode" id="vendor_pincode" value="{{$vendorDetails['vendor_personal']['pincode'] }}" placeholder="PinCode" readonly="">
              </div>
              <div class="form-group">
                <label for="vendor_mobile">Mobile</label>
                <input type="phone" class="form-control" name="vendor_mobile" value="{{$vendorDetails['vendor_personal']['mobile'] }}" id="vendor_mobile" placeholder="Mobile" readonly="">
              </div>
              @if (!empty($vendorDetails['image']))
              <div class="form-group">
                <label for="vendor_image">Admin Image</label>
                   <br>
                   <img style="width: 200px" src="{{ url('admin/uploads/admins/'.$vendorDetails['image']) }}">


              </div>
              @endif

            </div>
        </div>

        </div>



    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Bussiness Information</h4>
            {{-- <p class="card-description">
              Basic form layout
            </p> --}}

              @include('admin.message')
              <div class="form-group">
                  <label for="vendor_name">Shop Name</label>
                  <input type="phone" class="form-control" name="vendor_name" id="vendor_name" value="{{$vendorDetails['vendor_bussiness']['shop_name'] }}" placeholder="Enter Name" readonly="" >
                </div>
                <div class="form-group">
                  <label for="vendor_address">Shop Address</label>
                  <input type="phone" class="form-control" name="vendor_address" id="vendor_address" value="{{$vendorDetails['vendor_bussiness']['shop_address'] }}" placeholder="Address" readonly="">
                </div>
                <div class="form-group">
                  <label for="vendor_city">Shop City </label>
                  <input type="phone" class="form-control" name="vendor_city" id="vendor_city" value="{{$vendorDetails['vendor_bussiness']['shop_city'] }}"  placeholder="City" readonly="">
                </div>

                <div class="form-group">
                  <label for="vendor_state"> Shop State</label>
                  <input type="phone" class="form-control" name="vendor_state" id="vendor_state" value="{{$vendorDetails['vendor_bussiness']['shop_state'] }}" placeholder="State" readonly="">
                </div>
                <div class="form-group">
                  <label for="vendor_country">Shop Country</label>
                  <input type="phone" class="form-control" name="vendor_country" id="vendor_country"value="{{$vendorDetails['vendor_bussiness']['shop_country'] }}" placeholder="Country" readonly="">
                </div>
                <div class="form-group">
                  <label for="vendor_pincode">Shop PinCode</label>
                  <input type="phone" class="form-control" name="vendor_pincode" id="vendor_pincode" value="{{$vendorDetails['vendor_bussiness']['shop_pincode'] }}" placeholder="PinCode" readonly="">
                </div>
                <div class="form-group">
                  <label for="vendor_mobile">Shop Mobile</label>
                  <input type="phone" class="form-control" name="vendor_mobile" value="{{$vendorDetails['vendor_bussiness']['shop_mobile'] }}" id="vendor_mobile" placeholder="Mobile" readonly="">
                </div>
                <div class="form-group">
                    <label for="vendor_mobile">Shop Website</label>
                    <input type="phone" class="form-control" name="vendor_mobile" value="{{$vendorDetails['vendor_bussiness']['shop_website'] }}" id="vendor_mobile" placeholder="Mobile" readonly="">
                  </div>
                  <div class="form-group">
                    <label for="vendor_mobile">Shop Email</label>
                    <input type="phone" class="form-control" name="vendor_mobile" value="{{$vendorDetails['vendor_bussiness']['shop_email'] }}" id="vendor_mobile" placeholder="Mobile" readonly="">
                  </div>
                  <div class="form-group">
                    <label for="vendor_mobile">Shop Address Proof</label>
                    <input type="phone" class="form-control" name="vendor_mobile" value="{{$vendorDetails['vendor_bussiness']['address_proof'] }}" id="vendor_mobile" placeholder="Mobile" readonly="">
                  </div>
                  <div class="form-group">
                    <label for="vendor_mobile">Shop Bussiness License Number</label>
                    <input type="phone" class="form-control" name="vendor_mobile" value="{{$vendorDetails['vendor_bussiness']['bussiness_license_number'] }}" id="vendor_mobile" placeholder="Mobile" readonly="">
                  </div>
                  <div class="form-group">
                    <label for="vendor_mobile">Shop GST Number</label>
                    <input type="phone" class="form-control" name="vendor_mobile" value="{{$vendorDetails['vendor_bussiness']['gst_number'] }}" id="vendor_mobile" placeholder="Mobile" readonly="">
                  </div>
                  <div class="form-group">
                    <label for="vendor_mobile">Shop PAN Number</label>
                    <input type="phone" class="form-control" name="vendor_mobile" value="{{$vendorDetails['vendor_bussiness']['pan_number'] }}" id="vendor_mobile" placeholder="Mobile" readonly="">
                  </div>
                  @if (!empty($vendorDetails['vendor_bussiness']['address_proof_image']))
                  <div class="form-group">
                      <label for="vendor_image">Admin Image</label>
                      <br>
                      <img style="width: 200px" src="{{ url('admin/uploads/admins/proofs/'.$vendorDetails['vendor_bussiness']['address_proof_image']) }}">
                  </div>
              @endif

              </div>
          </div>

          </div>







    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Bank Information</h4>
            {{-- <p class="card-description">
              Basic form layout
            </p> --}}

              @include('admin.message')
              <div class="form-group">
                <label for="exampleInputUsername1">Account Holder Name</label>
                <input type="email" class="form-control"  value="{{$vendorDetails['vendor_bank']['account_holder_name'] }}" readonly="" id="exampleInputUsername1" placeholder="Username">
              </div>
              <div class="form-group">
                  <label for="vendor_name">Bank Name</label>
                  <input type="phone" class="form-control" name="vendor_name" id="vendor_name" value="{{$vendorDetails['vendor_bank']['bank_name'] }}" placeholder="Enter Name" readonly="" >
                </div>
                <div class="form-group">
                  <label for="vendor_address">Account Number</label>
                  <input type="phone" class="form-control" name="vendor_address" id="vendor_address" value="{{$vendorDetails['vendor_bank']['account_number'] }}" placeholder="Address" readonly="">
                </div>
                <div class="form-group">
                  <label for="vendor_city">Bank IFSC Code </label>
                  <input type="phone" class="form-control" name="vendor_city" id="vendor_city" value="{{$vendorDetails['vendor_bank']['bank_ifsc_code'] }}"  placeholder="City" readonly="">
                </div>

              </div>
          </div>

          </div>



      </div>

    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <!-- partial -->
    @include('admin.layout.footer')

  </div>
  @endsection

  @section('script')


  @endsection

