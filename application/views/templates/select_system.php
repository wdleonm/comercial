<li class="nav-item dropdown">
    <!--pincipal -->
    <?php if (empty($sistemas)) : ?>
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
            <span class="badge">
            <i class="fas fa-desktop"></i>
                No Hay Sistema
                <i class="fas fa-caret-down"></i>
            </span>
        </a>
    <?php else : ?>
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
            <span class="badge">
                <i class="fas fa-desktop"></i>
                <?php echo $this->session->userdata('sys_name'); ?>
                <i class="fas fa-caret-down"></i>
            </span>
        </a>
        <?php $pid = null;
            $x = 0;
            foreach ($sistemas as $item) :
                if ($x == 0) {
                    echo '<ul class="dropdown-menu" role="menu ">
                                               
                                                ';
                }


                if ($item->pid != $pid) :
                    if ($item->pid != null) :
                        ?>
                <?php
                            //  echo '</ul>';
                            endif;
                            $pid = $item->pid;

                            ?>
                <?php
                            if ($x > 0) {
                                echo '<li class="dropdown-divider"></li>';
                            }
                            ?>
            <?php
                    endif;



                    ?>

<li>
    <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/inicio/cambio_sistema/<?php echo $item->id; ?>/<?php echo $item->pid; ?>">
        <!-- <span class="badge"> -->
        <?php echo $item->ver; ?>
        <!-- </span> -->
    </a>
</li>
<?php $x++;
    endforeach; ?>
</ul>
<?php endif; ?>
</li>