<select name="area" id="area" class="form-control js-example-basic-single" value="{{old('area')}}">
    <option disabled selected>--Select location--</option>
    @foreach($areas as $area)
        <option value="{{$area->id}}">{{$area->area_name ?? ''}}</option>
    @endforeach
</select>
