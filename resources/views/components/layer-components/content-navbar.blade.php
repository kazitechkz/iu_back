<div class="grid-margin stretch-card col-lg-12 py-2">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="d-flex align-items-end flex-wrap">
                            <div class="me-md-3 me-xl-5">
                                <h2>{{$title}}</h2>
                                <p class="mb-md-0">{{$subtitle}}</p>
                            </div>

                        </div>
                        <div class="d-flex justify-content-between align-items-end flex-wrap">
                            {{$slot}}
                        </div>
                    </div>
                </div>
                @if(count($breadcrumbs)>0)
                <div class="col-md-12">
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                            @foreach($breadcrumbs as $breadcrumb)
                                <p class="text-primary mb-0 hover-cursor">/{{$breadcrumb}}</p>
                            @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>
