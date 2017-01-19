<div class="row container" style="margin-top:20px" ng-app>
    <div class="col-6">
        <form action = "/save" method="post" enctype="multipart/form-data">
            <input value="<?= $task->id ?>" name ="id" type="hidden"/>
            <div class="form-check">
                <label class="form-check-label">
                    <input ng-init = "done = <?= $task->done ? "true" : "false" ?>" ng-model="done" name = "done" type="checkbox" class="form-check-input"> Done
                </label>
            </div>
            <div class="form-group">
                <label for="example-text-input">Name</label>
                <input  ng-init = "name = '<?= $task->name ?>'" ng-model="name"  name = "name" class="form-control" type="text" placeholder="Artisanal kale" id="example-text-input">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input  ng-init = "email = '<?= $task->email ?>'"  ng-model="email" name = "email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleTextarea">Text</label>
                <textarea ng-init = "text = '<?= $task->text ?>'" ng-model="text" name = "text" maxlength = 300 rows = 5 class="form-control" id="exampleTextarea"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Picture</label>
                <input  id= "pic" name = "pic" type="file" class="form-control-file" aria-describedby="fileHelp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="card" style="width:320px;">
        <div style = "height: 240px; width: 320px; overflow: hidden;" ><img style="width: 100%;" src = "<?= $task->pic ?>" class="card-img-top" id = "pica"></div>
        <div class="card-block">
            <h4 ng-if = "done" class="card-title">
                <span class="badge badge-success ">Done</span>
            </h4> 
            <p class="card-text" >{{text}}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">{{name}}</li>
            <li class="list-group-item">
                <a href="mailto:{{email}}" class="card-link">{{email}}</a>
            </li>
        </ul>
    </div>
</div>
