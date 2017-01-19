<div class="card-deck">
    <?php foreach($tasks as $task) : ?>
    <div class="card" style="width:320px;">
        <div style = "height: 240px; width: 320px; overflow: hidden;" >
            <img style="width: 100%;" src = "<?= $task->pic ?>" class="card-img-top">
        </div>
        <div class="card-block">
            <h4 class="card-title">
            <?php if ($task->done) : ?>
                <span class="badge badge-success ">Done</span>
                <?php endif; ?>
                <a href="/task/<?= $task->id ?>" class="badge badge-warning card-link ">Edit</a>
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