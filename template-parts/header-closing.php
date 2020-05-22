<?php
/**
 * View: header closing divs and nav header menu.
 *
 * @package   WDC\Theme
 * @author    Wendell Cabalhin <wendell.cabalhin@intimation.co.uk>
 * @copyright Copyright (c) 2018, Intimation Creative Ltd
 * @license   MIT
 */

  $args = array(
    // 'menu'            => '',
    // 'container'       => 'div',
    'container_class' => 'collapse navbar-collapse',
    'container_id'    => 'navbar_menu_content',
    'menu_class'      => 'navbar-nav mr-auto',
    'menu_id'         => '',
    // 'echo'            => true,
    // 'fallback_cb'     => 'wp_page_menu',
    // 'list_item_class'     => 'nav-item',
    'link_class'     => 'nav-link',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    // 'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    // 'item_spacing'    => 'preserve',
    // 'depth'           => 0,
    // 'walker'          => '',
    'theme_location'  => 'main_menu'
  );

?>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_menu_content" aria-controls="navbar_menu_content" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <?php wp_nav_menu( $args ); ?>
    </nav>
  </div>
</div>
