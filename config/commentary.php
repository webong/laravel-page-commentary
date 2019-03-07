<?php

return [
     /*
     * The comment class that should be used to store and retrieve
     * the comments.
     */
    'comment_class' => \CreativityKills\Commentary\Models\Comment::class,

    /*
     * The user model that should be used when associating comments with
     * commentators. If null, the default user provider from your
     * Laravel authentication configuration will be used.
     */
    'user_model' => null,

    /*
    * This determines how the Comments will be ordered when fetched
    */
    'order_by' => [
        'order' => 'ASC',
        'by' => 'created_at',
    ],

    /*
    * These are the pagination settings for your comments. Specify how many number
    * of results you want to show per page.
    */
    'paginate_number' => 10,
];
