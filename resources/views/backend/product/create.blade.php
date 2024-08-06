@extends('backend.layouts.master')

@section('main-content')
<style>
    #image-preview {
        max-width: 300px;
        max-height: 300px;
        display: none;
    }
</style>
<div class="card">
    <h5 class="card-header">Add Product</h5>
    <div class="card-body">
        <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{old('title')}}" class="form-control">
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="is_featured">Is Featured</label><br>
                <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes
            </div>
            <div class="form-group">
                <label for="inputsku" class="col-form-label">SKU <span class="text-danger">*</span></label>
                <input id="inputsku" type="text" name="sku" placeholder="Enter SKU" value="{{old('sku')}}" class="form-control">
                @error('sku')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="cat_id">Category <span class="text-danger">*</span></label>
                <select name="cat_id" id="cat_id" class="form-control">
                    <option value="">--Select any category--</option>
                    @foreach($categories as $key=>$cat_data)
                    <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="slug" class="col-form-label">Slug </label>
                <input id="slug" type="text" name="slug" placeholder="Enter slug" value="{{old('slug')}}" class="form-control">
            </div>
            <div class="form-group d-none" id="child_cat_div">
                <label for="child_cat_id">Sub Category</label>
                <select name="child_cat_id" id="child_cat_id" class="form-control">
                    <option value="">--Select any category--</option>
                </select>
            </div>
            <div class="form-group d-none" id="sub_child_cat_div">
                <label for="sub_child_cat_id">Sub Sub Category</label>
                <select name="sub_child_cat_id" id="sub_child_cat_id" class="form-control">
                    <option value="">--Select any category--</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
                <input id="price" type="number" name="price" placeholder="Enter price" value="{{old('price')}}" class="form-control">
                @error('price')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="discount" class="col-form-label">Discount(%)</label>
                <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount" value="{{old('discount')}}" class="form-control">
                @error('discount')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="brand_id">Brand</label>
                <select name="brand_id" class="form-control">
                    <option value="">--Select Brand--</option>
                    @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="stock">Purchase price <span class="text-danger">*</span></label>
                <input id="purchase_price" type="number" id="purchase_price" name="stock" min="0" placeholder="Enter Purchase price" value="{{old('purchase_price')}}" class="form-control">
                @error('stock')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="stock">Tags</label>
                <input type="text" id="tag" name="tag"  placeholder="Enter Product Tag" value="{{old('tag')}}" class="form-control">
            </div>
            <div class="form-group row ">
                <label for="stock" style="margin-left: 15px;">Tax <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input id="tax" type="number" name="tax" min="0" placeholder="Enter Tax" value="{{old('tax')}}" class="p-2 col-md-5 form-control" style="margin-left: 16px;">
                <select name="taxtype" id="taxtype" class=" p-2 col-md-3 form-control" style="margin-left: 30px;" >
                    <option value="flat">Flat</option>
                    <option value="percent">Percent</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="stock" style="margin-left: 15px;">Discount <span class="text-danger">*</span></label>
                <input id="discount" type="number" name="discount" min="0" placeholder="Enter Discount" value="{{old('discount')}}" class="p-2 col-md-5 form-control" style="margin-left: 16px;">
                <select name="discounttype" id="discounttype"  class=" p-2 col-md-3 form-control" style="margin-left: 30px;" >
                    <option value="flat">Flat</option>
                    <option value="percent">Percent</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stock">Quantity <span class="text-danger">*</span></label>
                <input id="quantity" type="number" name="quantity" min="0" placeholder="Enter quantity" value="{{old('quantity')}}" class="form-control">
                @error('stock')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="stock">Unit<span class="text-danger">*</span></label>
                <select name="unit" id="unit" class="form-control" >
                    <option value="Pices">Pices</option>
                    <option value="Liters">Liters</option>
                    <option value="grams">Grams</option>
                </select>
            </div>
            <div class="form-group">
                <label for="stock">Min Qty <span class="text-danger">*</span></label>
                <input id="minqty" type="number" name="minqty" min="0" placeholder="Enter quantity" value="{{old('minqty')}}" class="form-control">
                @error('stock')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group row">
                <label class="form-group" style="margin-left: 15px;" for="video">Product Videos </label>
                <select name="video_provider" id="video_provider" class="p-2 col-md-4 form-control" style="margin-left: 16px;">
                    <option value="">--Select Video Provider--</option>
                    @foreach($videoproviders as $videoprovider)
                        <option value="{{$videoprovider->id}}">{{$videoprovider->name}}</option>
                    @endforeach
                </select>
                <label class="form-group" style="margin-left: 15px;" for="stock"> Video Link </label>
                <input id="videolink" type="text" name="videolink" min="0" placeholder="Enter Video Link" style="margin-left: 16px;" value="{{old('videolink')}}" class="p-2 col-md-4 form-control">
            </div>
            <div class="form-group">
                <label class="form-group" for="stock">Today's Deal </label>
                <select name="todays_deal" id="todays_deal" class="form-control" >
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <input type="file" name="photo" id="image-input" accept="image/*">
                    </span>
                    @error('photo')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <img id="image-preview" src="#" alt="Image Preview">
            </div>
            <div class="form-group">
                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        $('#description').summernote({
            placeholder: "Write detail description.....",
            tabsize: 2,
            height: 150
        });
    });

    document.getElementById('image-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = document.getElementById('image-preview');
            img.src = e.target.result;
            img.style.display = 'block';
        };

        reader.readAsDataURL(file);
    });

    $('#cat_id').change(function() {
        var cat_id = $(this).val();
        if (cat_id != null) {
            $.ajax({
                url: "/admin/category/" + cat_id + "/child",
                data: {
                    _token: "{{csrf_token()}}",
                    id: cat_id
                },
                type: "POST",
                success: function(response) {
                    if (typeof(response) != 'object') {
                        response = $.parseJSON(response)
                    }
                    var html_option = "<option value=''>----Select sub category----</option>"
                    if (response.status) {
                        var data = response.data;
                        if (data) {
                            $('#child_cat_div').removeClass('d-none');
                            $.each(data, function(id, title) {
                                html_option += "<option value='" + id + "'>" + title + "</option>"
                            });
                        } else {
                            $('#child_cat_div').addClass('d-none');
                        }
                    } else {
                        $('#child_cat_div').addClass('d-none');
                    }
                    $('#child_cat_id').html(html_option);
                }
            });
        }
    });

    $('#child_cat_id').change(function() {
        var child_cat_id = $(this).val();
        if (child_cat_id != null) {
            $.ajax({
                url: "/admin/category/" + child_cat_id + "/subchild",
                data: {
                    _token: "{{csrf_token()}}",
                    id: child_cat_id
                },
                type: "POST",
                success: function(response) {
                    if (typeof(response) != 'object') {
                        response = $.parseJSON(response)
                    }
                    var html_option = "<option value=''>----Select sub sub category----</option>"
                    if (response.status) {
                        var data = response.data;
                        if (data) {
                            $('#sub_child_cat_div').removeClass('d-none');
                            $.each(data, function(id, title) {
                                html_option += "<option value='" + id + "'>" + title + "</option>"
                            });
                        } else {
                            $('#sub_child_cat_div').addClass('d-none');
                        }
                    } else {
                        $('#sub_child_cat_div').addClass('d-none');
                    }
                    $('#sub_child_cat_id').html(html_option);
                }
            });
        }
    });
</script>
@endpush
