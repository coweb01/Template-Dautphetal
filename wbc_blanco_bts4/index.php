<?php 
/**********************************************************
 * Template Blanco 
 * Template Joomla 3 Bootstrap4 
 * Kunde:  
 * Author: Claudia Oerter  
 * Stand:  07 / 2019
 * Version: 1.1.1 
 * copyright Template das webconcept
 **********************************************************/
defined( '_JEXEC' ) or die; 

include_once JPATH_THEMES . '/' . $this->template . '/includes/magic.php'; // load magic.php
if (!isset($bootstrap_colclass_mobil_tb)) { $bootstrap_colclass_mobil_tb = ''; };
if (!isset($bootstrap_colclass_mobil_ph)) { $bootstrap_colclass_mobil_ph = ''; };
?>
<!DOCTYPE html>
<!--[if IEMobile]><html class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->

<?php /*
   _   _  ____ _______ ______ 
  | \ | |/ __ \__   __|  ____|
  |  \| | |  | | | |  | |__   
  | . ` | |  | | | |  |  __|  
  | |\  | |__| | | |  | |____ 
  |_| \_|\____/  |_|  |______|  
  
    
*/?>

<head>

	<?php if ($this->params->get('meta-viewport') == 0):?>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<?php endif; ?>
   
 
	<jdoc:include type="head" /> 
    
	
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $tpath;?>/images/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $tpath;?>/images/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $tpath;?>/images/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $tpath;?>/images/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $tpath;?>/images/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $tpath;?>/images/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $tpath;?>/images/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $tpath;?>/images/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $tpath;?>/images/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $tpath;?>/images/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $tpath;?>/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $tpath;?>/images/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $tpath;?>/images/favicon-16x16.png">
 

<!-- ***************************************************************************************************** -->
<!-- *****     copyright Template www.das-webconcept.de       2019                                    **** -->
<!-- ***************************************************************************************************** -->


<?php if ($this->params->get('googleanalytics') && $this->params->get('googleanalyticscode')!='') : ?>
        <!-- GOOGLEANAYLTICS -->
        <?php if($this->params->get('googleanalyticsdomain')){?>
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', '<?php echo $this->params->get('googleanalyticscode');?>', '<?php echo $this->params->get('googleanalyticsdomain');?>');
                ga('set', 'anonymizeIp', true);
                ga('send', 'pageview');
            </script>
        <?php
        }//if
        else {
        ?>
            <script type="text/javascript">

                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', '<?php echo $this->params->get('googleanalyticscode');?>']);
                _gaq.push(['_gat._anonymizeIp']);
                _gaq.push(['_trackPageview']);

                (function() {
                    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                })();

            </script>
        <?php
        }//else
    endif;
?>


</head>


