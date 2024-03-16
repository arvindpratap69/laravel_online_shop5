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

      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Update Admin Password</h4>
          {{-- <p class="card-description">
            Basic form layout
          </p> --}}
          <form class="forms-sample" action="{{ route('admin.update_details') }}"  name="updateAdminDetailsForm" id="updateAdminDetailsForm" method="post" enctype="multipart/form-data">
            @csrf
            @include('admin.message')
            <div class="form-group">
              <label for="exampleInputUsername1">Admin Username/Email</label>
              <input type="email" class="form-control"  value="{{ Auth::guard('admin')->user()->email }}" readonly="" id="exampleInputUsername1" placeholder="Username">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Admin Type</label>
              <input type="text" class="form-control"  value="{{ Auth::guard('admin')->user()->type }}" readonly="" placeholder="Email">

            </div>

            <div class="form-group">
                <label for="admin_name">Admin Name</label>
                <input type="phone" class="form-control" name="admin_name" id="admin_name" value="{{ Auth::guard('admin')->user()->name }}" placeholder="Enter Name">
              </div>


            <div class="form-group">
                <label for="admin_mobile">Admin PhoneNo</label>
                <input type="phone" class="form-control" name="admin_mobile" id="admin_mobile" value="{{ Auth::guard('admin')->user()->mobile }}" placeholder="Enter PhoneNumber" required>
                @error('admin_mobile')
                 <p class="inavlid-feedback">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="admin_image">Admin Image</label>
                <input type="file" class="form-control" name="admin_image" id="admin_image">
                  @if (!empty(Auth::guard('admin')->user()->image))
                   <a target="_blank" href="{{ url('admin/uploads/admins/'.Auth::guard('admin')->user()->image) }}">View Image</a>
                   <input type="hidden" name="current_image" id="" value="{{ Auth::guard('admin')->user()->image }}">
                  @endif
              </div>
            <button type="submit" class="btn btn-primary mt-4 mr-2">Submit</button>
            <button class="btn btn-light mt-4">Cancel</button>
          </form>
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
  {{-- <script>
     $("#updateAdminDetailsForm").submit(function(event){
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url:"{{ route('admin.update_details') }}",
            type:'post',
            data: element.serializeArray(),
            datatype:'json',
            acceptedFiles:"image/jpeg,image/png,image/gif",
            success:function(response){
                if(file,response['status'] == true){
                    $("button[type=submit]").prop('disabled', true);
                   window.location.href = "{{ route('admin.update_details') }}";
                }else{
                    var errors = response['errors'];
                        if (errors['admin_name']){
                            $("#admin_name").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors['admin_name']);
                        } else {
                            $('#admin_name').removeClass('is-invalid')
                                .siblings('p').removeClass('invalid-feedback')
                                .html("");
                        }
                        if (errors['admin_mobile']) {
                            $('#admin_mobile').addClass('is-invalid')
                                .siblings('p').addClass('invalid-feedback')
                                .html(errors['admin_mobile']);
                        } else {
                            $('#admin_mobile').removeClass('is-invalid')
                                .siblings('p').removeClass('invalid-feedback')
                                .html("");
                        }
                }

            }, error:function(jqXHR,exception){
                console.log("Something Went wrong");
            }
        })
     }); --}}
 </script>

  @endsection

