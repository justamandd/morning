<?php

use App\Controllers\TeamController;
use App\Models\Team;
use App\Controllers\BoardController;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a href="home" class="navbar-brand">Morning</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navContent" aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0 d-flex">

            </ul>
            <?php
            if (isset($_SESSION['logged']) == true) {
            ?>
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0 d-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="profile" class="dropdown-item">Profile</a>
                            <a href="disconnect" class="dropdown-item">Log out</a>
                        </div>
                    </li>
                </ul>

            <?php
            }
            ?>
        </div>
    </div>
</nav>
<?php
if (isset($_SESSION['logged']) == true) {
?>
    <nav class="navbar-expand-lg navbar-primary bg-primary text-white">
        <div class="container">
            <div class="d-flex wrap justify-content-around">
                <ul class="navbar-nav d-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="" id="toolbarDropdownT" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Teams
                        </a>
                        <div class="dropdown-menu" aria-labelledby="toolbarDropdownT">
                            <a href="" data-toggle="modal" data-target="#create_team" class="dropdown-item">Create</a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item disabled">Your teams</div>
                            <div class="dropdown-divider"></div>
                            <?php
                            $teams = TeamController::listTeamsUser();
                            if (isset($teams) && !empty($teams)) {
                                foreach ($teams as $team) {
                            ?>
                                    <a href="t/<?php echo $team->getId(); ?>" class="dropdown-item"><?php echo $team->getName(); ?></a>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
}
?>

<div class="modal fade" id="create_team" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create a Team</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="text" name="name_team" id="name_team" class="form-control" placeholder="Name" required>
                    <textarea name="description_team" id="description_team" cols="30" rows="3" class="form-control mt-3" placeholder="Description"></textarea>
                    <input type="hidden" name="id_team" id="id_team" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="btnCreateTeam" name="btnCreateTeam">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

if (isset($_REQUEST['btnCreateTeam'])) {
    $team_c = new Team();
    $team_c->setId($_POST['id_team']);
    $team_c->setName($_POST['name_team']);
    $team_c->setDescription($_POST['description_team']);
    $team_c->setIdUser($_SESSION['id']);

    if (TeamController::saveTeam($team_c)) {
        /*echo '<script>
        window.location.href = `home`;
        </script>';*/
    }
}

?>