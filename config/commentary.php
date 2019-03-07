<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Information about the forum User
    |--------------------------------------------------------------------------
    |
    | Your comments needs to know specific information about your user in order
    | to confirm that they are logged in.
    |
    |   *namespace*: This is the user namespace for your User Model.
    |
    |   *database_field_to_show_account_name*: This is the database field that
    |       is used for the users 'Name', could be 'username', 'first_name'.
    |       This will appear next to the user's avatar in discussions
    |
    */
    'account' => [
        'namespace'                     => 'App\User',
        'database_field_to_show_account_name' => 'name',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default orderby
    |--------------------------------------------------------------------------
    |
    | This determines how the Comments will be ordered when fetched
    |
    */

    'order_by' => [
        'order' => 'created_at',
        'by' => 'ASC',
    ],

     /*
    |--------------------------------------------------------------------------
    | Use Soft Deletes
    |--------------------------------------------------------------------------
    |
    | Setting this to true will mean when a post gets deleted the `deleted_at`
    | date gets set but the actual row in the database does not get deleted.
    | This is useful for forum moderation and history retention
    |
    */

    'soft_deletes' => false,
];
