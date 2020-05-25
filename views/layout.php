<?php

/**
 * @var string $content
 * @var string[] $errors
 * @var string[] $infos
 * @var bool $isLogIn
 */

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

<div class="container my-4">
    <div class="row">
        <div class="col-sm">
            <h1>Tasks demo</h1>
        </div>
        <div class="col-sm">

        </div>
        <div class="col-sm">
            <div class="float-right">
                <?php if ($isLogIn) : ?>
                    <form method="post" action="/?action=logout">
                        <button type="submit" class="btn btn-primary" name="submit" value="1">Log out</button>
                    </form>
                <?php else: ?>
                    <a href="/?action=login" class="btn btn-primary">Log in</a>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <?php foreach($errors as $alert) : ?>
                <div class="alert alert-danger" role="alert"><?=htmlentities($alert) ?></div>
            <?php endforeach; ?>
            <?php foreach($infos as $alert) : ?>
                <div class="alert alert-primary" role="alert"><?=htmlentities($alert) ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <?= $content ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>