<body id="top" class="body-01 <?php echo $classbody; ?>">
 <div class="prevent-scrolling">

  <!-- start Accesibility  -->
  <h1 class="sr-only sr-only-focusable">Navigation</h1>
  <ul class="sr-only sr-only-focusable">
    <li><a href="#wrap-content" class="sr-only sr-only-focusable"><?php echo JText::_('TPL_WBC_BLANCO_J3_SKIP_TO_CONTENT'); ?></a></li>
    <li><a href="#navigation-main" class="sr-only sr-only-focusable"><?php echo JText::_('TPL_WBC_BLANCO_J3_SKIP_TO_MAIN_NAVIGATION'); ?></a></li>
    <?php if ($this->countModules('header-top-01') ) { ?><li><a href="#header-top-01" class="sr-only sr-only-focusable"><?php echo JText::_('TPL_WBC_BLANCO_J3_SKIP_TO_TOP_NAVIGATION'); ?></a></li><?php } ?>
    <?php if($showleftColumn) { ?><li><a href="#sidebar-left" class="sr-only sr-only-focusable"><?php echo JText::_('TPL_WBC_BLANCO_J3_JUMP_TO_LEFT_INFORMATION'); ?></a></li><?php } ?>
    <?php if($showrightColumn) { ?><li><a href="#sidebar-right" class="sr-only sr-only-focusable"><?php echo JText::_('TPL_WBC_BLANCO_J3_JUMP_TO_RIGHT_INFORMATION'); ?></a></li> <?php } ?>
    <li><a href="#suche" class="sr-only sr-only-focusable"><?php echo JText::_('TPL_WBC_BLANCO_J3_JUMP_TO_SEARCH'); ?></a></li>
  </ul>
  <!-- end Accesibility -->

  <?php   /*  wenn Modul grossflaechiges hintergrundbild */?> 
  <?php if ( $this->countModules('bg-01')) : ?> 
     <div id="bg">
  	   <jdoc:include type="modules" name="bg-01" style="none" />
     </div>
  <?php endif; ?>

  <div id="navbar-phone" class="d-block d-sm-none"></div>

  <div class="wrap-outer">
  <!-- ****************************************************************************************************** -->
  <!-- *     Header                                                                                         * -->
  <!-- ****************************************************************************************************** --> 
  <header class="header" >
    
    <div class="header-top <?php echo ( $fixedheader == 1 ) ? 'sps' :'';?>"  >
      <div class="container<?php  echo ( $navbarHeaderWidth == 1 ) ? '-fluid' : '';?>">

        <?php if ($logoposition == 2 ) : ?>
             <?php include_once JPATH_THEMES . '/' . $this->template . '/includes/logopos.php'; // load logo  ?>
        <?php endif; ?>

        <?php if ($this->countModules('navMain') && $NavMainPos == 1): ?> 
        <nav id="navigation-main"  >
        <?php if ( $BootstrapMenu == 1 ) : ?>
        <?php  include_once JPATH_THEMES . '/' . $this->template . '/includes/navmain.php'; ?>
        <?php else: ?>
            <jdoc:include type="modules" name="navMain" style="none" />
            <div class="clearfix"></div>
        <?php endif; ?>
        </nav>
        <?php endif; ?>

       </div>
    </div><!-- End header-top -->
    
    <div class="header-middle" role="heading"> 

        <?php if ( $this->countModules('header-top-01-1')  || $this->countModules('header-top-01-2') || ( $fontsize && $fontsize_pos == 1 ) ) : ?>
        <div class="container<?php  echo ( $navbarHeaderWidth == 1 ) ? '-fluid' : '';?>">
           <div id="header-top-01" class="base-row <?php echo $bootstrap_rowclass; ?> d-none d-sm-block">
                <div class="<?php echo $bootstrap_colclass_mobil_ph . $col_xs_header_top01;?> <?php echo $bootstrap_colclass_mobil_tb . $col_sm_header_top01;?>  <?php echo $bootstrap_colclass . $col_md_header_top01; ?>">
                            
                  <jdoc:include type="modules" name="header-top-01-1" style="none" />
                  <?php if ( $fontsize  && $fontsize_pos == 1 ) : ?>              
                       <?php include_once JPATH_THEMES . '/' . $this->template . '/includes/fontsize.php'; // load fontsize.php ?>
                  <?php endif; ?> 
                  <jdoc:include type="modules" name="header-top-01-2" style="none" />
                </div>   
            </div>
        </div>
        <?php endif; ?>
    
      <?php if ($this->countModules('navMain') && $NavMainPos == 2): ?> 

        <nav id="navigation-main" role="navigation" <?php echo ( $fixedheader == 1 ) ? 'class="sps"' :'';?> >

        <?php if ( $BootstrapMenu == 1 ) : ?>
        <?php  include_once JPATH_THEMES . '/' . $this->template . '/includes/navmain.php'; // load bootstrap menu  ?>
        <?php else: ?>
         <jdoc:include type="modules" name="navMain" style="none" />
         <div class="clearfix"></div>
        <?php endif; ?>
         </nav>
       
      <?php endif; ?>
        
     
      <?php if ($this->countModules('header-top-02')): ?>      
          <div <?php echo  ( $pos_search  == 'header-top-02' ) ?  $anker_search : ''; ?> class="header-02 container<?php  echo ( $navbarHeaderWidth == 1 ) ? '-fluid' : '';?>">              
              <div id="header-top-02" class="base-row <?php echo $bootstrap_rowclass; ?>">
                  <div class="base-col <?php echo $bootstrap_colclass; ?>12">
                  <jdoc:include type="modules" name="header-top-02" style="none" />
                  </div>   
              </div>
          </div>
      <?php endif; ?>
       
    
      <?php if ( $logoposition == 3) : ?>
          <div class="header-02" role="heading">
            <div class="base-row <?php echo $bootstrap_rowclass; ?>"> 
          <?php include_once JPATH_THEMES . '/' . $this->template . '/includes/logopos.php'; // load frontpagemodules.php ?>
            </div>
          </div><!-- End header-02 -->
      <?php endif; ?>
    
    <?php if ( ($this->params->get('headerimg-select') == 1) && ($this->params->get('headerimg') != NULL) || ($this->countModules('headerimg') ) ) : /*  wenn headerbild */?>   
            
           <?php include_once JPATH_THEMES . '/'.  $this->template . '/includes/headerimg.php'; ?>
           
    <?php endif; ?>
    
    <?php if ($this->countModules('banner') ) : /*  wenn banner */?>   
		<div class="header-banner">
            <jdoc:include type="modules" name="banner" style="none" />
		</div>
    <?php endif; ?>

    <?php if ($this->countModules('navMain') && $NavMainPos == 3): ?> 
       

        <nav id="navigation-main"  <?php echo ( $affix == 1 ) ? 'class="sps"' :'';?> >

          <?php if ($fixedheader && $this->countModules('logo-mobil')): ?>
          <div id="logo-fixed" class="navbar-brand hidden">
                <jdoc:include type="modules" name="logo-mobil" style="none" />
          </div> 
          <?php endif; ?>

          <div class="container <?php echo $fixedheader ? 'container-fixed
