<?php


namespace Tasks\Controller;


use Tasks\Model\Task;

class AddController extends BaseController
{
    /**
     * @inheritDoc
     */
    public function execute(): ?string
    {
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $description = $_POST['description'] ?? null;

        $success = $this->handlePost(
            function () use ($name, $email, $description) {
                $isValidName = $this->validatePostField($name, 'Name', null);
                $isValidEmail = $this->validatePostField($email, 'Email', FILTER_VALIDATE_EMAIL);
                $isValidDescription = $this->validatePostField($description, 'Description', null);

                if (!($isValidName && $isValidEmail && $isValidDescription)) {
                    return false;
                }

                $task = new Task();
                $task->name = $name;
                $task->email = $email;
                $task->description = $description;
                $task->save();

                return true;
            },
            'Task added');

        if ($success) {
            $this->redirectIndex();
            return null;
        }

        return $this->render('add', [
            'name' => $name,
            'email' => $email,
            'description' => $description,
        ]);
    }
}