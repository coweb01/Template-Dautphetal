<?php 
 defined('JPATH_BASE') or die;
  
  $data_attr = 'collapse';
  $cssbutton = 'navbar-toggler collapsed';

?>


<!-- Static navbar -->
<div class="navbar navbar-light navbar-expand-lg <?php echo ($bgnavbar == 1 ) ? 'wbc-bg-navbar' : '';?>" role="navigation">
  
      <?php if( $offcanvas == 0 ) : ?> 
          <?php if( $this->params->get('responsive') ) :  //fügt den toggle-sidebar-btn ein wenn dieser im template aktiviert ist?> 
            <a id="toggle-sidebar-btn" class="sidebar-toggle-button"><i class="fa fa-angle-double-right"></i></a>
          <?php endif; ?>
          <button type="button" class="<?php echo $cssbutton;?>" data-toggle="<?php echo $data_attr; ?>" data-target=".navbar-collapse" aria-controls="wbc-navbar-main">
              <span class="sr-only"><?php echo  JText::_('TPL_CO_BLANCO_J3_MENU'); ?></span>
                <span class="navbar-toggler-icon"></span>                             
          </button>
      <?php endif ?>
 
     
      <div class="navbar navbar-collapse collapse flex-nowrap">

        <?php if ( $logoposition == 1) : // Logo vor der Navigation ?>
          <div class="navbar-brand logo-mo">
          <?php include_once JPATH_THEMES . '/' . $this->template . '/includes/logopos.php'; ?>
          </div>
        <?php endif; ?>

        
        <jdoc:include type="modules" name="navMain"/>        


        <?php if ($this->countModules('suche')) : // suche in der Navbar ?>          
          <div class="suche d-print-none wbc-d-xlarge">
            <jdoc:include type="modules" name="suche" style="none" />
          </div>          
        <?php endif; ?>

         <?php if ( $logoposition == 12) :  // Logo am Ende ?>
          <div class="navbar-brand logo-mo">
          <?php include_once JPATH_THEMES . '/' . $this->template . '/includes/logopos.php'; ?>
          </div>
        <?php endif; ?>

      </div><!--/.nav-collapse -->
      
</div>


