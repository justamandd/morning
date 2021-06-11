<form action="" method="post" id="frmBoard" name="frmBoard">
    <div class="card mt-3">
        <div class="card-header">
            <h3>Create a Board</h3>
        </div>
        <div class="card-body">
            <input type="text" name="name" id="name" placeholder="Name" required class="form-control" value="<?php echo isset($boardR)?$boardR->getName():''?>">
            <input type="text" name="description" id="description" placeholder="Description" class="form-control mt-3"value="<?php echo isset($boardR)?$boardR->getDescription():''?>">
            <?php
                if(!isset($_REQUEST['id_team'])){
                ?>
                    <select name="id_team" id="id_team" class="custom-select mt-3" required>
                        <option selected>Select the team will be created</option>
                        <?php

                            if(isset($teams) && !empty($teams)){
                                foreach($teams as $team){
                                    ?>
                                    <option value="<?php echo $team->getId(); ?>"><?php echo $team->getName(); ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                <?php
                }else{
                    ?>
                    <input type="hidden" name="id_team" id="id_team" value="<?php echo $_REQUEST['id_team'];?>">
                    <?php
                }
            ?>
        </div>
        <div class="card-footer">
            <button type="submit" id="btnSub" name="btnSub" class="btn btn-success">Create</button>
            <input type="hidden" name="id" id="id" value="<?php echo isset($boardR)?$boardR->getId():''; ?>">
        </div>
    </div>
</form>
<?php

if(isset($_REQUEST['btnSub'])){
    echo '<script> console.log('.$_REQUEST['btnSub'].');</script>';
    //'<script> console.log(`window.location.href = "/morning-php/"`); debug;</script>';
    require_once('controller/BoardController.php');
    if(call_user_func(array('BoardController','saveBoard'))){
    };
}

?>