<?php

/**
 * @var BaseController $this
 * @var string|null $name
 * @var string|null $password
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
                <label for="inputPassword">Password*</label>
                <input type="password" class="form-control" name="password" id="inputPassword"
                       aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <small id="starHelp" class="form-text text-muted">* This field is required</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
