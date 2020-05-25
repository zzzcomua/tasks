<?php

/**
 * @var BaseController $this
 * @var Task $task
 * @var string|null $description
 */


use Tasks\Controller\BaseController;
use Tasks\Model\Task;


?>

<div class="row my-4">
    <div class="col-sm">
        <form method="post">
            <div class="form-group">
                <label for="inputName">Name: <?= htmlentities($task->name) ?></label>
            </div>
            <div class="form-group">
                <label for="inputEmail">Email: <?= htmlentities($task->email) ?></label>
            </div>
            <div class="form-group">
                <label for="inputDescription">Description*</label>
                <textarea class="form-control" name="description" id="inputDescription"
                          rows="3"><?= htmlentities($description ?? $task->description) ?></textarea>
            </div>
            <div class="form-group">
                <small id="starHelp" class="form-text text-muted">* This field is required</small>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="1">Submit</button>
        </form>
    </div>
</div>