<?php


namespace Tasks\Controller;


class EditController extends BaseAdminController
{
    /**
     * @inheritDoc
     */
    public function execute(): ?string
    {
        $this->guardOnlyAdmin();

        $task = $this->getTaskGuarded();

        $description = $_POST['description'] ?? null;

        $success = $this->handlePost(
            function () use ($task, $description) {
                $isValidDescription = $this->validatePostField($description, 'Description', null);

                if (!$isValidDescription) {
                    return false;
                }

                if ($description === $task->description) {
                    $this->addAlertInfo('Nothing changed');
                    return true;
                }

                $task->description = $description;
                $task->edited = true;
                $task->save();

                $this->addAlertInfo('Task edited');
                return true;
            }
        );

        if ($success) {
            $this->redirectIndex();
            return null;
        }

        return $this->render('edit', [
            'task' => $task,
            'description' => $description,
        ]);
    }
}