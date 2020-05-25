<?php


namespace Tasks\Controller;


class CompleteController extends BaseAdminController
{
    /**
     * @inheritDoc
     */
    public function execute(): ?string
    {
        $this->guardOnlyAdmin();

        $task = $this->getTaskGuarded();

        $this->handlePost(
            function () use ($task) {
                $task->complete = true;
                $task->save();

                return true;
            },
            'Task complete.');

        $this->redirectIndex();
        return null;
    }
}