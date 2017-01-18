<div class="card-columns">
    <?php foreach($tasks as $task) : ?>
    <div class="card" style="width:320px;">
        <img class="card-img-top" src="http://lorempixel.com/320/240/abstract" alt="Card image cap">
        <div class="card-block">
            <h4 class="card-title">
            <?php if ($task->done) : ?>
                <span class="badge badge-success ">Done</span>
                <?php endif; ?>
                <!--a href="#" class="badge badge-warning card-link ">Edit</a-->
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