' : '' ;?>">
          <?php if ( $BootstrapMenu == 1 ) : ?>
          <?php  include_once JPATH_THEMES . '/' . $this->template . '/includes/navmain.php'; // load bootstrap menu  ?>
          <?php else: ?>
               <jdoc:include type="modules" name="navMain" style="none" />
               <div class="clearfix"></div>
          <?php endif; ?>
           
          </div>
        </nav>
      <?php endif; ?>
        

    </div>   
  </header>
 <!-- ********************   End Header ******************************************************************** -->




  <!-- ****************************************************************************************************** -->
  <!-- *     Main Content                                                                                   * -->
  <!-- ****************************************************************************************************** -->  
   <?php if  ( $headerimg  == 0 ) :?>
   <div class="no-headerimg"></div>
   <?php endif;?>

   <?php if ($this->countModules('onepagetop')): ?>
   <jdoc:include type="modules" name="onepagetop" style="onepage"/>
   <?php endif;?>
   

    <?php if ($this->countModules('breadcrumb')): ?>
    <!-- start Breadcrumbs -->
    <nav id="wrap-breadcrumb" class="d-none d-md-block" aria-label="breadcrumb">
      <div class="container">
        <div class="base-row <?php echo $bootstrap_rowclass; ?>">
            <div class="base-col <?php echo $bootstrap_colclass; ?>12">
            <jdoc:include type="modules" name="breadcrumb" style="none" />
            </div>
        </div>  
      </div>
    </nav>    
    <!-- end breadcrumbs -->
    <?php endif; ?>

    <div class="container "> 
        <div class="main">
        
    <!-- Begin Container content-->
    <div class="main-content" role="main">
        <div class="base-col <?php echo $bootstrap_rowclass; ?>">

    <?php if($showleftColumn) : ?>

    <!-- ****************************************************************************************************** -->
    <!-- *    Sidebar left                                                                                    * -->
    <!-- ****************************************************************************************************** -->  

    <div id="sidebar-left" role="complementary" class="append-sidebar-left base-col col-12 <?php echo $bootstrap_colclass_mobil_tb . $colSidebarLeft_sm . ' ' . $bootstrap_colclass . $colSidebarLeft; ?>" data-set="appendsection">
    
     <?php if ($this->countModules('navMain') && $NavMainPos == 4): ?> 
     <nav id="navigation-main" role="navigation" class="d-none d-sm-block <?php echo $bootstrap_rowclass; ?>">
      <jdoc:include type="modules" name="navMain" style="none" />
     </nav><!-- End Hauptnavigation linke seite  -->
     <div class="clearfix"></div>
     <?php endif; ?>
     
     <?php if ($this->countModules('nav-sidebar-left') ) : ?>
     <div id="toggle-menu-left"><jdoc:include type="modules" name="nav-sidebar-left" style="default" /></div>
     <?php endif; ?>
