<?php 
use framework\App;
use app\controllers\TaskController;
?>
<div class="card-columns">
    <?php foreach($tasks as $task) : ?>
    <div class="card" style="width:320px;">
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