<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <x-shared.main-sidebar-menu
        link="home"
        icon="fas fa-home"
        name="{{__('sidebar.home')}}"
        >
        </x-shared.main-sidebar-menu>

        <x-shared.sidebar-menu
            icon="fas fa-home"
            elementId="user-id"
            name="{{__('sidebar.user')}}"
        >

            <x-shared.sub-sidebar-menu
                link="home"
                name="{{__('sidebar.home')}}"/>
            @can('user index')
            <x-shared.sub-sidebar-menu
                link="home"
                name="{{__('sidebar.home')}}"/>
            @endcan
        </x-shared.sidebar-menu>




    </ul>
</nav>
