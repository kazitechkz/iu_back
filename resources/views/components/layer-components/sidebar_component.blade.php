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
        />
        <x-shared.main-sidebar-menu
            link="wallet.index"
            icon="fas fa-wallet"
            name="{{__('sidebar.wallet')}}"
        />
        <x-shared.main-sidebar-menu
            link="plan.index"
            icon="fas fa-credit-card"
            name="{{__('sidebar.plan')}}"
        />
        <x-shared.main-sidebar-menu
            link="plan-combination.index"
            icon="fas fa-credit-card"
            name="{{__('sidebar.plan-combination')}}"
        />
        <x-shared.main-sidebar-menu
            link="subscription.index"
            icon="fas fa-handshake"
            name="{{__('sidebar.subscription')}}"
        />
        <x-shared.main-sidebar-menu
            link="promocode.index"
            icon="fas fa-tag"
            name="{{__('sidebar.promocode')}}"
        />
        <x-shared.main-sidebar-menu
            link="categories.index"
            icon="fas fa-list"
            name="{{__('sidebar.categories')}}"
        />
        <x-shared.main-sidebar-menu
            link="news.index"
            icon="fas fa-newspaper"
            name="{{__('sidebar.news')}}"
        />
        <x-shared.main-sidebar-menu
            link="group.index"
            icon="fas fa-layer-group"
            name="{{__('sidebar.group')}}"
        />
        <x-shared.main-sidebar-menu
            link="page.index"
            icon="fas fa-file-lines"
            name="{{__('sidebar.page')}}"
        />

        <x-shared.main-sidebar-menu
            link="questions.index"
            icon="fas fa-question"
            name="{{__('sidebar.questions')}}"
        />
        <x-shared.main-sidebar-menu
            link="appeal.index"
            icon="fas fa-question"
            name="{{__('sidebar.appeal')}}"
        />
        <x-shared.main-sidebar-menu
            link="appeal-type.index"
            icon="fas fa-question"
            name="{{__('sidebar.appeal_type')}}"
        />
        <x-shared.main-sidebar-menu
            link="faq.index"
            icon="fas fa-question"
            name="{{__('sidebar.faq')}}"
        />
    </ul>
</nav>
