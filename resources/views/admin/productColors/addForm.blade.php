<form 
  action="/user/admin/products/{{ $product_id }}/colors" 
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
        class="form-control @error('color_name') is-invalid @enderror">
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
        value="#0e0c28">
      @error('product_color')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
      @enderror
    </div>
    <div class="row">
      <div class="col-12">
        <p class="text-right mb-3 mt-3">
          <button type="submit" class="btn btn-primary btn-space">Add</button>
          <button type="reset" class="btn btn-space btn-light">Reset</button>
        </p>
      </div>
    </div>
</form>