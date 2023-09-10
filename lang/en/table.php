<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    //Users
    //User Header
    "user_lists"=>"User list",
    "user_management"=>"User management",
    "user_create_title"=>"Create a new user",
    "user_edit_title"=>"Edit user",
    "user_create_subtitle"=>"New user Creation block",
    "user_edit_subtitle"=>"User editing block",
//User Header
    "username"=>"Nickname",
    "username_hint"=>"Unique Nickname",
    "user_name"=>"Full name",
    "user_name_hint"=>"Mr. John Wick",
    "phone"=>"Phone",
    "phone_placeholder"=>"+77777777777",
    "phone_hint"=>"The phone must be of Kazakhstan operators",
    "Email"=>"Mail",
    "email"=>"Mail",
    "email_placeholder"=>"example@gmail.com ",
    "email_hint"=>"Mail must be valid",
    "Password"=>"User",
    "password"=>"Password",
    "password_hint"=>"Password must have more than 5 characters, contain special characters, for example qeWRdz@_334",
    "add_new_user"=>"Add a new user",

    //Role && Permission
    //Role Header
    "role_lists"=>"List of roles",
    "role_management"=>"Role management",
    "role_create_title"=>"Create a new role",
    "role_edit_title"=>"Change role",
    "role_create_subtitle"=>"Block for creating a new role",
    "role_edit_subtitle"=>"Role editing block",
//Role Header
    "permission_id"=>"Permissions",
    "role_id"=>"Role",
    "name"=>"Name",
    "guard_name"=>"Protection",
    "role_name"=>"Role name
", "role_name_hint"=>"It is recommended to enter the name of the role in English",
    "role_name_placeholder"=>"manager",
//Permission Header
    "permission_lists"=>"List of permissions",
    "permission_management"=>"Permission Management",
    "permission_create_title"=>"Create new permission",
    "permission_edit_title"=>"Change permission",
    "permission_create_subtitle"=>"New permission creation block",
    "permission_edit_subtitle"=>"Permission editing block",
//Permission Header

    //Language
    "title"=>"Name",
    "code"=>"Code",
    "is_active"=>"Active",
    "created_at"=>"Created",
    "updated_at"=>"Updated",
    "deleted_at"=>"Deleted",
    "locale_lists"=>"Language list",
    "locale_management"=>"Language Management",
    "locale_create_title"=>"Create a new locale",
    "locale_edit_title"=>"Change locale",
    "locale_create_subtitle"=>"Block for creating a new locale",
    "locale_edit_subtitle"=>"Locale editing block",
//Subjects
    "title_ru"=>"Name (RU)",
    "title_kk"=>"Name (KZ)",
    "title_en"=>"Name (EN)",
    "enable"=>"Active",
    "is_compulsory"=>"Required",
    "max_questions_quantity"=>"Maximum number of questions",
    "image_url"=>"Image",
//Category
    "subject_id"=>"Discipline",
//Sub Category
    "category_id"=>"Category",
//Single Subject
    'single_answer_questions_quantity'=>"Number of questions with 1 answer",
    'contextual_questions_quantity'=>"Number of contextual questions",
    'multi_answer_questions_quantity'=>"Number of questions with multiple. answers",
    'allotted_time'=>"Allotted time",
//Commercial Group
    "tag"=>"Unique identifier (tag)",
    "tag_hint"=>"Unique value, must be in English",
//Permission Header
    "commercial_lists"=>"List of plan groups",
    "commercial_management"=>"Managing plan groups",
    "commercial_create_title"=>"Create a new plan group",
    "commercial_edit_title"=>"Change plan group",
    "commercial_create_subtitle"=>"Block for creating a new plan group",
    "commercial_edit_subtitle"=>"Plan group editing block",
//Permission Header
    //Wallet
    "wallet_lists"=>"Wallet list",
    "wallet_management"=>"Transaction management",
    "wallet_create_title"=>"Create a new transaction",
    "wallet_edit_title"=>"Edit transaction",
    "wallet_create_subtitle"=>"Block for creating a new transaction",
    "wallet_edit_subtitle"=>"Transaction editing block",
    "exchange_type"=>"Transfer type",
    "wallet_refill"=>"Account replenishment",
    "wallet_transfer"=>"Account transfer",
    "wallet_user"=>"User balance",

    //Wallet
    //Price

    //Plan Header
    "plan_lists"=>"List of plans",
    "plan_management"=>"Plan management",
    "plan_create_title"=>"Create a new plan",
    "plan_edit_title"=>"Change plan",
    "plan_create_subtitle"=>"Block for creating a new plan",
    "plan_edit_subtitle"=>"Block plan editing",
//Plan Header
    //Plan Combination Header
    "plan_combination_lists"=>"List of localization plans",
    "plan_combination_management"=>"Manage localization plans",
    "plan_combination_create_title"=>"Create a new localization plans",
    "plan_combination_edit_title"=>"Change the localization of plans",
    "plan_combination_create_subtitle"=>"Block for creating a new localization of the plan",
    "plan_combination_edit_subtitle"=>"Block for editing the localization of the plan",
