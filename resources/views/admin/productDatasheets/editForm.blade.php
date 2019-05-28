<form 
  action="/user/admin/products/{{ $product_id }}/datasheets/{{ $productDatasheet->product_datasheet_id }}" 
  method="POST" 
  id="basicform" 
  data-parsley-validate="" 
  enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="productSpecificationName">Product Specification Name:</label>
      <input 
        id="productSpecificationName" 
        type="text" 
        name="specification_name" 
        data-parsley-trigger="change" 
        placeholder="Type here..." 
        autocomplete="off" 
        class="form-control @error('specification_name') is-invalid @enderror"
        value="{{ old('specification_name') ? old('specification_name') : $productDatasheet->specification_name }}">
        @error('specification_name')
          <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </div>
        @enderror
    </div>
    <div class="form-group">
      <label for="productSpecificationValue">Product Specification Value:</label>
      <input 
        id="productSpecificationValue" 
        type="text" 
        name="specification_value" 
        data-parsley-trigger="change" 
        placeholder="Type here..." 
        autocomplete="off" 
        class="form-control @error('specification_value') is-invalid @enderror"
        value="{{ old('specification_value') ? old('specification_value') : $productDatasheet->specification_value }}">
      @error('specification_value')
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
            href="/user/admin/products/{{ $product_id }}/datasheets" 
            class="btn btn-space btn-light">
              Cancel
          </a>
        </p>
      </div>
    </div>
</form>