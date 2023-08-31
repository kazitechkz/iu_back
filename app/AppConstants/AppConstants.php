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
    ];

    public const ADMIN_PERMISSIONS = self::all_permissions;
    public const METHOD_PERMISSIONS = [
        //Subject
        "subject create","subject index","subject edit","subject show",
        //Categories
        "categories create","categories index","categories edit","categories show",
        //Question
        "questions create","questions index","questions edit","questions show",
        //Subject Contexts
        "subject-contexts create","subject-contexts index","subject-contexts edit","subject-contexts show",

    ];

    public const tags = ["basic","standart","pro","premium"];

    public  const  permissions_action = ["create","index","edit","show"];

}