//Plan Combination Header
    "price"=>"Cost",
    "description"=>"Description",
    "commercial_group_id"=>"Group of plans",
    "sign_up_fee"=>"Additional taxation",
    "currency"=>"Currency",
    "currency_hint"=>"Currency in ISO 4217 format,for example, USD,EUR,KZT",
    "invoice_period"=>"Subscription period",
    "invoice_interval"=>"Subscription validity period type",
    "invoice_hint"=>"Subscription validity period, for example, 1 - month, hour and day",
    "trial_period"=>"Trial subscription validity period",
    "trial_interval"=>"Type of trial subscription validity period",
    "trial_hint"=>"Trial subscription validity period, by default, if not, then 0 - days, hours or months",
    "trial_mode_hint"=>"Outside - If it tries a trial subscription, then after purchase it is not deducted from the main days (27 subscription days + 3 trial days),
                        Inside - If he tries a trial subscription, then after purchase it is deducted from the main days (27 days of subscription + 3 trial days)",
    "interval"=>"Validity period (hours, days, weeks and months)",
    "period"=>"Digital values, for example 1",
    "grace_period"=>"Additional subscription time after the end of the main",
    "grace_interval"=>"Time type for additional subscription",
    "grace_hint"=>"Additional time is the time that the user receives after the subscription ends, if not, then set 0 - hours, days or months",
    "country"=>"Country",
//Subscription
    "plan_id"=>"Plan",
    "search"=>"Search",
    "search_user"=>"Search by full name,email, phone or nickname",
//Subscription Header
    "subscription_lists"=>"List of subscriptions",
    "subscription_management"=>"Manage subscriptions",
    "subscription_create_title"=>"Create subscription",
    "subscription_edit_title"=>"Change Subscription",
    "subscription_create_subtitle"=>"Subscription Creation block",
    "subscription_edit_subtitle"=>"Block editing subscriptions",
    "cancel_at"=>"Cancellation Date",
//Subscription Header
    //Promocode
    //Promocode Header
    "promocode_lists"=>"List of promo codes",
    "promocode_management"=>"Promo code management",
    "promocode_create_title"=>"Create promo code",
    "promocode_edit_title"=>"Edit promo code",
    "promocode_create_subtitle"=>"Promo code Creation block",
    "promocode_edit_subtitle"=>"Promo code editing Block",
//Promocode Header
    "mask"=>"Promo code mask",
    "mask_hint"=>"For example AA-BB and so on",
    "multiUse"=>"Multiple use",
    "unlimited"=>"No restrictions",
    "boundToUser"=>"Intended for the user",
    "user"=>"User",
    "count"=>"Quantity",
    "count_hint"=>"Number of unique promo codes generated (maximum 1000)",
    "usages"=>"Number of uses",
    "usages_hint"=>"Number of promo code uses, recommended - 1",
    "expiration"=>"Expiration Date",
    "details"=>"Details",
//Appeals
//Promocode Header
    "appeal_lists"=>"List of appeals",
    "appeal_management"=>"Appeal management",
    "appeal_create_title"=>"Create appeal",
    "appeal_edit_title"=>"Change appeal",
    "appeal_create_subtitle"=>"Block for creating appeals",
    "appeal_edit_subtitle"=>"Appeals editing block",
    "appeal_type_lists"=>"List of appeal types",
    "appeal_type_management"=>"Managing types of appeals",
    "appeal_type_create_title"=>"Create type of appeals",
    "appeal_type_edit_title"=>"Change the type of appeals",
    "appeal_type_create_subtitle"=>"Block for creating types of appeals",
    "appeal_type_edit_subtitle"=>"Block for editing types of appeals",
//Promocode Header
    "user_id"=>"User",
    "type_id"=>"Type",
    "question_id"=>"Question",
    "message"=>"Message",
    "status"=>"Status",
//FAQ
    "question"=>"Question",
    "answer"=>"Answer",
    "locale_id"=>"Language",
    "faq_lists"=>"FAQ list",
    "faq_management"=>"FAQ Management",
    "faq_create_title"=>"Create FAQ",
    "faq_edit_title"=>"Edit FAQ",
    "faq_create_subtitle"=>"Creation block FAQ",
    "faq_edit_subtitle"=>"FAQ editing block",
//Forum
    "text"=>"Text",
    "attachment"=>"Text",
    "subject"=>"Subject",
    "forum_lists"=>"Forum List",
    "forum_management"=>"Forum Management",
    "forum_create_title"=>"Create Forum",
    "forum_edit_title"=>"Edit Forum",
    "forum_create_subtitle"=>"Forum creation block",
    "forum_edit_subtitle"=>"Forum editing block",
//Group
    "group_lists"=>"Group list",
    "group_management"=>"Group management",
    ];
