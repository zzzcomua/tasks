<?php

/**
 * @var IndexController $this
 * @var Collection|Task[] $tasks
 * @var string[] $sortFieldsList
 * @var string[] $sortOrderList
 * @var int $currentPage
 * @var int $totalPages
 * @var bool $isLogIn
 */


use \Illuminate\Database\Eloquent\Collection;
use Tasks\Controller\IndexController;
use Tasks\Model\Task;


?>

<div class="row my-4">
    <div class="col-sm">
        Sort
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                by field
            </button>
            <div class="dropdown-menu">
                <?php foreach($sortFieldsList as $key => $url): ?>
                    <a class="dropdown-item" href="<?=$url?>"><?=$key?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                order
            </button>
            <div class="dropdown-menu">
                <?php foreach($sortOrderList as $key => $url): ?>
                    <a class="dropdown-item" href="<?=$url?>"><?=$key?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <a class="btn btn-primary float-right" href="/?action=add">Add</a>
    </div>
</div>
<?php foreach ($tasks as $task) :?>
    <div class="row">
        <div class="col-sm col-md-2">
            <code>#<?= $task->id ?></code>
            <?= htmlentities($task->name) ?>
        </div>
        <div class="col-sm col-md-2">
            <?= htmlentities($task->email) ?>
        </div>
        <div class="col-sm col-md-2">
            <?= $task->complete?'Complete':'Not&nbsp;complete' ?>,
            <?= $task->edited?'Edited':'Not&nbsp;edited' ?>.
        </div>
        <div class="col-sm col-md-6">
            <?php if ($isLogIn) : ?>
                <div class="btn-group float-right">
                    <?php if (!$task->complete): ?>
                        <form method="post" action="/?action=complete&id=<?= $task->id ?>">
                            <button type="submit" class="btn btn-primary" name="submit" value="1">Complete</button>
                        </form>
                    <?php endif; ?>
                    <a class="btn btn-primary" href="/?action=edit&id=<?= $task->id ?>">
                        Edit
                    </a>
                </div>
            <?php endif; ?>

            <?= htmlentities($task->description) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <hr>
        </div>
    </div>
<?php endforeach; ?>
<div class="row my-4">
    <div class="col-sm">
        Pages
        <div class="btn-group">
            <?php for($p = 1; $p <= $totalPages; $p++): ?>
                <a class="btn <?=$p==$currentPage ? 'btn-secondary' : 'btn-primary' ?>" href="/?<?=$this->replaceGetParam('page', $p) ?>">
                    <?=$p?>
                </a>
            <?php endfor; ?>
        </div>
    </div>
    <div class="col-sm">
    </div>
    <div class="col-sm">
    </div>
</div>
