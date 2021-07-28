<?php
/**
 * View: header closing divs and nav header menu.
 *
 * @package   Link365\Theme
 * @author    Wendell Cabalhin <cabalhinwendell@gmail.com>
 * @copyright Copyright (c) 2018
 * @license   MIT
 */

  $args = array(
    'container_class' => 'collapse navbar-collapse',
    'container_id'    => 'navbarCollapse',
    'menu_class'      => 'navbar-nav me-auto mb-2 mb-md-0',
    'menu_id'         => '',
    'link_class'     => 'nav-link',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'theme_location'  => 'main_menu'
  );

?>

    <?php wp_nav_menu( $args ); ?>
    <div class="d-flex">
      <a href="">Wallace Huo</a>
    </div>
  </div>
</nav>