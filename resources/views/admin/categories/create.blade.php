@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h4 class="font-weight-normal mb-0">Categories </h4>
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

      <div class="col-sm-12 text-right">
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>

    </div>
      <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Category</h4>

          {{-- <p class="card-description">
            Basic form layout
          </p> --}}
          <form class="forms-sample" action = "{{ route('categories.store') }}"  method="post" enctype="multipart/form-data">
            @csrf
            @include('admin.message')


            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" id="category_name"  placeholder="Enter Category Name">
                @error('category_name')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
             </div>

             <div class="form-group">
                <label for="section_id">Select Section</label>
                <select name="section_id" id="section_id" class="form-control @error('section_id') is-invalid @enderror" style="color: #000">
                   <option value="">Select the Section</option>
                   @foreach ($getSections as $section)
                   <option value="{{ $section->id }}">{{ $section->name }}</option>
                   @endforeach
                </select>
                @error('section_id')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
             </div>

             <div id="appendCategoriesLevel">
                @include('admin.categories.append_categories_level')
                            </div>
             <div class="form-group">
                <label for="category_discount">Category Discount</label>
                <input type="text" class="form-control @error('category_discount') is-invalid @enderror" name="category_discount" id="category_discount"  placeholder="Enter Category Discount">
                @error('category_discount')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
             </div>
             <div class="form-group">
                <label for="category_description">Category Description</label>
                <textarea class="form-control @error('category_description') is-invalid @enderror" id="category_description" name="category_description" rows="3" placeholder="Enter Category Description"></textarea>
                @error('category_description')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="category_url">Category URL</label>
                <input type="text" class="form-control @error('category_url') is-invalid @enderror" name="category_url" id="category_url"  placeholder="Enter Category URL">
                @error('category_url')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
             </div>
             <div class="form-group">
                <label for="meta_title">Meta Title</label>
                <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" id="meta_title"  placeholder="Enter Meta Title">
                @error('meta_title')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
             </div>
             <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <input type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description"  placeholder="Enter Meta Descrition">
                @error('meta_description')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
             </div>
             <div class="form-group">
                <label for="meta_keywords">Meta Keywords</label>
                <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" id="meta_keywords"  placeholder="Enter Meta Keywords">
                @error('meta_keywords')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
             </div>
             <div class="form-group">
                <label for="categories_image">Category Image</label>
               <input type="file" name="categories_image" id="categories_image" class="form-control @error('categories_image') is-invalid @enderror">
                @error('categories_image')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
             </div>
            <button type="submit" class="btn btn-primary mt-4 mr-2">Submit</button>
            <a class="btn btn-danger mt-4" href="{{ route('categories.index') }}">Cancel</a>
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
  $("#section_id").change(function(){
//   console.log("Event triggered"); // Check if the event is being triggered
  var section_id = $(this).val();
//   console.log(section_id); // Check the value of section_id
//   alert(section_id);
  $.ajax({
           type:'get',
           url: "{{ route('append-categories.level') }}",
           data:{section_id : section_id},
           success: function(resp){
               alert(resp);
             $("#appendCategoriesLevel").html(resp);
           },errror:function(){
               alert("Error");
           }
       })
});


  </script>


  @endsection

