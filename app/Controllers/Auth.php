<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        
        if($this->request->getMethod() == 'POST') {
            $rules = [
                'name' => 'required',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]'
            ];

            if(!$this->validate($rules)) {

                return redirect()
                        ->back()
                        ->withInput()
                        ->with(
                            'errors',
                            $this->validator->getErrors()
                        );
            }

            $userModel = new UserModel();

            $userModel->save([

                'name' =>
                    $this->request->getPost('name'),

                'email' =>
                    $this->request->getPost('email'),

                'password' =>
                    password_hash(
                        $this->request->getPost('password'),
                        PASSWORD_DEFAULT
                    )
            ]);

            return redirect()
                    ->to('/login')
                    ->with(
                        'success',
                        'Registration Successful'
                    );
        }

        return view('auth/register');
    }

    public function login()
{
    // print_r($this->request->getMethod());die;
    if ($this->request->getMethod() == 'POST') {

        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel
                ->where('email', $email)
                ->first();

        if ($user && password_verify($password, $user['password'])) {

            session()->set([
                'user_id' => $user['id'],
                'user_name' => $user['name']
            ]);

            // ✅ Trigger event
            \CodeIgniter\Events\Events::trigger('userLoggedIn', $user);

            return redirect()->to('/dashboard');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid Login Credentials');
    }

    return view('auth/login');
}

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}