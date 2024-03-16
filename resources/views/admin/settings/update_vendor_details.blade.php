@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold">Settings</h3>
              {{-- <h6 class="font-weight-normal mb-0">Update Admin Password </h6> --}}
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

      @if($slug == "personal")
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Update Vendor Details</h4>
          {{-- <p class="card-description">
            Basic form layout
          </p> --}}
          <form class="forms-sample" action="{{ route('vendor.update-details',$slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('admin.message')
            <div class="form-group">
              <label for="exampleInputUsername1">Vendor Username/Email</label>
              <input type="email" class="form-control"  value="{{ Auth::guard('admin')->user()->email }}" readonly="" id="exampleInputUsername1" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="vendor_name">Vendor Name</label>
                <input type="phone" class="form-control" name="vendor_name" id="vendor_name" value="{{ Auth::guard('admin')->user()->name }}" placeholder="Enter Name">
              </div>
              <div class="form-group">
                <label for="vendor_address">Address</label>
                <input type="phone" class="form-control" name="vendor_address" id="vendor_address" value="{{ $vendorDetail['address'] }}" placeholder="Address">
              </div>
              <div class="form-group">
                <label for="vendor_city">City </label>
                <input type="phone" class="form-control" name="vendor_city" id="vendor_city" value="{{ $vendorDetail['city'] }}"  placeholder="City">
              </div>

              <div class="form-group">
                <label for="vendor_state">State</label>
                <input type="phone" class="form-control" name="vendor_state" id="vendor_state" value="{{ $vendorDetail['state'] }}" placeholder="State">
              </div>
              <div class="form-group">
                <label for="vendor_country">Country</label>
                {{-- <input type="phone" class="form-control" name="vendor_country" id="vendor_country" value="{{ $vendorDetail['country'] }}" placeholder="Country"> --}}
                <select class="form-control" name="vendor_country" id="vendor_country" style="color:#495057">
                    <option value="">Select the Country</option>
                    @foreach ($countries as $country)
                    <option value="{{ $country['country_name'] }}" @if ($country['country_name']==$vendorDetail['country']) selected @endif>{{ $country['country_name'] }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="vendor_pincode">PinCode</label>
                <input type="phone" class="form-control" name="vendor_pincode" id="vendor_pincode" value="{{ $vendorDetail['pincode'] }}" placeholder="PinCode">
              </div>
              <div class="form-group">
                <label for="vendor_mobile">Mobile</label>
                <input type="phone" class="form-control" name="vendor_mobile" value="{{ $vendorDetail['mobile'] }}" id="vendor_mobile" placeholder="Mobile">
              </div>
              <div class="form-group">
                <label for="vendor_image">Admin Image</label>
                <input type="file" class="form-control" name="vendor_image" id="vendor_image">
                  @if (!empty(Auth::guard('admin')->user()->image))
                   <a target="_blank" href="{{ url('admin/uploads/admins/'.Auth::guard('admin')->user()->image) }}">View Image</a>
                   <input type="hidden" name="current_vendor_image" id="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
                  @endif
              </div>
            <button type="submit" class="btn btn-primary mt-4 mr-2">Submit</button>
            <button class="btn btn-light mt-4">Cancel</button>
          </form>
        </div>


    </div>
    @elseif ($slug == "bussiness")
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">Update Vendor Bussiness Details</h4>
          {{-- <p class="card-description">
            Basic form layout
          </p> --}}
          <form class="forms-sample" action="{{ route('vendor.update-details',$slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('admin.message')
            <div class="form-group">
                <label for="vendor_shop_name">Shop Name</label>
                <input type="phone" class="form-control" name="vendor_shop_name" id="vendor_shop_name" value="{{ $vendorDetails['shop_name'] }}" placeholder="Enter Shop Name">
              </div>
              <div class="form-group">
                <label for="vendor_shop_address">Shop Address</label>
                <input type="phone" class="form-control" name="vendor_shop_address" id="vendor_shop_address" value="{{ $vendorDetails['shop_address'] }}" placeholder="Shop Address">
              </div>
              <div class="form-group">
                <label for="vendor_shop_city">Shop City</label>
                <input type="phone" class="form-control" name="vendor_shop_city" id="vendor_shop_city" value="{{ $vendorDetails['shop_city'] }}" placeholder="Address">
              </div>

              <div class="form-group">
                <label for="vendor_shop_state">Shop State</label>
                <input type="phone" class="form-control" name="vendor_shop_state" id="vendor_shop_state" value="{{ $vendorDetails['shop_state'] }}" placeholder="Address">
              </div>
              <div class="form-group">
                <label for="vendor_shop_country">Shop Country</label>
                {{-- <input type="phone" class="form-control" name="vendor_shop_country" id="vendor_shop_country" value="{{ $vendorDetails['shop_country'] }}" placeholder="Address"> --}}
                <select class="form-control" name="vendor_shop_country" id="vendor_shop_country">
                    <option value="">Select the Country</option>
                    @foreach ($countries as $country)
                    <option value="{{ $country['country_name'] }}" @if ($country['country_name']==$vendorDetails['shop_country']) selected @endif>{{ $country['country_name'] }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="vendor_shop_pincode">Shop Pincode</label>
                <input type="phone" class="form-control" name="vendor_shop_pincode" id="vendor_shop_pincode" value="{{ $vendorDetails['shop_pincode'] }}" placeholder="Address">
              </div>
              <div class="form-group">
                <label for="vendor_shop_mobile">Shop mobile</label>
                <input type="phone" class="form-control" name="vendor_shop_mobile" id="vendor_shop_mobile" value="{{ $vendorDetails['shop_mobile'] }}" placeholder="Address">
              </div>
              <div class="form-group">
                <label for="vendor_shop_website">Shop Wbesite</label>
                <input type="phone" class="form-control" name="vendor_shop_website" id="vendor_shop_website" value="{{ $vendorDetails['shop_website'] }}" placeholder="Address">
              </div>
              <div class="form-group">
                <label for="vendor_shop_email">Shop Email</label>
                <input type="phone" class="form-control" name="vendor_shop_email" id="vendor_shop_email" value="{{ $vendorDetails['shop_email'] }}" placeholder="Address">
              </div>
              <div class="form-group">
                <label for="vendor_shop_address_proof">Shop Address Proof</label>
                <select class="form-control" name="vendor_shop_address_proof" id="vendor_shop_address_proof">
                    <option value="">Please Select the Address Proof</option>
           <option value="Passport" @if($vendorDetails['address_proof'] == "Passport")selected @endif>Passport</option>
           <option value="Voting Card" @if($vendorDetails['address_proof'] == "Voting Card")selected @endif>Voting Card</option>
           <option value="PAN" @if($vendorDetails['address_proof'] == "PAN")selected @endif>PAN</option>
           <option value="Driving License" @if($vendorDetails['address_proof'] == "Driving License")selected @endif>Driving License</option>
           <option value="Aadhar Card" @if($vendorDetails['address_proof'] == "Aadhar Card")selected @endif>Aadhar Card</option>
                </select>
              </div>
              <div class="form-group">
                <label for="vendor_shop_bussiness_license_number">Shop Bussiness Licesnse Number</label>
                <input type="phone" class="form-control" name="vendor_shop_bussiness_license_number" id="vendor_shop_bussiness_license_number" value="{{ $vendorDetails['bussiness_license_number'] }}" placeholder="Bussiness License Number">
              </div>
              <div class="form-group">
                <label for="gst_number">Shop Gst Number</label>
                <input type="phone" class="form-control" name="gst_number" id="gst_number" value="{{ $vendorDetails['gst_number'] }}" placeholder="Gst Number">
              </div>
              <div class="form-group">
                <label for="pan_number">Pan Number</label>
                <input type="phone" class="form-control" name="pan_number" id="pan_number" value="{{ $vendorDetails['pan_number'] }}" placeholder="Pan Number">
              </div>
              <div class="form-group">
                <label for="address_proof_image">Address Proof Image</label>
                <input type="file" class="form-control" name="address_proof_image" id="address_proof_image">
                @if (!empty($vendorDetails['address_proof_image']))
                <a target="_blank" href="{{ url('admin/uploads/admins/proofs/'.$vendorDetails['address_proof_image']) }}">View Image</a>
                <input type="hidden" name="current_address_proof" id="current_address_proof" value="{{ $vendorDetails['address_proof_image'] }}">
               @endif
              </div>
            <button type="submit" class="btn btn-primary mt-4 mr-2">Submit</button>
            <button class="btn btn-light mt-4">Cancel</button>
          </form>
        </div>


    </div>
    @elseif ($slug == "bank")
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">Update Bank Details</h4>
          {{-- <p class="card-description">
            Basic form layout
          </p> --}}
          <form class="forms-sample" action="{{ route('vendor.update-details',$slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('admin.message')
            <div class="form-group">
              <label for="exampleInputUsername1">Vendor Username/Email</label>
              <input type="email" class="form-control"  value="{{ Auth::guard('admin')->user()->email }}" readonly="" id="exampleInputUsername1" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="account_holder_name">Acoount Holder Name</label>
                <input type="text" class="form-control" name="account_holder_name" id="account_holder_name" value="{{ $vendorBankDetails['account_holder_name'] }}" placeholder="Enter Name">
              </div>
              <div class="form-group">
                <label for="bank_name">Bank Name</label>
                <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{ $vendorBankDetails['bank_name'] }}" placeholder="Bank Name">
              </div>
              <div class="form-group">
                <label for="account_number">Account Number</label>
                <input type="text" class="form-control" name="account_number" id="account_number" value="{{ $vendorBankDetails['account_number'] }}"  placeholder="Account Number">
              </div>

              <div class="form-group">
                <label for="bank_ifsc_code">Bank IFSC Code</label>
                <input type="text" class="form-control" name="bank_ifsc_code" id="bank_ifsc_code" value="{{ $vendorBankDetails['bank_ifsc_code'] }}" placeholder="Bnak IFSC Code">
              </div>
            <button type="submit" class="btn btn-primary mt-4 mr-2">Submit</button>
            <button class="btn btn-light mt-4">Cancel</button>
          </form>
        </div>


    </div>
    @endif
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <!-- partial -->
    @include('admin.layout.footer')

  </div>
  @endsection

  @section('script')


  @endsection

