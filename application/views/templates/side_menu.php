    <?php
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    foreach ($menus as $item): ?>
        <?php if (empty($item->childs) && $item->href != '/'): 
            
            ?>
                <li class="nav-item <?php echo (!empty($item->childs)) ? 'has-treeview' : '' ?>">
                    <a href="<?php echo (!empty($item->childs)) ? '#' : $item->href; ?>"
                     class="nav-link <?php if ($item->href == $actual_link) {echo 'active';}?>">


                        <i class="nav-icon <?php echo $item->icono ?>"></i>
                        <p> <span><?php echo $item->titulo ?></span></p>
                    </a>
                    <?php else: ?>
                            <?php if (!empty($item->childs)):
 
 $active='';
 $menuopen='';
 
 foreach ($item->childs as $child){


                                    if ( $child->href == $actual_link) {$active='active'; 
                                        $menuopen='menu-open';
                                    }

                                }


                                
                                ?>
                                    <li class="nav-item <?php echo (!empty($item->childs)) ? 'has-treeview '.$menuopen : '' ?>"> <!-- aqui va menu-open-->
                                                <a href="<?php echo (!empty($item->childs)) ? '#' : $item->href; ?>" class="nav-link  <?php echo $active;?>"> <!-- aqui va active-->
                                                    <i class="nav-icon <?php echo $item->icono ?>"></i>
                                                    <p>
                                                        <span><?php echo $item->titulo ?></span>
                                                    
                                                    <?php if (!empty($item->childs)): ?>
                                                            <i class="right fas fa-angle-left"></i>
                                                            </p>
                                                </a>
                                                            <ul class='nav nav-treeview'>

                                                                <?php 
                                                               

                                                                foreach ($item->childs as $child): ?>
                                                                     <?php if ( $child->href == $actual_link) $active='active'; else $active='';?> 
                                                                       
                                                                            <li class="nav-item">
                                                                                <a class="nav-link <?php echo $active;?>" href="<?php echo $child->href; ?>">
                                                                                    
                                                                                    <i class="nav-icon <?php echo ($child->icono) ? $child->icono : 'fas fa-angle-double-right' ?>"></i>
                                                                                    <p> <?php echo $child->titulo ?></p>
                                                                                </a>
                                                                            </li>
                                                                              
                                                                <?php endforeach ?>

                                                            </ul>
                                   
                                    </li>

                            <?php endif; ?>
                    <?php endif; ?>
                </li>
       
    <?php endif; ?>

<?php endforeach; ?>