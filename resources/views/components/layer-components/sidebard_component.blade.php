<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <x-shared.main-sidebar-menu
        link="home"
        icon="fas fa-home"
        name="{{__('sidebar.home')}}"
        >
        </x-shared.main-sidebar-menu>

        <x-shared.main-sidebar-menu
            link="user.index"
            icon="fas fa-users"
            name="{{__('sidebar.user')}}"
        />

        <x-shared.main-sidebar-menu
            link="subject.index"
            icon="fas fa-book"
            name="{{__('sidebar.subject')}}"
        />


    </ul>
</nav>
