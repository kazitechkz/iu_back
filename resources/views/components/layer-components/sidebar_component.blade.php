<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <x-shared.main-sidebar-menu
            link="home"
            icon="fas fa-home"
            name="{{__('sidebar.home')}}"
        />


            <x-shared.sidebar-menu
                :element-id="'users'" :name="__('sidebar.user')"
                :icon="'fas fa-solid fa-building-shield'">
                @can("user index")
                <x-shared.sub-sidebar-menu
                    :icon="'fa fa-user'"
                    :link="'user.index'"
                    :name="__('sidebar.user')"/>
                @endcan
                @can("role index")
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-person-military-pointing'"
                    :link="'role.index'"
                    :name="__('sidebar.role')"/>
                @endcan
                @can("permission index")
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-hand'"
                    :link="'permission.index'"
                    :name="__('sidebar.permission')"/>
                @endcan
            </x-shared.sidebar-menu>
                @can("locale index")
                <x-shared.main-sidebar-menu
                    link="locale.index"
                    icon="fas fa-language"
                    name="{{__('sidebar.locale')}}"
                />
                 @endcan

            <x-shared.sidebar-menu :element-id="'subjects'" :name="__('sidebar.subject')" :icon="'fas fa-book'">
                @can("subject index")
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-book'"
                    :link="'subject.index'"
                    :name="__('sidebar.subject')"/>
                @endcan
                @can("categories index")
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-list'"
                    :link="'categories.index'"
                    :name="__('sidebar.categories')"/>
                @endcan
                @can("subcategories index")
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-list'"
                    :link="'sub-categories.index'"
                    :name="__('sidebar.subcategories')"/>
                @endcan
                @can("single-tests index")
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-edit'"
                    :link="'single-tests.index'"
                    :name="__('sidebar.single_subject_tests')"/>
                @endcan
            </x-shared.sidebar-menu>

        <x-shared.sidebar-menu :element-id="'finance'" :name="__('sidebar.finance')" :icon="'mdi mdi-currency-usd'">
            @can("commercial-group index")
            <x-shared.sub-sidebar-menu
                :icon="'fas fa-credit-card'"
                :link="'commercial-group.index'"
                :name="__('sidebar.commercial-group')"/>
            @endcan
            @can("wallet index")
            <x-shared.sub-sidebar-menu
                :icon="'fas fa-wallet'"
                :link="'wallet.index'"
                :name="__('sidebar.wallet')"/>
            @endcan
            @can("plan index")
              <x-shared.sub-sidebar-menu
                :icon="'fas fa-credit-card'"
                :link="'plan.index'"
                :name="__('sidebar.plan')"/>
            @endcan
            @can("plan-combination index")
            <x-shared.sub-sidebar-menu
                :icon="' mdi mdi-compass-outline'"
                :link="'plan-combination.index'"
                :name="__('sidebar.plan-combination')"/>
            @endcan
            @can("subscription index")
               <x-shared.sub-sidebar-menu
                 :icon="'fas fa-handshake'"
                 :link="'subscription.index'"
                  :name="__('sidebar.subscription')"/>
            @endcan
            @can("promocode index")
            <x-shared.sub-sidebar-menu
                :icon="'fas fa-tag'"
                :link="'promocode.index'"
                :name="__('sidebar.promocode')"/>
            @endcan
        </x-shared.sidebar-menu>

        <x-shared.sidebar-menu
            :element-id="'support'"
            :name="__('sidebar.support')"
            :icon="' mdi mdi-human-handsup'">
            @can("appeal index")
            <x-shared.sub-sidebar-menu
                :icon="'mdi mdi-comment-question-outline'"
                :link="'appeal.index'"
                :name="__('sidebar.appeal')"/>
            @endcan
            @can("appeal-type index")
             <x-shared.sub-sidebar-menu
                :icon="'mdi mdi-comment-alert-outline'"
                :link="'appeal-type.index'"
                :name="__('sidebar.appeal_type')"/>
            @endcan
            @can("faq index")
            <x-shared.sub-sidebar-menu
                 :icon="'fas fa-question'"
                 :link="'faq.index'"
                 :name="__('sidebar.faq')"/>
            @endcan
            @can("forum index")
            <x-shared.sub-sidebar-menu
                :icon="'fas fa-comment'"
                :link="'forum.index'"
                :name="__('sidebar.forum')"/>
            @endcan

        </x-shared.sidebar-menu>

        <x-shared.sidebar-menu :element-id="'tests'" :name="__('sidebar.tests')" :icon="'fas fa-wallet'">
            @can("group index")
            <x-shared.sub-sidebar-menu
                :icon="'fas fa-layer-group'"
                :link="'group.index'"
                :name="__('sidebar.group')"/>
            @endcan
            @can("subject-contexts index")
              <x-shared.sub-sidebar-menu
                :icon="'mdi mdi-language-python'"
                :link="'subject-contexts.index'"
                 :name="__('sidebar.context')"/>
            @endcan
            @can("questions index")
            <x-shared.sub-sidebar-menu
                :icon="'mdi mdi-vector-point'"
                :link="'questions.index'"
                :name="__('sidebar.questions')"/>
            @endcan
            </x-shared.sidebar-menu>

        <x-shared.sidebar-menu :element-id="'content'" :name="__('sidebar.content')" :icon="'fas fa-wallet'">
            @can("news index")
            <x-shared.sub-sidebar-menu
                :icon="'fas fa-newspaper'"
                :link="'news.index'"
                :name="__('sidebar.news')"/>
            @endcan
            @can("page index")
              <x-shared.sub-sidebar-menu
                 :icon="'fas fa-file-lines'"
                 :link="'page.index'"
                 :name="__('sidebar.page')"/>
            @endcan

        </x-shared.sidebar-menu>
        <x-shared.sidebar-menu :element-id="'step-content'" :name="__('sidebar.step')" :icon="'fas fa-stairs'">
                @can('step index')
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-stairs'"
                    :link="'step.index'"
                    :name="__('sidebar.step')"/>
                @endcan
                    @can('sub-step index')
                        <x-shared.sub-sidebar-menu
                            :icon="'fas fa-shoe-prints'"
                            :link="'sub-step.index'"
                            :name="__('sidebar.sub-step')"/>
                    @endcan
        </x-shared.sidebar-menu>
        <x-shared.sidebar-menu :element-id="'tournament'" :name="__('sidebar.tournament')" :icon="'fas fa-trophy'">
            @can("tournament index")
            <x-shared.sub-sidebar-menu
                :icon="'fas fa-trophy'"
                :link="'tournament.index'"
                :name="__('sidebar.tournament')"/>
            @endcan
            @can("sub-tournament index")
            <x-shared.sub-sidebar-menu
                :icon="'fas fa-trophy'"
                :link="'sub-tournament.index'"
                :name="__('sidebar.sub-tournament')"/>
            <x-shared.sub-sidebar-menu
                :icon="'fas fa-users'"
                :link="'sub-tournament-participant.index'"
                :name="__('sidebar.sub-tournament-participant')"/>
            <x-shared.sub-sidebar-menu
                :icon="'fas fa-award'"
                :link="'sub-tournament-winner.index'"
                :name="__('sidebar.sub-tournament-winner')"/>
            <x-shared.sub-sidebar-menu
                :icon="'fas fa-square-poll-vertical'"
                :link="'sub-tournament-result.index'"
                :name="__('sidebar.sub-tournament-result')"/>
            <x-shared.sub-sidebar-menu
                :icon="'mdi mdi-sword'"
                :link="'sub-tournament-rival.index'"
                :name="__('sidebar.sub-tournament-rivals')"/>
            @endcan
        </x-shared.sidebar-menu>
    </ul>
</nav>
