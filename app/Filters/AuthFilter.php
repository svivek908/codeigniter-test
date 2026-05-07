<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before($request, $arguments = null)
{
    // Allow login & register without session
    $uri = service('uri')->getSegment(1);

    if (in_array($uri, ['login', 'register'])) {
        return;
    }

    if (!session()->get('user_id')) {
        return redirect()->to('/login');
    }
}

    public function after(RequestInterface $request,
                          ResponseInterface $response,
                          $arguments = null)
    {
    }
}