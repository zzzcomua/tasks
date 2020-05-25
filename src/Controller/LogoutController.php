<?php


namespace Tasks\Controller;


class LogoutController extends BaseAdminController
{
    /**
     * @inheritDoc
     */
    public function execute(): ?string
    {
        $this->guardOnlyAdmin();

        $this->handlePost(
            function () {
                $this->session->logOut();

                return true;
            },
            'Good bye!');

        $this->redirectIndex();
        return null;
    }
}