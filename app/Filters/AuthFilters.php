<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilters implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        
        // Check if user log in
        $level = session()->get('level');

        // Check if not logged in (guest)
        if (!$level) {

            // If Request is guest
            if(in_array('guest', $arguments)){
                return;
            }

            // Redirect to login page
            return redirect()->to('/login');

        }

        // If Logged in but role is not authorized
        if (!in_array($level, $arguments)) {
            return redirect()->to('/');
        }

        // If All done returning

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
