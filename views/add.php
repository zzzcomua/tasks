<?php

/**
 * @var BaseController $this
 * @var string|null $name
 * @var string|null $email
 * @var string|null $description
 */


use Tasks\Controller\BaseController;


?>

<div class="row my-4">
    <div class="col-sm">
        <form method="post">
            <div class="form-group">
                <label for="inputName">Name*</label>
                <input type="text" class="form-control" name="name" id="inputName"
                       value="<?= htmlentities($name) ?>">
            </div>
            <div class="form-group">
                <label for="inputEmail">Email*</label>
                <input type="email" class="form-control" name="email" id="inputEmail" aria-describedby="emailHelp"
                       value="<?= htmlentities($email) ?>">
            </div>
            <div class="form-group">
                <label for="inputDescription">Description*</label>
                <textarea class="form-control" name="description" id="inputDescription"
                          rows="3"><?= htmlentities($description) ?></textarea>
            </div>
            <div class="form-group">
                <small id="starHelp" class="form-text text-muted">* This field is required</small>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="1">Submit</button>
        </form>
    </div>
</div>
