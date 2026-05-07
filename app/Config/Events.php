<?php

use CodeIgniter\Events\Events;

Events::on('userLoggedIn', function($user){

    $taskModel = new \App\Models\TaskModel();

    $titles = [
        'Complete Documentation',
        'Prepare Report',
        'Check Emails',
        'Update Profile',
        'Review Pending Work'
    ];

    $randomTitle = $titles[array_rand($titles)];

    $taskModel->save([
        'user_id' => $user['id'],
        'title' => $randomTitle,
        'description' => 'Auto generated task after login',
        'status' => 'Pending',
        'due_date' => date('Y-m-d', strtotime('+2 days'))
    ]);

});