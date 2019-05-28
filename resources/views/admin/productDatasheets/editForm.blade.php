<form 
  action="/user/admin/products/{{ $product_id }}/colors/{{ $color->product_color_id }}" 
  method="POST" 
  id="basicform" 
  data-parsley-validate="" 
  enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="productColorName">Product Color Name:</label>
      <input 
        id="productColorName" 
        type="text" 
        name="color_name" 
        data-parsley-trigger="change" 
        placeholder="Type here..." 
        autocomplete="off" 
        class="form-control @error('color_name') is-invalid @enderror"
        value="{{ old('color_name') ? old('color_name') : $color->color_name }}">
        @error('color_name')
          <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </div>
        @enderror
    </div>
    <div class="form-group">
      <label for="productColor">Product Color:</label>
      <input 
        id="productColor" 
        type="color" 
        name="product_color"
        class="form-control @error('color_name') is-invalid @enderror"
        style="height: 3rem; max-width: 125px"
        value="{{ old('product_color') ? old('product_color') : $color->product_color }}">
      @error('product_color')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
      @enderror
    </div>
    <div class="row">
      <div class="col-12">
        <p class="text-right mb-3 mt-3">
          <input type="hidden" name="_method" value="PATCH">
          <button type="submit" class="btn btn-primary btn-space">Update</button>
          <a 
            href="/user/admin/products/{{ $product_id }}/colors" 
            class="btn btn-space btn-light">
              Cancel
          </a>
        </p>
      </div>
    </div>
</form>