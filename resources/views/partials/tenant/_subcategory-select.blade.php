<select name="subcategory" id="subcategory" class="form-control js-example-basic-single">
    @foreach ($subs as $sub)
        <option value="{{$sub->id}}">{{$sub->sub_category_name ?? ''}}</option>
    @endforeach
</select>
