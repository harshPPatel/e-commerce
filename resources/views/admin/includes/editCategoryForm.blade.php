<form action="/user/admin/categories/{{ $category->category_id }}" method="post" id="basicform" data-parsley-validate="">
    @csrf
    <div class="form-group">
        <label for="categoryName">Edit Category Title :</label>
        <input id="categoryName" type="text" name="category_name" data-parsley-trigger="change" required="" placeholder="Type here..." autocomplete="off" class="form-control" value="{{ $category->category_name }}">
        @if($errors->any())
        @foreach($errors->all() as $error)
                <p class="text-danger mt-1" role="alert">
                    <strong>{{ $error }}</strong>
                </p>
            @endforeach
        @endif
        <input type="hidden" name="_method" value="PUT">
    </div>
    <div class="row">
        <div class="col-12">
            <p class="text-right">
                <button type="submit" class="btn btn-space btn-primary">Add</button>
                <a role="button" class="btn btn-space btn-secondary" href="/user/admin/categories">Cancel</a>
            </p>
        </div>
    </div>
</form>