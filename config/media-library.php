<?php

return [

    'disk_name' => env('MEDIA_DISK', 'public'),

    'max_file_size' => 1024 * 1024 * 10,

    'perform_conversions_on_queue' => true,

    'queue_name' => env('MEDIALIBRARY_QUEUE', 'media'),

];
