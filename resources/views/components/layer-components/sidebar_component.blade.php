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
            icon="fas fa-solid fa-building-shield"
            name="{{__('sidebar.user')}}"
        />
        <x-shared.main-sidebar-menu
            link="role.index"
            icon="fas fa-person-military-pointing"
            name="{{__('sidebar.role')}}"
        />
        <x-shared.main-sidebar-menu
            link="permission.index"
            icon="fas fa-hand"
            name="{{__('sidebar.permission')}}"
        />
        <x-shared.main-sidebar-menu
            link="locale.index"
            icon="fas fa-language"
            name="{{__('sidebar.locale')}}"
        />
        <x-shared.main-sidebar-menu
            link="subject.index"
            icon="fas fa-book"
            name="{{__('sidebar.subject')}}"
        />
        <x-shared.main-sidebar-menu
            link="single-tests.index"
            icon="fas fa-edit"
            name="{{__('sidebar.single_subject_tests')}}"
        ></x-shared.main-sidebar-menu>


    </ul>
</nav>
