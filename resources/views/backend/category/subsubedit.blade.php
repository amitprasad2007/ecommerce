@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Sub SubCategory</h5>
    <div class="card-body">
      <form method="post" action="{{route('category.update', $category->id)}}">
          <input type="hidden" name="subsubcat" value="1">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{ $category->title }}" class="form-control">
          @error('title')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary</label>
          <textarea class="form-control" id="summary" name="summary">{{ $category->summary }}</textarea>
          @error('summary')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div> 

        <div class="form-group {{ $category->is_parent == 1 ? 'd-none' : '' }}" id='parent_cat_div'>
          <label for="parent_id">Parent Category</label>
          <select name="parent_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($parent_cats as $key => $parent_cat)
                  <option value='{{ $parent_cat->id }}' {{ $parent_cat->id == $category->parent_id ? 'selected' : '' }}>{{ $parent_cat->title }}</option>
              @endforeach
          </select>
          @error('parent_id')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group {{ $category->parent_id ? '' : 'd-none' }}" id='sub_cat_div'>
          <label for="sub_cat_id">Sub Category</label>
          <select name="sub_cat_id" class="form-control">
              <option value="">--Select any subcategory--</option>
              @foreach($sub_cats as $key => $sub_cat)
                  <option value='{{ $sub_cat->id }}' {{ $sub_cat->id == $category->sub_cat_id ? 'selected' : '' }}>{{ $sub_cat->title }}</option>
              @endforeach
          </select>
          @error('sub_cat_id')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo</label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
              <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ $category->photo }}">
          </div>
          <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
          @error('status')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
        $('#summary').summernote({
            placeholder: "Write short description.....",
            tabsize: 2,
            height: 150
        });
        
        // Populate subcategories on page load
        var parentId = $('select[name="parent_id"]').val();
        var subCatId = '{{ $category->sub_cat_id }}';
        if (parentId) {
            fetchSubCategories(parentId, subCatId);
        }

        $('#parent_cat_div select').change(function() {
            var parentId = $(this).val();
            if (parentId != '') {
                fetchSubCategories(parentId, null);
            } else {
                $('#sub_cat_div').addClass('d-none');
                $('#sub_cat_div select').empty();
                $('#sub_cat_div select').append('<option value="">--Select any subcategory--</option>');
            }
        });
    });

    function fetchSubCategories(parentId, subCatId) {
        $.ajax({
            url: '{{ url("admin/category/get-subcategories") }}/' + parentId,
            type: 'GET',
            success: function(response) {
                $('#sub_cat_div select').empty();
                $('#sub_cat_div select').append('<option value="">--Select any subcategory--</option>');
                $.each(response, function(key, subcat) {
                    var selected = subCatId == subcat.id ? 'selected' : '';
                    $('#sub_cat_div select').append('<option value="' + subcat.id + '" ' + selected + '>' + subcat.title + '</option>');
                });
                $('#sub_cat_div').removeClass('d-none');
            }
        });
    }
</script>
@endpush
