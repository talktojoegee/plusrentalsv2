@foreach($categories as $cat)
    <div class="checkbox-fade fade-in-primary">
        <label>
            <input type="checkbox" value="{{$cat->id}}" name="post_category[]">
            <span class="cr">
                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                    </span>
            <span>{{$cat->category_name ?? ''}}</span>
        </label>
    </div>
@endforeach
