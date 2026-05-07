<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Dashboard extends BaseController
{
    public function index()
    {
        if(!session()->get('user_id')) {

            return redirect()->to('/login');
        }

        $taskModel = new TaskModel();

        $data['tasks'] = $taskModel
            ->where(
                'user_id',
                session()->get('user_id')
            )
            ->findAll();

        return view('dashboard', $data);
    }
}