
<?php

    if($_SESSION['logged'] != true){
        echo '<script> window.location.href = "";</script>';
    }

    var_dump($_SESSION);


    use App\Controllers\TeamController;
    use App\Controllers\BoardController;

    var_dump($_GET['url']);

    //require_once('controller/TeamController.php');
    //require_once('controller/BoardController.php');
?>

<form action="" method="post">

    <button type="submit" name="sair">sair</button>

</form>


<?php

if(isset($_POST['sair'])){
    require_once 'include/kill_session.php';
}

?>

<div class="container">
    <div id="content">
        <?php
            $teams = TeamController::listTeamsUser();
            if(isset($teams) && !empty($teams)){
                //var_dump($teams);
                foreach($teams as $team){
                    //var_dump($team);
                    $boards = BoardController::listBoardsTeam($team->getId());
                    //var_dump($boards);
        ?>
        <div class="card mt-4">
            <div class="card-header p-0">
                <div class="row d-flex justify-content-between mx-1">
                    <a href="home/t/<?php echo $team->getId(); ?>" class="text-decoration-none text-dark anc col p-3">
                        <div class="d-flex flex-wrap ">
                            <h6 id="name"><?php echo $team->getName(); ?></h6>
                        </div>
                    </a>
                    <div class="d-flex p-3">
                        <!-- href="view/modal/create_board_modal.php?id_team=<?php echo $team->getId();?>" -->
                        <!-- data-cod="<?php echo $team->getId();?>" -->

                        <a class="button-header create_board" data-toggle="modal" data-target="#create_board" id="a_create_board<?php echo $team->getId();?>" name="a_create_board<?php echo $team->getId();?>" data-cod="<?php echo $team->getId();?>">
                            <div id="plus">
                                <img src="assets/img/home/add_black_24dp.svg" alt="" srcset="" class="" data-toggle="tooltip" data-placement="top" title='Create a new board into "<?php echo $team->getName(); ?>"'>
                            </div>
                        </a>
                        <a href="home/t/<?php echo $team->getId(); ?>" class="button-header ml-1" data-toggle="modal" data-target="#edit_team">
                            <div id="edit">
                                <img src="assets/img/home/mode_edit_black_24dp.svg" alt="" srcset="" class="" data-toggle="tooltip" data-placement="top" title="Edit team">
                            </div>
                        </a>
                        <a href="home/t/<?php echo $team->getId(); ?>" class="button-header ml-1" data-toggle="modal" data-target="#delete_team">
                            <div id="delete">
                                <img src="assets/img/home/close_black_24dp.svg" alt="" srcset="" class="" data-toggle="tooltip" data-placement="top" title="Delete team">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="" class="card-body d-flex flex-wrap">
            <?php 
            if(isset($boards) && !empty($boards)){
                foreach($boards as $board){ ?>
                <a href="/b/<?php echo $board->getId(); ?>" class="anc mx-sm-3 my-sm-3">
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
            <div id="<?php echo 't'.$team->getId(); ?>" class="col-sm-3" style="display: ;">
                <?php //require_once('./view/register/board.php');  ?> 
            </div>
            
            </div>
        </div>
        <?php
                }
            }
            ?>
    </div>
</div>




<script>
    
    /*const aCreateBoard = document.querySelectorAll('[id=create_board]');
    aCreateBoard[0].addEventListener('click', () =>{
        
    })*/
    
</script>





<?php
    if(isset($_REQUEST['action']) && isset($_REQUEST['id_team']) && $_REQUEST['action'] == 'create_board'){
        //echo '<script> addCreateBoard('.$team->getId().'); </script>';
        //require_once './view/register/board.php';
        //print_r($teams);
        //$teste = json_encode($team->getId());
        //echo $teste;
        ?>
        <script> 
            //var div = document.getElementById("#t<?php //echo $_REQUEST['id_team']; ?>").appendChild(`<?php //require_once './view/register/board.php'; ?>`);
            $("#t<?php echo $_REQUEST['id_team']; ?>").load('./view/register/board.php?action=create_board&id_team=<?= $_REQUEST['id_team'] ?>');
            </script>
        <?php
        if(isset($_REQUEST['btnSub'])){
            echo '<script> console.log('.$_REQUEST['btnSub'].');</script>';
            //'<script> console.log(`window.location.href = "/morning-php/"`); debug;</script>';
            require_once('controller/BoardController.php');
            if(call_user_func(array('BoardController','saveBoard'))){
            };
        }
    }
    
    
    ?>
    <!-- <div class="container"> -->
        <div class="modal fade" id="create_board" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create a Board</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control mt-3" placeholder="Description"></textarea>
                            <input type="hidden" name="id_team" id="id_team" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" id="btnCreateBoard" name="btnCreateBoard">Create</button>
                        </div>
                    </form>
                    <script>
                        $(".create_board").click(function () {
                            var atributo = $(this).attr("data-cod");
                            $("#id_team").attr("value", atributo);
                        });
                    </script>
                </div>   
            </div>
        </div>
    <!-- </div> -->

    <?php 
        if(isset($_POST['btnCreateBoard'])){
            if(BoardController::saveBoard()){
                echo '<script>
                window.location.href = `home`;
                </script>';
            }else{
                echo '<script>
                alert(`erro`);
                </script>';
            };

        }

    ?>