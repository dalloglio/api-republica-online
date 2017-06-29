<?php

Route::get('teste', function() {
    $photo = factory(\App\Domains\Photo\Photo::class)->make();

    dd($photo->toArray());
});