<form class="utf-main-search-form-item" method="GET" action="{{route('search-for-property')}}">
    @csrf
    <div class="utf-main-search-box-area">
        <div class="row with-forms">
            <div class="col-md-4 col-sm-12">
                <input type="text" name="search_phrase" class="ico-01" placeholder="Search {{config('app.name')}} for properties" />
                @error('search_phrase')
                    <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
            <div class="col-md-2 col-sm-6">
                <select name="location" data-placeholder="Select Location" title="Select Location" class="utf-chosen-select-single-item">
                    <option selected disabled>Select Location</option>
                    @foreach($locations as $location)
                        <option value="{{$location->id}}">{{$location->location_name ?? '' }}</option>
                    @endforeach
                </select>
                @error('location')
                <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
            <div class="col-md-3 col-sm-6" id="areaWrapper">
                <select name="area" data-placeholder="Select Area" title="Select Area" class="utf-chosen-select-single-item">
                    <option disabled selected>Select Area</option>
                    <option>Afghanistan</option>
                    <option>Albania</option>
                    <option>Algeria</option>
                    <option>Brazil</option>
                    <option>Burundi</option>
                    <option>Bulgaria</option>
                    <option>California</option>
                    <option>Germany</option>
                    <option>Grenada</option>
                    <option>Guatemala</option>
                    <option>Iceland</option>
                </select>
                @error('area')
                <i class="text-danger mt-2">{{$message}}</i>
                @enderror
            </div>
            <div class="col-md-3 col-sm-6">
                <button type="submit" class="button utf-search-btn-item"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>
    </div>
</form>
