<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <x-shared.main-sidebar-menu
            link="home"
            icon="fas fa-home"
            name="{{__('sidebar.home')}}"
        />

        @can("user management")
            <x-shared.sidebar-menu
                :element-id="'users'" :name="__('sidebar.user')"
                :icon="'fas fa-solid fa-building-shield'">
                @can("user-hubs index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fa fa-user-group'"
                        :link="'hubs.index'"
                        :name="__('sidebar.user_hubs')"/>
                @endcan
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
        @endcan
        @can("locale management")
            @can("locale index")
                <x-shared.main-sidebar-menu
                    link="locale.index"
                    icon="fas fa-language"
                    name="{{__('sidebar.locale')}}"
                />
            @endcan
        @endcan
        @can("subject management")
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
        @endcan

        @can("finance management")
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
                @can("promocode-plans index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-tag'"
                        :link="'promocode-plans.index'"
                        :name="__('sidebar.promocode_plans')"/>
                @endcan
                @can("promocode index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-tag'"
                        :link="'promocode.index'"
                        :name="__('sidebar.promocode')"/>
                @endcan
            </x-shared.sidebar-menu>
        @endcan
        @can("support management")
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
        @endcan

        @can("examination management")
            <x-shared.sidebar-menu :element-id="'tests'" :name="__('sidebar.tests')"
                                   :icon="'fas fa-clipboard-question'">
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
                @can("translation index")
                    <x-shared.sub-sidebar-menu
                        :icon="'mdi mdi-google-translate'"
                        :link="'translations.index'"
                        :name="__('sidebar.translations')"/>
                    <x-shared.sub-sidebar-menu
                        :icon="'mdi mdi-google-translate'"
                        :link="'get-contents'"
                        :name="__('sidebar.translations_contents')"/>
                @endcan
            </x-shared.sidebar-menu>
        @endcan
        @can('career management')
            <x-shared.sidebar-menu :element-id="'career-index'" :name="__('sidebar.career')" :icon="'fas fa-briefcase'">
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-solid fa-chalkboard-user'"
                    :link="'career-quiz-group.index'"
                    :name="__('sidebar.career_quiz_groups')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-user'"
                    :link="'career-quiz-author.index'"
                    :name="__('sidebar.career_quiz_authors')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-smile-wink'"
                    :link="'career-quiz-feature.index'"
                    :name="__('sidebar.career_quiz_features')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-clipboard-question'"
                    :link="'career-quiz.index'"
                    :name="__('sidebar.career_quizzes')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-circle-question'"
                    :link="'career-quiz-question.index'"
                    :name="__('sidebar.career_quiz_questions')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-comment'"
                    :link="'career-quiz-answer.index'"
                    :name="__('sidebar.career_quiz_answers')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-ticket'"
                    :link="'career-quiz-coupon.index'"
                    :name="__('sidebar.career_coupons')"/>
            </x-shared.sidebar-menu>
        @endcan
        @can('iutube management')
            <x-shared.sidebar-menu :element-id="'iutube-index'" :name="__('sidebar.iutube_videos')"
                                   :icon="'fas fa-play'">
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-user'"
                    :link="'iutube-author.index'"
                    :name="__('sidebar.iutube_authors')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-lock-open'"
                    :link="'iutube-access.index'"
                    :name="__('sidebar.iutube_access')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-video'"
                    :link="'iutube-video.index'"
                    :name="__('sidebar.iutube_videos')"/>
            </x-shared.sidebar-menu>
        @endcan
        @can('content management')
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
        @endcan
        @can('announcement management')
            <x-shared.sidebar-menu :element-id="'announcement'" :name="__('sidebar.announcement')"
                                   :icon="'fas fa-bullhorn'">
                @can("announcement index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-bullhorn'"
                        :link="'announcement-type.index'"
                        :name="__('sidebar.announcement-type')"/>
                @endcan
                @can("announcement index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-bullhorn'"
                        :link="'announcement-group.index'"
                        :name="__('sidebar.announcement-group')"/>
                @endcan
                @can("announcement index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-bullhorn'"
                        :link="'announcement.index'"
                        :name="__('sidebar.announcement')"/>
                @endcan
            </x-shared.sidebar-menu>
        @endcan
        @can('notification management')
            <x-shared.sidebar-menu :element-id="'notification'" :name="__('sidebar.notification')"
                                   :icon="'fas fa-message'">
                @can("notification index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-message'"
                        :link="'notification-type.index'"
                        :name="__('sidebar.notification-type')"/>
                @endcan
                @can("notification index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-message'"
                        :link="'notification.index'"
                        :name="__('sidebar.notification')"/>
                @endcan

            </x-shared.sidebar-menu>
        @endcan
        @can('tech-support management')
            <x-shared.sidebar-menu :element-id="'tech-support'" :name="__('sidebar.tech-support')"
                                   :icon="'fas fa-toolbox'">
                @can("tech-support index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-toolbox'"
                        :link="'tech-support-type.index'"
                        :name="__('sidebar.tech-support-type')"/>
                @endcan
                @can("tech-support index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-toolbox'"
                        :link="'tech-support-category.index'"
                        :name="__('sidebar.tech-support-category')"/>
                @endcan
                @can("tech-support index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-toolbox'"
                        :link="'tech-support-ticket.index'"
                        :name="__('sidebar.tech-support-ticket')"/>
                @endcan

            </x-shared.sidebar-menu>
        @endcan
        @can("step management")
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
                @can('sub-step-content index')
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-shoe-prints'"
                        :link="'sub-step-content.index'"
                        :name="__('sidebar.sub-step-content')"/>
                @endcan
                @can('subStepVideo index')
                    <x-shared.sub-sidebar-menu
                        :icon="'fa fa-video-camera'"
                        :link="'sub-step-video.index'"
                        :name="__('sidebar.sub-step-video')"/>
                @endcan
                {{--                    @can("substeptest index")--}}
                {{--                        <x-shared.sub-sidebar-menu--}}
                {{--                            :icon="'mdi mdi-text-shadow'"--}}
                {{--                            :link="'sub-step-test.index'"--}}
                {{--                            :name="__('sidebar.substeptest')"/>--}}
                {{--                    @endcan--}}
            </x-shared.sidebar-menu>
        @endcan
        @can("tournament management")
            <x-shared.sidebar-menu :element-id="'tournament'" :name="__('sidebar.tournament')" :icon="'fas fa-trophy'">
                @can("tournament index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-trophy'"
                        :link="'tournament.index'"
                        :name="__('sidebar.tournament')"/>
                @endcan
                @can("tournament index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-trophy'"
                        :link="'tournament-prize.index'"
                        :name="__('sidebar.tournament-prize')"/>
                @endcan
                @can("tournament index")
                    <x-shared.sub-sidebar-menu
                        :icon="'fas fa-trophy'"
                        :link="'tournament-award-index'"
                        :name="__('sidebar.tournament-award')"/>
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
        @endcan
        @can("tutor management")
            <x-shared.sidebar-menu :element-id="'tutor-content'" :name="__('sidebar.tutor')"
                                   :icon="'fa-solid fa-chalkboard-user'">
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-venus-mars'"
                    :link="'gender.index'"
                    :name="__('sidebar.gender')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fas fa-solid fa-chalkboard-user'"
                    :link="'tutor.index'"
                    :name="__('sidebar.tutor')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fa-solid fa-toolbox'"
                    :link="'tutor-skill.index'"
                    :name="__('sidebar.tutor-skill')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fa-solid fa-calendar-days'"
                    :link="'lesson-schedule.index'"
                    :name="__('sidebar.lesson-schedule')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fa-solid fa-graduation-cap'"
                    :link="'lesson-schedule-participant.index'"
                    :name="__('sidebar.lesson-schedule-participant')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fa-solid fa-star'"
                    :link="'lesson-rating.index'"
                    :name="__('sidebar.lesson-rating')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fa-solid fa-star'"
                    :link="'participant-rating.index'"
                    :name="__('sidebar.participant-rating')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fa-solid fa-ticket'"
                    :link="'lesson-complaint.index'"
                    :name="__('sidebar.lesson-complaint')"/>
            </x-shared.sidebar-menu>
        @endcan
        @can("statistic management")
            <x-shared.sidebar-menu :element-id="'statistic-content'" :name="__('sidebar.statistic')"
                                   :icon="'fa fa-line-chart'">
                <x-shared.sub-sidebar-menu
                    :icon="'fa fa-bar-chart'"
                    :link="'stats-on-questions'"
                    :name="__('sidebar.stats-on-questions')"/>
                @can('stats-by-user management')
                    <x-shared.sub-sidebar-menu
                        :icon="'fa fa-bar-chart'"
                        :link="'stats-on-user'"
                        :name="__('sidebar.stats-on-user-contents')"/>
                @endcan
                <x-shared.sub-sidebar-menu
                    :icon="'fa fa-bar-chart'"
                    :link="'stats-on-subjects'"
                    :name="__('sidebar.stats-on-subjects')"/>
                <x-shared.sub-sidebar-menu
                    :icon="'fa fa-bar-chart'"
                    :link="'stats-on-types'"
                    :name="__('sidebar.stats-on-types')"/>
            </x-shared.sidebar-menu>
        @endcan
        @can("fact management")
            <x-shared.sidebar-menu :element-id="'fact-content'" :name="__('sidebar.fact')"
                                   :icon="'fa-regular fa-face-laugh-squint'">
                <x-shared.sub-sidebar-menu
                    :icon="'fa-regular fa-face-grin-squint-tears'"
                    :link="'fact.index'"
                    :name="__('sidebar.fact')"/>
            </x-shared.sidebar-menu>
        @endcan
    </ul>
</nav>
