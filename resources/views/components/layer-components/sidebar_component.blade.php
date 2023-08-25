<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <x-shared.main-sidebar-menu
        link="home"
        icon="fas fa-home"
        name="{{__('sidebar.home')}}"
        />
        <x-shared.sidebar-menu :element-id="'users'" :name="__('sidebar.user')" :icon="'fas fa-solid fa-building-shield'">
            <x-shared.sub-sidebar-menu :icon="'fa fa-user'" :link="'user.index'" :name="__('sidebar.user')"/>
            <x-shared.sub-sidebar-menu :icon="'fas fa-person-military-pointing'" :link="'role.index'" :name="__('sidebar.role')"/>
            <x-shared.sub-sidebar-menu :icon="'fas fa-hand'" :link="'permission.index'" :name="__('sidebar.permission')"/>
        </x-shared.sidebar-menu>

        <x-shared.main-sidebar-menu
            link="locale.index"
            icon="fas fa-language"
            name="{{__('sidebar.locale')}}"
        />
        <x-shared.sidebar-menu :element-id="'subjects'" :name="__('sidebar.subject')" :icon="'fas fa-book'">
            <x-shared.sub-sidebar-menu :icon="'fas fa-book'" :link="'subject.index'" :name="__('sidebar.subject')"/>
            <x-shared.sub-sidebar-menu :icon="'fas fa-list'" :link="'categories.index'" :name="__('sidebar.categories')"/>
            <x-shared.sub-sidebar-menu :icon="'fas fa-edit'" :link="'single-tests.index'" :name="__('sidebar.single_subject_tests')"/>
        </x-shared.sidebar-menu>

        <x-shared.sidebar-menu :element-id="'finance'" :name="__('sidebar.finance')" :icon="'mdi mdi-currency-usd'">
            <x-shared.sub-sidebar-menu :icon="'fas fa-wallet'" :link="'wallet.index'" :name="__('sidebar.wallet')"/>
            <x-shared.sub-sidebar-menu :icon="'fas fa-credit-card'" :link="'plan.index'" :name="__('sidebar.plan')"/>
            <x-shared.sub-sidebar-menu :icon="' mdi mdi-compass-outline'" :link="'plan-combination.index'" :name="__('sidebar.plan-combination')"/>
            <x-shared.sub-sidebar-menu :icon="'fas fa-handshake'" :link="'subscription.index'" :name="__('sidebar.subscription')"/>
            <x-shared.sub-sidebar-menu :icon="'fas fa-tag'" :link="'promocode.index'" :name="__('sidebar.promocode')"/>
        </x-shared.sidebar-menu>

        <x-shared.sidebar-menu :element-id="'support'" :name="__('sidebar.support')" :icon="' mdi mdi-human-handsup'">
            <x-shared.sub-sidebar-menu :icon="'mdi mdi-comment-question-outline'" :link="'appeal.index'" :name="__('sidebar.appeal')"/>
            <x-shared.sub-sidebar-menu :icon="'mdi mdi-comment-alert-outline'" :link="'appeal-type.index'" :name="__('sidebar.appeal_type')"/>
            <x-shared.sub-sidebar-menu :icon="'fas fa-question'" :link="'faq.index'" :name="__('sidebar.faq')"/>
            <x-shared.sub-sidebar-menu :icon="'fas fa-comment'" :link="'forum.index'" :name="__('sidebar.forum')"/>
        </x-shared.sidebar-menu>

        <x-shared.sidebar-menu :element-id="'tests'" :name="__('sidebar.tests')" :icon="'fas fa-wallet'">
            <x-shared.sub-sidebar-menu :icon="'fas fa-layer-group'" :link="'group.index'" :name="__('sidebar.group')"/>
            <x-shared.sub-sidebar-menu :icon="'mdi mdi-language-python'" :link="'subject-contexts.index'" :name="__('sidebar.context')"/>
            <x-shared.sub-sidebar-menu :icon="'mdi mdi-vector-point'" :link="'questions.index'" :name="__('sidebar.questions')"/>
        </x-shared.sidebar-menu>

        <x-shared.sidebar-menu :element-id="'content'" :name="__('sidebar.content')" :icon="'fas fa-wallet'">
            <x-shared.sub-sidebar-menu :icon="'fas fa-newspaper'" :link="'news.index'" :name="__('sidebar.news')"/>
            <x-shared.sub-sidebar-menu :icon="'fas fa-file-lines'" :link="'page.index'" :name="__('sidebar.page')"/>
        </x-shared.sidebar-menu>

        <x-shared.sidebar-menu :element-id="'tournament'" :name="__('sidebar.tournament')" :icon="'fas fa-trophy'">
            <x-shared.sub-sidebar-menu :icon="'fas fa-trophy'" :link="'tournament.index'" :name="__('sidebar.tournament')"/>
        </x-shared.sidebar-menu>
    </ul>
</nav>
