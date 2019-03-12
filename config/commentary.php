<?php

return [
    /*
    * This determines how the Comments will be ordered when fetched
    */
    'order_by' => [
        'order' => 'DESC',
        'by' => 'created_at',
    ],

    /*
    * These are the pagination settings for your comments. Specify how many number
    * of results you want to show per page.
    */
    'paginate_number' => 10,
];
