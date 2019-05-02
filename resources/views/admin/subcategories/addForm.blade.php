<form action="/user/admin/subcategories" method="POST" id="basicform" data-parsley-validate="">
    @csrf
    <div class="form-group">
        <label for="subCategoryName">Sub Category Title :</label>
        <input id="subCategoryName" type="text" name="sub_category_name" data-parsley-trigger="change" required="" placeholder="Type here..." autocomplete="off" class="form-control">
    </div>
    <div class="form-group">
        <label for="category">Parent Category :</label>
        <select name="category_id" id="category" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="text-danger mt-1" role="alert">
                    <strong>{{ $error }}</strong>
                </p>
            @endforeach
        @endif
    </div>
    <div class="row">
        <div class="col-12">
            <p class="text-right">
                <button type="submit" class="btn btn-space btn-primary">Add</button>
                <button type="reset" class="btn btn-space btn-secondary">Cancel</button>
            </p>
        </div>
    </div>
</form>