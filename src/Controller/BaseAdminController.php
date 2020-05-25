<?php


namespace Tasks\Controller;


use Exception;
use Tasks\Model\Task;

abstract class BaseAdminController extends BaseController
{
    /**
     * @return Task
     * @throws Exception
     */
    protected function getTaskGuarded(): Task
    {
        $taskId = (int)($_GET['id'] ?? 0);
        $task = Task::find($taskId);

        if (null === $task) {
            $this->redirectIndex();

            throw new Exception('Task ' . $taskId . ' not found');
        }

        return $task;
    }

    /**
     * @return bool
     * @throws Exception
     */
    protected function guardOnlyAdmin(): void
    {
        if (!$this->session->isLogIn()) {
            $this->redirect('login');

            throw new Exception('Login required.');
        }
    }
}