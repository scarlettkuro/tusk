<?php 
use framework\App;
use app\controllers\TaskController;
use app\controllers\UserController;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Tusk</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="card card-inverse" style="background-color: #333; border-color: #333;">
                <div class="card-block row">
                    <div class = "col-4">
                        <a href="<?= App::app()->route([TaskController::class, 'index']) ?>" class="card-title col-6"><h3>Tusk</h3></a>
                        <p class="card-text">Simple task manager.</p>
                        <a href="<?= App::app()->route([TaskController::class, 'task']) ?>" class="btn btn-primary">Add task</a>
                    </div>
                    <div class = "col-8">
                        <?php if (!$admin) : ?>
                        <form action = "<?= App::app()->route([UserController::class, 'auth']) ?>" method = "post" class="form-inline">
                            <input type="text" name="username" class="form-control " placeholder="username">
                            <input type="text" name="password" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="password">
                            
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </form>
                        <?php else : ?>
                        <a href ="<?= App::app()->route([UserController::class, 'logout']) ?>" class="btn btn-primary">Sign out</a>
                        <?php endif; ?>
                    </div>
                    
                </div>
            </div>
            <?=$content?>
        </div>
        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
        <script src="/js/index.js"></script>
    </body>
</html>
