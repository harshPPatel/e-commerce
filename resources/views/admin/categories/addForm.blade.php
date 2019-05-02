<form action="/user/admin/categories" method="post" id="basicform" data-parsley-validate="">
    @csrf
    <div class="form-group">
        <label for="categoryName">Category Title :</label>
        <input id="categoryName" type="text" name="category_name" data-parsley-trigger="change" required="" placeholder="Type here..." autocomplete="off" class="form-control">
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