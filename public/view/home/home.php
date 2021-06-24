<?php
if (!isset($_SESSION['logged'])) {
    echo '<script> window.location.href = "../public/login";</script>';
}

use App\Models\Team;
use App\Controllers\TeamController;
use App\Controllers\BoardController;
?>
<div class="container mb-5">
    <div id="content">
        <?php
        $teams = TeamController::listTeamsUser();
        if (isset($teams) && !empty($teams)) {
            //var_dump($teams);
            foreach ($teams as $team) {
                //var_dump($team);
                $boards = BoardController::listBoardsTeam($team->getId());
                //var_dump($boards);
        ?>
                <div class="card mt-4">
                    <div class="card-header p-0">
                        <div class="row d-flex justify-content-between mx-1">
                            <a href="t/<?php echo $team->getId(); ?>" class="text-decoration-none text-dark anc col p-3">
                                <div class="d-flex flex-wrap ">
                                    <h6 id="name"><?php echo $team->getName(); ?></h6>
                                </div>
                            </a>
                            <div class="d-flex p-3">
                                <!-- href="view/modal/create_board_modal.php?id_team=<?php echo $team->getId(); ?>" -->
                                <!-- data-cod="<?php echo $team->getId(); ?>" -->


                                <!-- create button -->
                                <a class="button-header create_board" data-toggle="modal" data-target="#create_board<?php echo isset($team) ? $team->getId() : ''; ?>" data-cod="<?php echo $team->getId(); ?>">
                                    <div id="plus">
                                        <img src="assets/img/home/add_black_24dp.svg" alt="" data-toggle="tooltip" data-placement="top" title='Create a new board into "<?php echo $team->getName(); ?>"'>
                                    </div>
                                </a>

                                <!-- edit button -->
                                <a href="" class="button-header ml-1 edit_team" data-toggle="modal" data-target="#edit_team<?php echo isset($team) ? $team->getId() : ''; ?>" data-cod="<?php echo $team->getId(); ?>">
                                    <div id="edit">
                                        <img src="assets/img/home/mode_edit_black_24dp.svg" alt="" data-toggle="tooltip" data-placement="top" title="Edit team">
                                    </div>
                                </a>

                                <!-- delete button -->
                                <a href="" class="button-header ml-1 delete_team" data-toggle="modal" data-target="#delete_team<?php echo isset($team) ? $team->getId() : ''; ?>" data-cod="<?php echo $team->getId(); ?>">
                                    <div id="delete">
                                        <img src="assets/img/home/close_black_24dp.svg" alt="" data-toggle="tooltip" data-placement="top" title="Delete team">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="" class="card-body d-flex flex-wrap">
                        <?php
                        if (isset($boards) && !empty($boards)) {
                            foreach ($boards as $board) { ?>
                                <a href="b/<?php echo $board->getId(); ?>" class="anc mx-sm-3 my-sm-3">
                                    <div class="card board-card">
                                        <div class="card-header">
                                            <small id="title-text"><?php echo $board->getName(); ?></small>
                                        </div>
                                        <div class="card-body">
                                            <small id="desc-text"><?php echo $board->getDescription(); ?></small>
                                        </div>
                                    </div>
                                </a>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <!-- Modal de Criação de Board -->
                <div class="modal fade" id="create_board<?php echo isset($team) ? $team->getId() : ''; ?>" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Create a Board</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <input type="text" name="name_board" id="name_board" class="form-control" placeholder="Name" required>
                                    <textarea name="description_board" id="description_board" cols="30" rows="3" class="form-control mt-3" placeholder="Description"></textarea>
                                    <input type="hidden" name="id_board" id="id_board" value="">
                                    <input type="hidden" name="id_team_board" id="id_team_board" value="<?php echo isset($team) ? $team->getId() : ''; ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success" id="btnCreateBoard<?php echo isset($team) ? $team->getId() : ''; ?>" name="btnCreateBoard<?php echo isset($team) ? $team->getId() : ''; ?>">Create</button>
                                </div>
                            </form>
                            <script>
                                /*$(".create_board").click(function() {
                                    var atributo = $(this).attr("data-cod");
                                    $("#id_team_board").attr("value", atributo);
                                });*/
                            </script>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_POST['btnCreateBoard' . $team->getId()])) {
                    if (BoardController::saveBoard()) {
                        echo '<script>
                        window.location.href = `home`;
                        </script>';
                    }
                }
                ?>

                <!-- Delete -->
                <div class="modal fade" id="delete_team<?php echo isset($team) ? $team->getId() : ''; ?>" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Delete a Team</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="id_team" id="id_team" class="form-control" value="<?php echo isset($team) ? $team->getId() : ''; ?>">
                                    <h2>Are you sure about that?</h2>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success" id="btnDeleteTeam<?php echo isset($team) ? $team->getId() : ''; ?>" name="btnDeleteTeam<?php echo isset($team) ? $team->getId() : ''; ?>">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_POST['btnDeleteTeam' . $team->getId()])) {
                    if (TeamController::removeTeam($_POST['id_team'])) {
                        echo '<script> window.location.href = `home`; </>';
                    }
                }
                ?>

                <!-- Modal de Edição de um Time -->
                <div class="modal fade" id="edit_team<?php echo isset($team) ? $team->getId() : ''; ?>" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit a Team</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="id_team" id="id_team" value="<?php echo isset($team) ? $team->getId() : ''; ?>">
                                    <input type="text" name="name_team" id="name_team" class="form-control" placeholder="Name" value="<?php echo isset($team) ? $team->getName() : ''; ?>" required>
                                    <textarea type="text" name="description_team" id="description_team" cols="30" rows="3" class="form-control mt-3" placeholder="Description"><?php echo isset($team) ? $team->getDescription() : ''; ?></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success" id="btnEditTeam<?php echo isset($team) ? $team->getId() : ''; ?>" name="btnEditTeam<?php echo isset($team) ? $team->getId() : ''; ?>">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_POST['btnEditTeam' . $team->getId()])) {
                    $team_e = new Team();

                    $team_e->setId($_POST['id_team']);
                    $team_e->setName($_POST['name_team']);
                    $team_e->setDescription($_POST['description_team']);
                    $team_e->setIdUser($_SESSION['id']);

                    if (TeamController::saveTeam($team_e)) {
                        //echo '<script> window.location.href = `home`; </>';
                    }
                }
                ?>
        <?php



            }
        }
        ?>
    </div>
</div>





<script>
    function criarCookie(name, value, days) {
        var expires;

        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        } else {
            expires = "";
        }

        document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
    }
</script>

<?php
//if(isset($_COOKIE['team_id'])){
//$edit = TeamController::findTeam();
//}    

?>