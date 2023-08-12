<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-end flex-wrap">
                <div class="mr-md-3 mr-xl-5">
                    <h2>{{$title}}</h2>
                    <p class="mb-md-0">{{$subtitle}}</p>
                </div>
                <div class="d-flex">
                    <i class="{{$icon}}"></i>
                    @foreach($links as $link=> $value)
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;{{$value}}</p>
                    @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-end flex-wrap">
                {{$slot}}
            </div>
        </div>
    </div>
</div>
