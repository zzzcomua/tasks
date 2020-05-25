<?php


namespace Tasks\Controller;


class LoginController extends BaseController
{
    /**
     * @inheritDoc
     */
    public function execute(): ?string
    {
        if ($this->session->isLogIn()) {
            $this->addAlertInfo('Already logged in.');
            $this->redirectIndex();;
        }

        $name = $_POST['name'] ?? null;
        $password = $_POST['password'] ?? null;

        $success = $this->handlePost(
            function () use ($name, $password) {
                $isValidName = $this->validatePostField($name, 'Name', null);
                $isValidPassword = $this->validatePostField($password, 'Password', null);

                if (!($isValidName && $isValidPassword)) {
                    return false;
                }

                if (!$this->session->logIn($name, $password)) {
                    $this->addAlertError('Wrong name/password.');
                    return false;
                }

                return true;
            },
            'Welcome back!');

        if ($success) {
            $this->redirectIndex();
            return null;
        }

        return $this->render('login', [
            'name' => $name,
            'password' => $password,
        ]);
    }
}