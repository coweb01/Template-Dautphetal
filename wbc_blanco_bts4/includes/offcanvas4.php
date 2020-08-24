<?php 
    /* Markup Bootstrap 4 offcanvas Menue
    * Slidebars - A jQuery Framework for Off-Canvas Menus and Sidebars
    * Version: 2.0.2
    * Url: http://www.adchsm.com/slidebars/

    */

    $cssnav    = 'navmenu-fixed-left offcanvas';
    $data_attr = 'offcanvas';
    $cssbutton = 'navbar-toggler navbar-toggle-offcanvas-left';

?>
<div class="offcanvas offcanvas-left">
  <nav class="fixed-top navbar-dark bg-dark" >
    <div class="row no-gutters">
        <div class="col text-left mt-2 ml-2">

          <input type="checkbox" id="hamburg">
          <label for="hamburg" class="hamburg" data-toggle="offcanvas" data-target="#OffcanvasMenuleft">
              <span class="line"></span>
              <span class="line"></span>
              <span class="line"></span>
          </label>
        </div>

        <?php if ($logo_mobil != '-1' || $this->countModules('logo-mobil') ) : ?>
          <div class="col-3 col-xs-2 col-sm-2 col-md-2 navbar-brand">
          <?php if ($this->countModules('logo-mobil')): ?>
              <jdoc:include type="modules" name="logo-mobil" style="none" />
              <?php else : ?><a href="index.php"><img src="<?php echo $this->baseurl ?>/images/<?php echo $logo_mobil?>" class="img-fluid" alt="<?php echo htmlspecialchars($templateparams->get('sitetitle')); ?>" title="<?php echo htmlspecialchars($templateparams->get('sitetitle')); ?>" /></a>
          <?php endif; ?>
          </div> 
        <?php endif; ?>
        <?php if ($this->countModules('offcanvas-navbar') || $styleswitch == 1 ) :?>
          <div class="col">
          <jdoc:include type="modules" name="offcanvas-navbar" style="none" /> 
          <?php if($styleswitch_pos == 5 ) { ?> 
            <?php include_once JPATH_THEMES . '/' . $this->template . '/includes/CSSswitch.php'; // load CSSswitch.php ?>
          <?php } ?>
          </div>
      <?php endif; ?>
    </div>  
  </nav>

  <div id="OffcanvasMenuleft" class="sidebar-offcanvas navbar-dark bg-dark" role='navigation'>
    <div class="wrap-offcanvas">
      <jdoc:include type="modules" name="offcanvas"/>
    </div>                     
  </div> 
</div><!-- /. Offcanvas -->  


						
      
