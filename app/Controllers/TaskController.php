<?php

namespace App\Controllers;

use App\Models\TaskModel;

class TaskController extends BaseController
{
    public function index()
    {
        return view('tasks/index');
    }

    public function store()
        {
            $rules = [
                'title'       => 'required|min_length[3]',
                'description' => 'required|min_length[5]',
                'status'      => 'required|in_list[Pending,Completed]',
                'due_date'    => 'required|valid_date'
            ];

            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => false,
                    'errors' => $this->validator->getErrors()
                ]);
            }

            $taskModel = new \App\Models\TaskModel();

            $taskModel->save([
                'user_id'     => session()->get('user_id'),
                'title'       => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'status'      => $this->request->getPost('status'),
                'due_date'    => $this->request->getPost('due_date')
            ]);

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Task Added Successfully'
            ]);
        }

    public function edit($id)
    {
        $taskModel = new TaskModel();

        $task = $taskModel
            ->where('id', $id)
            ->where('user_id', session()->get('user_id'))
            ->first();

        return $this->response->setJSON($task);
    }

    public function update($id)
    {
        $taskModel = new TaskModel();

        $taskModel->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'due_date' => $this->request->getPost('due_date')
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Task Updated'
        ]);
    }

    public function delete($id)
    {
        $taskModel = new TaskModel();

        $taskModel
            ->where('id', $id)
            ->where('user_id', session()->get('user_id'))
            ->delete();

        return $this->response->setJSON([
            'status' => true
        ]);
    }
    public function getTasks()
{
    $taskModel = new TaskModel();

    $tasks = $taskModel
        ->where('user_id', session()->get('user_id'))
        ->findAll();

    $data = [];

    foreach ($tasks as $task) {
        $data[] = [
            'title' => $task['title'],
            'description' => $task['description'],
            'status' => $task['status'],
            'due_date' => $task['due_date'],
            'action' => '
                <button onclick="editTask('.$task['id'].')">Edit</button>
                <button onclick="deleteTask('.$task['id'].')">Delete</button>
            '
        ];
    }

    return $this->response->setJSON([
        'data' => $data // ⚠️ DataTables expects "data"
    ]);
}
}