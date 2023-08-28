<?php

namespace App\AppConstants;

class AppConstants
{
    public const AWS_BASEURL = "https://iunion.s3.ap-south-1.amazonaws.com/";
    public const ADMIN_NAME = "admin";
    public const METHOD_NAME = "method";
    public const TEACHER_NAME = "teacher";
    public const STUDENT_NAME = "student";

    public const ADMIN_PERMISSIONS = [
        //Users
        "user create",
        "user edit",
        "user show",
        "user delete",
        //Roles
        "role create",
        "role update",
        "role delete",
        "role show",
        //Permission
        "permission create",
        "permission update",
        "permission delete",
        "permission show",
        //Role To Permission
        "role_permission"
    ];
    public const METHOD_PERMISSIONS = [
        //Subjects
        'subject create',
        'subject show',
        'subject update',
        'subject delete',

        //subject-contexts
        'subject-contexts create',
        'subject-contexts show',
        'subject-contexts update',
        'subject-contexts delete',

        //single-tests
        'single-tests create',
        'single-tests update',
        'single-tests show',
        'single-tests delete',

        //categories
        'categories create',
        'categories update',
        'categories show',
        'categories delete',

        //questions
        'questions create',
        'questions update',
        'questions show',
        'questions delete',

        //group
        'group create',
        'group show',
        'group update',
        'group delete',
    ];

    public const tags = ["basic","standart","pro","premium"];

    public const permissions = ["user","role","locale","permission",'subject',
        'subject-contexts','single-tests',"plan",
        "categories","plan-combination","subscription","promocode",
        "news","wallet","faq","questions",'questions-ckeditor-upload',"group",
        "appeal-type","appeal","page","forum","discuss",
        "tournament","sub-tournament","sub-tournament-participant","sub-tournament-winner","sub-tournament-result","sub-tournament-rival",
        ];
    public  const  permissions_action = ["create","index","edit","show"];
    public const all_permissions = [
        //User
        "user create","user index","user edit","user show",
        //Role
        "role create","role index","role edit","role show",
        //Locale
        "locale create","locale index","locale edit","locale show",
        //Permission
        "permission create","permission index","permission edit","permission show",
        //Subject
        "subject create","subject index","subject edit","subject show",
        //Subject Contexts
        "subject-contexts create","subject-contexts index","subject-contexts edit","subject-contexts show",
        //Single-tests
        "single-tests create","single-tests index","single-tests edit","single-tests show",
        //Plan Create
        "plan create","plan index","plan edit","plan show",
        //Categories
        "categories create","categories index","categories edit","categories show",
        //Plan Combination
        "plan-combination create","plan-combination index","plan-combination edit","plan-combination show",
        //Subscription
        "subscription create","subscription index","subscription edit","subscription show",
        //Promocode
        "promocode create","promocode index","promocode edit","promocode show",
        //News
        "news create","news index","news edit","news show",
        //Wallet
        "wallet create","wallet index","wallet edit","wallet show",
        //Faq
        "faq create","faq index","faq edit","faq show",
        //Question
        "questions create","questions index","questions edit","questions show",
        //Group
        "group create","group index","group edit","group show",
        //Appeal Type
        "appeal-type create","appeal-type index","appeal-type edit","appeal-type show",
        //Appeal
        "appeal create","appeal index","appeal edit","appeal show",
        //Page
        "page create","page index","page edit","page show",
        //Forum
        "forum create","forum index","forum edit","forum show",
        //Discuss
        "discuss create","discuss index","discuss edit","discuss show",
        //Tournament
        "tournament create","tournament index","tournament edit","tournament show",
        //SubTournament
        "sub-tournament create","sub-tournament index","sub-tournament edit","sub-tournament show",
        //Sub Tournament P
        "sub-tournament-participant create","sub-tournament-participant index","sub-tournament-participant edit","sub-tournament-participant show",
        //Sub Tournament W
        "sub-tournament-winner create","sub-tournament-winner index","sub-tournament-winner edit","sub-tournament-winner show",
        //Sub Tournament Res
        "sub-tournament-result create","sub-tournament-result index","sub-tournament-result edit","sub-tournament-result show",
        //Sub Tournament Riv
        "sub-tournament-rival create","sub-tournament-rival index","sub-tournament-rival edit","sub-tournament-rival show"
    ];

}
