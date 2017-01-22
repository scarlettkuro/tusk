<?php 
use framework\App;
use app\controllers\TaskController;
?>
<div class="row container" style="margin: 10px;">
    <h5>
        Sort by:
        <a href="#" onclick="sort('task','email')" class="badge badge-pill badge-info">email</a>
        <a href="#" onclick="sort('task','name')" class="badge badge-pill badge-info">name</a>
        <a href="#" onclick="sort('task','done')" class="badge badge-pill badge-info">done</a>
    </h5>
</div>
<div id = "tasks" class="card-columns">
    <?php foreach($tasks as $task) : ?>
    <div class = "task card " 
         task-email = "<?= $task->email ?>"
         task-name = "<?= $task->name ?>"
         task-done = "<?= $task->done ? 0 : 1 ?>"
         style="width:320px;">
        <?php if ($task->pic) : ?>
        <img src = "<?= $task->pic ?>" class="card-img-top">
        <?php endif; ?>
        <div class="card-block">
            <h4 class="card-title">
                <?php if ($task->done) : ?>
                <span class="badge badge-success">Done</span>
                <?php endif; ?>
                <?php if (App::app()->component('auth')->isUser()) : ?>
                <a href="<?= App::app()->route([TaskController::class, 'task'], [$task->id]) ?>" class="badge badge-warning card-link ">Edit</a>
                <?php endif; ?>
            </h4> 
            <p class="card-text"><?= $task->text ?></p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><?= $task->name ?></li>
            <li class="list-group-item">
                <a href="mailto:<?= $task->email ?>" class="card-link"><?= $task->email ?></a>
            </li>
        </ul>
    </div>
    <?php endforeach; ?>
</div>