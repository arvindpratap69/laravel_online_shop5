@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                <h3 class="font-weight-bold">Catelogue Management</h3>
                <h4 class="font-weight-normal mb-0">Categories </h4>                  {{-- <p class="card-description">
                     Add class <code>.table-bordered</code>
                  </p> --}}
                  @include('admin.message')
                  <a style="max-width: 150px; float:right; display:inline-block;" href="{{ route('categories.create') }}" class="btn btn-block btn-primary">Add Category</a>

                  <div class="table-responsive pt-3">
                     <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th>
                                 Id
                              </th>
                              <th>
                                Category Name
                              </th>
                              <th>
                               Parent Category
                              </th>
                              <th>
                                Section
                              </th>
                              <th>
                               Url
                              </th>
                              <th>
                                Category Status
                              </th>
                              <th>
                                 Actions
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                      @if (!empty($categories))
                           @foreach ($categories as $category)
                           @if(isset($category->parentcategory->category_name)&&!empty($category->parentcategory->category_name))
                         @php  $parent_category =$category->parentcategory->category_name; @endphp
                           @else
                         @php  $parent_category ="Root"; @endphp
                           @endif
                           <tr>
                              <td>
                                {{ $category->id }}
                              </td>
                              <td>
                                {{ $category->category_name }}
                              </td>
                              <td>
                                 {{ $parent_category }}
                              </td>
                              <td>
                                {{ $category->section->name ?? 'No Section' }}
                              </td>
                              <td>
                                {{ $category->url }}
                              </td>

                              <td>
                                @if ($category['status'] == 1)
                              <a class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id = "{{ $category['id'] }}" href="javascript:void(0)"><i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i></a>
                                            @else
                                            <a class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id = "{{ $category['id'] }}" href="javascript:void(0)"><i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i></a>
                                      @endif
                              </td>
                              <td>
                                <a href="{{ route('categories.edit',$category->id) }}">
                                    <i style="font-size: 25px;" class="mdi mdi-pencil-box"></i>
                                </a>
                                <a href="javascript:void(0)" class="confirmDelete" module="category" moduleid = "{{ $category->id }}">
                                    <i style="font-size: 25px; color:red" class="mdi mdi-delete"></i>
                                </a>
                            </td>
                           </tr>
                           @endforeach
                           @else
                           <tr>
                            <td colspan="8" class="text-center">Records Not Found</td>
                           </tr>
                           @endif
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- content-wrapper ends -->
   <!-- partial:../../partials/_footer.html -->
   <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
         <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
         <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
      </div>
   </footer>
   <!-- partial -->
</div>
@endsection
@section('script')
<script>
    // update adnin status
    $(document).ready(function(){
    $(document).on("click",".updateCategoryStatus",function(){
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");
        // alert(admin_id);

        $.ajax({
            url:"/admin/update-category-status",
            type:"post",
            data:{status:status,category_id:category_id},
            success:function(resp){
                // alert(resp);
                if(resp['status'] == 0){
                    $('#category-'+category_id).html("<i style='font-size: 25px' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
                }if(resp['status'] == 1){
                    $('#category-'+category_id).html("<i style='font-size: 25px' class='mdi mdi-bookmark-check' status='Active'></i>");
                }
            },error:function(){
                alert("error");
            }

        })
    });


});

</script>
<script>
       // Confirm Deletion (Sweat Alert Library)
       $(".confirmDelete").click(function(){
        var module = $(this).attr("module");
        var moduleid = $(this).attr("moduleid");
        Swal.fire({
  title: "Are you sure?",
  text: "You won't delete this Section!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: "Deleted!",
      text: "Your Section has been deleted.",
      icon: "success"
    });
    window.location = "/admin/delete-"+module+"/"+moduleid;
  }
});
    });
</script>
{{-- <script>
    // Confirm Deletion (Sweat Alert Library)
    $(".confirmDelete").click(function(){
     var module = $(this).attr("module");
     var moduleid = $(this).attr("moduleid");
     Swal.fire({
title: "Are you sure?",
text: "You won't delete this Section!",
icon: "warning",
showCancelButton: true,
confirmButtonColor: "#3085d6",
cancelButtonColor: "#d33",
confirmButtonText: "Yes, delete it!"
}).then((result) => {
if (result.isConfirmed) {
 Swal.fire({
   title: "Deleted!",
   text: "Your Section has been deleted.",
   icon: "success"
 });
 window.location = "/admin/delete-"+module+"/"+moduleid;
}
});
 });
</script> --}}
@endsection





{{-- Differentiate between require and include --}}
{{-- What is PHP? --}}
{{-- Differentiate between PHP4 and PHP5. --}}
