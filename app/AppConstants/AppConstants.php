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



}
