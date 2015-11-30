<?php
/**
 * Created by PhpStorm.
 * User: Evan
 * Date: 11/26/2015
 * Time: 6:06 PM
 */
?>


<div class="row">
    <div class="list-group col-xs-8 col-sm-8 col-md-4 col-lg-4 col-md-offset-2 col-lg-offset-2 col-xs-offset-1 col-sm-offset-1">
        <a  class="list-group-item active">
            Users Found
        </a>

        <?php
            if(isset($this->foundUsers)) {
                foreach ($this->foundUsers as $person) {
                    echo '<a href="'.URL . 'wall?u=' . $person['user_id']  .'" class="list-group-item">'. $person['first_name']. ' ' . $person['last_name'] . '</a>';
                }
            }
             else
                echo '<a class="list-group-item">No Users Found</a>';
        ?>


    </div>
</div>
<div class="row">
    <div class="list-group col-xs-8 col-sm-8 col-md-4 col-lg-4 col-md-offset-2 col-lg-offset-2 col-xs-offset-1 col-sm-offset-1">
        <a  class="list-group-item active">
            Groups Found
        </a>
        <?php
        if(isset($this->foundGroups)) {
            foreach ($this->foundGroups as $group) {
                echo '<a href="'.URL . 'groups/group?g=' . $group['group_id']  .'" class="list-group-item">'. $group['name'] . '</a>';
            }
        }
        else
            echo '<a class="list-group-item">No Groups Found</a>';
        ?>
    </div>
</div>



</br>