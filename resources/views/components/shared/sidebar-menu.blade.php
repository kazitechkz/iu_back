<li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#{{$elementId}}" aria-expanded="false" aria-controls="ui-basic">
        <i class="{{$icon}} mr-2"></i>
        <span class="menu-title">
            {{$name}}
        </span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="{{$elementId}}" style="">
        <ul class="nav flex-column sub-menu">
            {{ $slot }}

        </ul>
    </div>
</li>


