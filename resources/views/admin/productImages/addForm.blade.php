<form 
  action="/user/admin/products/{{ $product_id }}/images" 
  method="POST" 
  id="basicform" 
  data-parsley-validate="" 
  role="form"
  enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="productImage">Product Image:</label>
      <input 
        id="productImage" 
        type="file" 
        name="product_image" 
        data-parsley-trigger="change" 
        placeholder="Type here..." 
        autocomplete="off" 
        accept="image/*"
        class="form-control-file @error('product_image') is-invalid @enderror">
      @error('product_image')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="isFeatured">Is Feaetured?</label>
      <select name="is_featured" id="isFeatured" 
        class="form-control @error('is_featured') is-invalid @enderror">
        <option value="1">Yes</option>
        <option value="0" selected>No</option>
      </select>
      @error('is_featured')
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