<?php echo  ( $pos_search  == 'left-01' ) ?  'div '. $anker_search .'></div>' : ''; ?> 
     <jdoc:include type="modules" name="left-01" style="default" /><!--End left-01-->
<?php echo  ( $pos_search  == 'left-02' ) ?  'div'. $anker_search .'></div>' : ''; ?> 
     <jdoc:include type="modules" name="left-02" style="none" /><!--End left-02-->
     </div>
           
                 
    <!-- ***************************** End Sidebar Left ****************************************************** -->
         
         
    <?php endif; ?>

     
    <div id="wrap-content" class="base-row col-12 <?php echo $bootstrap_colclass_mobil_tb . $cols_sm . ' ' . $bootstrap_colclass . $cols;?>">
    <div class="contentarea <?php echo $classinside;?>"> 
        <noscript>
        <!--   Anzeige wenn kein JavaScript -->        
        <div class="alert alert-danger" role="alert"><?php echo JText::_('TPL_WBC_BLANCO_J3_INFOTXTJS'); ?></div>
        <!--   Ende  -->
        </noscript>    
     
        <jdoc:include type="message" />

        <div id="wrap-nav-sidebar-append" class="append-sidebar-before" data-set="appendsectionone"></div> 
         <?php 
        if ( $this->countModules('vorInhalt-01') > 0 ) : ?>
          <div id="vorInhalt-01">
            <jdoc:include type="modules" name="vorInhalt-01" style="default" />
          </div> 
        <?php endif; ?>   

        <?php 
        if ( $this->countModules('vorInhalt-01-col') > 0 ) : /* wenn Modul mehrspaltig */ 
          $countModules =  'vorInhalt-01-col';
          $module_cols  =  $vorcontent_cols;
          include_once JPATH_THEMES . '/' . $this->template . '/includes/frontpagemodules.php'; // load frontpagemodules.php
        endif; ?>                

            
        <?php if (!$hidecontentwrapper) :  // contentbereich + module  anzeigen?>
           <jdoc:include type="component" />
        <?php endif; ?> 
          
        <?php     
        if ( $this->countModules('nachInhalt-01') > 0 ) : /* wenn Module  mehrspaltig */
          $countModules =  'nachInhalt-01';
          $module_cols  =  $aftercontent_cols;
          include_once JPATH_THEMES . '/' . $this->template . '/includes/frontpagemodules.php'; // load frontpagemodules.php
        endif;   ?> 
        
       </div> <!-- Contenarea -->
    </div><!--Content -->
     

    <?php if($showrightColumn) : ?>
    <!-- ****************************************************************************************************** -->
    <!-- *    Sidebar right                                                                                   * -->
    <!-- ****************************************************************************************************** -->  
    <div id="sidebar-right" role="complementary" class="base-col col-12 <?php echo $bootstrap_colclass_mobil_tb . $colSidebarRight_sm . ' ' . $bootstrap_colclass . $colSidebarRight ; ?>">
    
    <?php if ($this->countModules('nav-sidebar-right') ): ?>
    <div class="append-sidebar-nav" data-set="appendsectionone">
    <nav id="wrap-nav-sidebar-right"> 
       <a href="#" id="toggle-btn-right" class="wbc-toggle-btn">
       <p class="headline-submenue d-inline sr-only"><?php echo JText::_('TPL_WBC_BLANCO_J3_HEADLINE_SUBMENUSIDEBAR'); ?> </p>        
              <p class="d-inline wbc-hamburger">
              <span class="line"></span>
              <span class="line"></span>
              <span class="line"></span>
              </p>
        </a>
        <div id="toggle-container-right">
        <jdoc:include type="modules" name="nav-sidebar-right" style="default" />
        </div>
    </nav>
    </div>    
    <?php endif; ?>

    <?php echo  ( $pos_search  == 'right-01' ) ?  'div'. $anker_search .'></div' : ''; ?> 
     <jdoc:include type="modules" name="right-01" style="default" /><!--End right-01-->
    <?php echo  ( $pos_search  == 'right-02' ) ?  'div'. $anker_search .'></div' : ''; ?> 
     <jdoc:include type="modules" name="right-02" style="none" /><!--End right-02-->
    </div>

