<form 
  action="/user/admin/products/{{ $product_id }}/images/{{ $productImage->product_image_id }}" 
  method="POST" 
  id="basicform" 
  data-parsley-validate="" 
  enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="productSpecificationName">Product Image:</label>
      <input 
        id="productSpecificationName" 
        type="file" 
        name="product_image" 
        data-parsley-trigger="change" 
        placeholder="Type here..." 
        autocomplete="off" 
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
        <option value="1" {{ $productImage->is_featured == 1 ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ $productImage->is_featured == 0 ? 'selected' : '' }}>No</option>
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
          <input type="hidden" name="_method" value="PATCH">
          <button type="submit" class="btn btn-primary btn-space">Update</button>
          <a 
            href="/user/admin/products/{{ $product_id }}/images" 
            class="btn btn-space btn-light">
              Cancel
          </a>
        </p>
      </div>
    </div>
</form>