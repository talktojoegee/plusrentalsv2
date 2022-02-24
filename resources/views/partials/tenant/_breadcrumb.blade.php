<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>{{config('app.name')}}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('current-page')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
