<?php

namespace App\AppConstants;

class AppConstants
{
    public const AWS_BASEURL = "https://iunion.s3.ap-south-1.amazonaws.com/";
    public const ADMIN_NAME = "admin";
    public const METHOD_NAME = "method";
    public const TEACHER_NAME = "teacher";
    public const STUDENT_NAME = "student";
    public const all_permissions = [
        //User
        "user create", "user index", "user edit", "user show",
        //UserHubs
        "user-hubs create", "user-hubs index", "user-hubs edit", "user-hubs show",
        //Role
        "role create", "role index", "role edit", "role show",
        //Locale
        "locale create", "locale index", "locale edit", "locale show",
        //Permission
        "permission create", "permission index", "permission edit", "permission show",
        //Subject
        "subject create", "subject index", "subject edit", "subject show",
        //Subject Contexts
        "subject-contexts create", "subject-contexts index", "subject-contexts edit", "subject-contexts show",
        //Single-tests
        "single-tests create", "single-tests index", "single-tests edit", "single-tests show",
        //Plan Create
        "plan create", "plan index", "plan edit", "plan show",
        //Categories
        "categories create", "categories index", "categories edit", "categories show",
        //SubCategories
        "subcategories create", "subcategories index", "subcategories edit", "subcategories show",
        //Plan Combination
        "plan-combination create", "plan-combination index", "plan-combination edit", "plan-combination show",
        //Subscription
        "subscription create", "subscription index", "subscription edit", "subscription show",
        //Promocode
        "promocode create", "promocode index", "promocode edit", "promocode show",
        //News
        "news create", "news index", "news edit", "news show",
        //Commercial Group
        "commercial-group create", "commercial-group index", "commercial-group edit", "commercial-group show",
        //Wallet
        "wallet create", "wallet index", "wallet edit", "wallet show",
        //Faq
        "faq create", "faq index", "faq edit", "faq show",
        //Question
        "questions create", "questions index", "questions edit", "questions show",
        //Group
        "group create", "group index", "group edit", "group show",
        //Appeal Type
        "appeal-type create", "appeal-type index", "appeal-type edit", "appeal-type show",
        //Appeal
        "appeal create", "appeal index", "appeal edit", "appeal show",
        //Page
        "page create", "page index", "page edit", "page show",
        //Forum
        "forum create", "forum index", "forum edit", "forum show",
        //Discuss
        "discuss create", "discuss index", "discuss edit", "discuss show",
        //Tournament
        "tournament create", "tournament index", "tournament edit", "tournament show",
        //SubTournament
        "sub-tournament create", "sub-tournament index", "sub-tournament edit", "sub-tournament show",
        //SubStepTest
        "substeptest create", "substeptest index", "substeptest edit", "substeptest show",
        //Step
        "step create", "step index", "step edit", "step show",
        //Sub Step
        "sub-step create", "sub-step index", "sub-step edit", "sub-step show",
        //Sub Step Content
        "sub-step-content create", "sub-step-content index", "sub-step-content edit", "sub-step-content show",
        //Gender
        "gender index", "gender create", "gender edit", "gender show",
        //Tutor
        "tutor index", "tutor create", "tutor edit", "tutor show",
        //Tutor Skill
        "tutor-skill index", "tutor-skill create", "tutor-skill edit", "tutor-skill show",
        //Lesson Schedule
        "lesson-schedule index", "lesson-schedule create", "lesson-schedule edit", "lesson-schedule show",
        //Lesson Schedule Participant
        "lesson-schedule-participant index", "lesson-schedule-participant create", "lesson-schedule-participant edit", "lesson-schedule-participant show",
        //Lesson Rating
        "lesson-rating index", "lesson-rating create", "lesson-rating edit", "lesson-rating show",
        //Participant Rating
        "participant-rating index", "participant-rating create", "participant-rating edit", "participant-rating show",
        //Lesson Complaint
        "lesson-complaint index", "lesson-complaint create", "lesson-complaint edit", "lesson-complaint show",
        //Statistics
        "statistic index", "statistic create", "statistic edit", "statistic show",
        //SubStepVideo
        "subStepVideo index", "subStepVideo create", "subStepVideo edit", "subStepVideo show",
        //Notifications
        "notification index", "notification create", "notification edit", "notification show",
        //Announcement
        "announcement index", "announcement create", "announcement edit", "announcement show",
        //Notifications
        "tech-support index", "tech-support create", "tech-support edit", "tech-support show",
        //Facts
        "fact index", "fact create", "fact edit", "fact show",
        //Translation
        "translation index", "translation create", "translation edit", "translation show",
        //StatsByUserContents
        "stats-by-user index", "stats-by-user create", "stats-by-user edit", "stats-by-user show",
        //Career
        "career index", "career create", "career edit", "career show",
        //Permission for main menu
        "user management",
        "user-hubs management",
        "locale management",
        "subject management",
        "finance management",
        "support management",
        "examination management",
        "content management",
        "step management",
        "tournament management",
        "tutor management",
        "statistic management",
        "subStepVideo management",
        "notification management",
        "announcement management",
        "tech-support management",
        "fact management",
        "translation management",
        "stats-by-user management",
        "career management"
    ];

    public const ADMIN_PERMISSIONS = self::all_permissions;
    public const METHOD_PERMISSIONS = [
        //Subject
        "subject create", "subject index", "subject edit", "subject show",
        //Categories
        "categories create", "categories index", "categories edit", "categories show",
        //SubCategories
        "subcategories create", "subcategories index", "subcategories edit", "subcategories show",
        //SubStepTest
        "substeptest create", "substeptest index", "substeptest edit", "substeptest show",
        //Question
        "questions create", "questions index", "questions edit", "questions show",
        //Subject Contexts
        "subject-contexts create", "subject-contexts index", "subject-contexts edit", "subject-contexts show",

    ];

    public const tags = ["basic", "standart", "pro", "premium"];

    public const  permissions_action = ["create", "index", "edit", "show"];

}
