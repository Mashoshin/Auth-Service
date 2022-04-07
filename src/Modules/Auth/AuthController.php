<?php

namespace Modules\Auth;

use Core\Domain\Exception\NotFoundException;
use Core\Domain\Exception\ValidationException;
use Core\Infrastructure\Web\Request;
use Core\Presentation\Controller\BaseController;
use Modules\Auth\Domain\Exception\WrongPasswordException;
use Modules\Auth\Infrastructure\AuthService;
use Modules\User\Domain\Dto\UserDto;

class AuthController extends BaseController
{
    public function __construct(
        private Request $request,
        private AuthService $authService
    ) {}

    public function index()
    {
        $error = '';
        try {
            if ($this->authService->isLogin()) {
                return $this->render('main');
            }

            $login = $this->request->getPostParam('login');
            $password = $this->request->getPostParam('password');
            if ($login && $password) {
                $this->authService->login($login, $password);
                return $this->render('main');
            }
        } catch (WrongPasswordException|NotFoundException $e) {
            $error = $e->getMessage();
        }

        return $this->render('login', ['error' => $error]);
    }

    public function register()
    {
        $error = '';
        try {
            $email = $this->request->getPostParam('email');
            $password = $this->request->getPostParam('password');
            $login = $this->request->getPostParam('login');

            if ($email && $password && $login) {
                $this->authService->register(new UserDto($email, $login, $password));
                $this->refresh('/');
            }
        } catch (ValidationException $e) {
            $error = $e->getMessage();
        }

        return $this->render('signup', ['error' => $error]);
    }

    public function logout()
    {
        $this->authService->logout();
        $this->redirect('/');
    }
}
