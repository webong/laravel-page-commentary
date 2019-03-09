<?php

    // Single comment view.
    Route::get('commentary', 'CommentaryController@index')
        ->name('commentary.index');

    // Store comment action.
    Route::post('commentary', 'CommentaryController@store')
        ->name('commentary.store');

