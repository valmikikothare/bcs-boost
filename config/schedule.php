<?php

return [
    'email_batch_size' => env('SCHEDULE_EMAIL_BATCH_SIZE', 10),
    'reminder_days_before' => env('SCHEDULE_REMINDER_DAYS_BEFORE', 1),
];
