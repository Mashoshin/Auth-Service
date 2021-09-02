<?php

namespace src\Modules\Auth;

use Psr\Container\ContainerInterface;
use src\Core\Infrastructure\Web\Request;
use src\Core\Presentation\Controller\BaseController;
use src\Modules\Auth\Infrastructure\AuthService;
use src\Modules\User\Domain\Dto\UserDto;

class AuthController extends BaseController
{
    private AuthService $authService;

    public function __construct(
        ContainerInterface $container,
        Request $request,
        AuthService $authService
    ) {
        parent::__construct($container, $request);
        $this->authService = $authService;
    }

    public function index()
    {
        if ($this->authService->isLogin()) {
            return $this->render('main');
        }

        $login = $this->request->getPostParam('login');
        $password = $this->request->getPostParam('password');
        if ($login && $password) {
            $this->authService->login($login, $password);
            return $this->render('main');
        }

        return $this->render('login');
    }

    public function register()
    {
        $email = $this->request->getPostParam('email');
        $password = $this->request->getPostParam('password');
        $login = $this->request->getPostParam('login');

        if ($email && $password && $login) {
            $this->authService->register(new UserDto($email, $login, $password));
            $this->refresh('/');
        }

        return $this->render('signup');
    }

    public function logout()
    {
        $this->authService->logout();
        $this->redirect('/');
    }
}