<!-- ******************************** End Sidebar Right  ************************************************** -->  
    <?php endif; ?>

    </div><!--End Row-->
  </div><!--End Container main-Content-->  

  <div class="clearfix"></div>
  <div class="append-sidebar-bottom" role="complementary" data-set="appendsection"></div>

  <?php if ($this->countModules('nachInhalt-02') ) : ?>
  <div id="wrap-nach-content-02">
  <jdoc:include type="modules" name="nachInhalt-02" style="default" />
  </div>
  <?php endif; ?>             

  </div> <!-- end main -->
</div>  <!-- end container -->      
<!-- </div> end wrap-main -->

<div class="clearfix"></div>
<!-- ****************************    End Main Content ***************************************************** -->

  <?php if ($this->countModules('onepagebottom')): ?>
    <jdoc:include type="modules" name="onepagebottom" style="onepage"/>
  <?php endif;?>

  <?php if ($this->countModules('pagebottom2')): ?>
    <section id="bottom2" class="onepage">
      <div class="container">
          <jdoc:include type="modules" name="pagebottom2" style="none"/>
      </div>
    </section>
  <?php endif;?>

  <?php if ($this->countModules('onepagetoggle')): ?>
  <section id="toggle01" class="onepage-toggle">
    <div id="toggle-module">
      <jdoc:include type="modules" name="onepagetoggle" style="onepagefullsize"/>
    </div>
  </section>
  <?php endif;?>



  </div> <!-- wrap outer -->
  <!-- ****************************************************************************************************** -->
  <!-- *     Footer                                                                                         * -->
  <!-- ****************************************************************************************************** -->  
      
  <footer id="wrap-footer">
       <?php if ($this->countModules('footer-top')): ?>
        <div class="container">
          <div class="base-row <?php echo $bootstrap_rowclass; ?>">
              <div id="footer-top" class="base-col <?php echo $bootstrap_colclass_mobil_tb . '12 ' . $bootstrap_colclass; ?>12">
                <div class="footer-top-bg">
                  <jdoc:include type="modules" name="footer-top" style="none" />
                </div>
              </div>
          </div>
        </div><!--Container-->
        <?php endif; ?>
        
  
        <?php $modpos = 'footer';  ?>
        <?php if ( $this->countModules($modpos)) :?> 
        
        <div id="footer-bottom">
          <div class="container">
          <?php include_once JPATH_THEMES . '/' . $this->template . '/includes/footermodules.php'; // load footermodules.php ?>
          </div> 
        </div> 
        <?php endif; ?>

        <?php if ($this->countModules('footer-bottom')): ?>
        <div class="container">
          <div class="base-row <?php echo $bootstrap_rowclass; ?>">
              <div id="footer-bottom" class="base-col <?php echo $bootstrap_colclass_mobil_tb . '12 ' . $bootstrap_colclass; ?>12 d-none d-sm-block">
                
                  <jdoc:include type="modules" name="footer-bottom" style="none" />
               
              </div>
          </div>
        </div><!--Container-->
        <?php endif; ?>
        

    
        
  </footer>
    <!--End Footer-->

  <jdoc:include type="modules" name="debug" style="none" />

  <div class="d-none d-sm-block ">
    <a class="mb-5" href="#top" id="gototop"><i class="shadow-sm bg-light fa fa-chevron-up"></i> <span class="sr-only"><?php echo JText::_('TPL_WBC_BLANCO_J3_TOP'); ?></span></a>
  </div>

  <div id="gototop-mobil" class="d-flex d-sm-none p-1 bg-dark fixed-bottom">
    <a class="gototop" href="#top"><i class="fa fa-chevron-up"></i><span class="sr-only"> <?php echo JText::_('TPL_WBC_BLANCO_J3_TOP'); ?></span></a>
    <jdoc:include type="modules" name="fixed-footer-mobil" style="none" />
  </div>
</div> <!-- end prevent-scrolling  / used offcanvas -->




<?php
if ( $bootstrap == 4  && $offcanvas == 1 )  :
  include_once JPATH_THEMES . '/' . $this->template . '/includes/offcanvas4.php'; // offcanvas mobil menu
endif; ?> 

<?php if( $this->countModules('sidebar-left-fix') || 
                      $this->countModules('sidebar-left-toggle')  ||
                          $toggleleft   ) : ?>

