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
}
