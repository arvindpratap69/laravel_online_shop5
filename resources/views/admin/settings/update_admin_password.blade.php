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
          <form class="forms-sample" action=""  name="updatePasswordForm" id="updatePasswordForm" method="post">
            @include('admin.message')
            <div class="form-group">
              <label for="exampleInputUsername1">Admin Username/Email</label>
              <input type="text" class="form-control" readonly="" value="{{ $admin['email'] }}" id="exampleInputUsername1" placeholder="Username">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Admin Type</label>
              <input class="form-control" id="exampleInputEmail1" value="{{ $admin['type'] }}" readonly="" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="current_password">Current Password</label>
              <input type="password" class="form-control" name="current_password" id="current_password"  placeholder="Current Password" >
<p></p>
            </div>
            <p></p>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" id="new_password" placeholder="New Password" >
<p></p>
              </div>
            <div class="form-group">
              <label for="confirm_password">Confirm Password</label>
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" >
<p></p>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button class="btn btn-light">Cancel</button>
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
  <script>
     $("#updatePasswordForm").submit(function(event){
        event.preventDefault();
        var element = $(this);

        $.ajax({
            url:'{{ route('admin.update-password') }}',
            type:'post',
            data: {
                current_password: $('#current_password').val(),
                  new_password: $('#new_password').val(),
                 confirm_password: $('#confirm_password').val(),
            },
            datatype:'json',
            success:function(response){
                if(response['status'] == true){
                   window.location.href = "{{ route('admin.password') }}";
                }else{
                    var errors = response['errors'];
                        if (errors['current_password']){
                            $("#current_password").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors['current_password']);
                        } else {
                            $('#current_password').removeClass('is-invalid')
                                .siblings('p').removeClass('invalid-feedback')
                                .html("");
                        }
                        if (errors['new_password']) {
                            $('#new_password').addClass('is-invalid')
                                .siblings('p').addClass('invalid-feedback')
                                .html(errors['new_password']);
                        } else {
                            $('#new_password').removeClass('is-invalid')
                                .siblings('p').removeClass('invalid-feedback')
                                .html("");
                        }
                        if (errors['confirm_password']) {
                            $('#confirm_password').addClass('is-invalid')
                                .siblings('p').addClass('invalid-feedback')
                                .html(errors['confirm_password']);
                        } else {
                            $('#confirm_password').removeClass('is-invalid')
                                .siblings('p').removeClass('invalid-feedback')
                                .html("");
                        }
                }

            }, error:function(jqXHR,exception){
                console.log("Something Went wrong");
            }
        })
     });
  </script>

  @endsection