<div id="left-fixed" class="position-fixed wbc-fixed-sidebar d-print-none ">
    <?php if ( $this->countModules('sidebar-left-fix') ): ?>
    <div class="wbc-fixed-sidebar-left d-none d-sm-block">
      <jdoc:include type="modules" name="sidebar-left-fix" style="none"/>

      <div id="icon-left-search" class="d-print-none wbc-h-xlarge d-flex">
        <a class="nav-link bg-secondary shadow-sm mb-2" title="<?php echo JText::_('COM_SEARCH_SEARCH');?>" href="<?php echo  $searchsite; ?>"><i class="fa fa-search" aria-hidden="true"><span class="sr-only sr-only-focusable"><?php echo JText::_('COM_SEARCH_SEARCH'); ?></span></i></a>
      </div> 
    </div>
    <?php endif; ?>

    
    <?php if ($toggleleft ) :?>    

            <?php if ( $this->countModules('sidebar-left-toggle') || 
                                  ( $fontsize && $fontsize_pos = 3 )|| 
                                   ( $styleswitch && $styleswitch_pos = 3 )) : ?> 
              
              <div id="fixed-sidebar-left-toggle" class="wbc-fixed-sidebar d-none d-sm-block">
                
                   <a class="toggle-btn nav-link btn-icon border border-secondary bg-secondary shadow-sm" role="button" href="#"><i class="<?php echo $iconleft;?>"></i> <span class="sr-only"><?php echo JText::_('TPL_WBC_BLANCO_J3_OPEN_TXT'); ?></span></a>


                  
                   <div id="left-container-fix" class="container-fix">
                    <?php if ( $fontsize  ) : ?>              
                        <?php include_once JPATH_THEMES . '/' . $this->template . '/includes/fontsize.php'; // load fontsize.php ?>
                    <?php endif; ?> 

                    <?php if ( $styleswitch  ) : ?>  
                    <?php include_once JPATH_THEMES . '/' . $this->template . '/includes/CSSswitch.php'; // load CSSswitch.php ?>
                    <?php endif; ?> 
                     <jdoc:include type="modules" name="sidebar-left-toggle" style="none"/>
                   </div>
              </div>
             
            <?php endif; ?>
    <?php endif; ?>  
</div>
<?php endif; ?>

<?php if($this->countModules('sidebar-right-fix') || $this->countModules('sidebar-right-toggle') || $toggleright  ) : ?>

<div id="right-fixed" class="position-fixed wbc-fixed-sidebar d-print-none">
    <?php if ( $this->countModules('sidebar-right-fix') ): ?>
    <div class="wbc-fixed-sidebar-right d-none d-sm-block">
      <jdoc:include type="modules" name="sidebar-right-fix" style="none"/>
    </div>
    <?php endif; ?>



    <?php if ($toggleright ) :?> 

        <?php if ($this->countModules('sidebar-right-toggle') || 
                                    ( $fontsize && $fontsize_pos = 4 ) || 
                                    ( $styleswitch && $styleswitch_pos = 4 ) ): ?>
          <div id="fixed-sidebar-right-toggle" class="wbc-fixed-sidebar d-none d-sm-block"> 
              
               <a class="toggle-btn nav-link btn-icon border border-secondary bg-secondary shadow-sm" role="button" href="#"><i class="<?php echo $iconright;?>"></i> <span class="sr-only"><?php echo JText::_('TPL_WBC_BLANCO_J3_OPEN_TXT'); ?></span></a> 
              
               <div id="right-container-fix" class="container-fix">
                 <?php if ( $fontsize  ) : ?>
                   <?php include_once JPATH_THEMES . '/' . $this->template . '/includes/fontsize.php'; // load fontsize.php ?>
                 <?php endif; ?>

                <?php if ( $styleswitch  ) : ?>  
                <?php include_once JPATH_THEMES . '/' . $this->template . '/includes/CSSswitch.php'; // load CSSswitch.php ?>
                <?php endif; ?> 

                 <jdoc:include type="modules" name="sidebar-right-toggle" style="none"/>
               </div>
          </div>
        <?php endif; ?>
    <?php endif; ?>

</div>
<?php endif; ?>

<?php include_once JPATH_THEMES . '/' . $this->template . '/includes/magictwo.php'; // load scripts ?>



</body>

</html>
