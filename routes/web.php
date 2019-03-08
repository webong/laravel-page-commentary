<?php

    // Single comment view.
    Route::get('commentary', 'CommentaryController@index')
        ->name('commentary.show');

    // Store comment action.
    Route::post('commentary', 'CommentaryController@store')
        ->name('commentary.add');

    // Add user notification to commentary
    Route::post('commentary/subscribe', 'CommentaryController@subscribe')
        ->name('commentary.subscribe');

    // Remove user notification to commentary
    Route::post('commentary/subscribe', 'CommentaryController@unsubscribe')
        ->name('commentary.unsubscribe');
