<?php
 
// JS Options
$options = array();
$options[] = '\'pos\': \'' . $settings['position'] . '\'';
$options[] = '\'mode\': \'' . $settings['mode'] . '\'';

$options = '{'.implode(',', array_filter($options)).'}';


// Toggle
$toggle  = 'wk-popover-toggle'; 
$toggle .= $settings['toggle'] ? ' {wk}-icon-' . $settings['toggle'] . ' {wk}-icon-button' : '';
// Panel
$panel = '{wk}-panel';
switch ($settings['panel']) {
    case 'box' :
        $panel .= ' {wk}-panel-box';
        break;
    case 'primary' :
        $panel .= ' {wk}-panel-box {wk}-panel-box-primary';
        break;
    case 'secondary' :
        $panel .= ' {wk}-panel-box {wk}-panel-box-secondary';
        break;
}

// Title Size
switch ($settings['title_size']) {
    case 'panel':
        $title_size = '{wk}-panel-title';
        break;
    case 'large':
        $title_size = '{wk}-heading-large {wk}-margin-top-remove';
        break;
    default:
        $title_size = '{wk}-' . $settings['title_size'] . ' {wk}-margin-top-remove';
}

// Link Style
switch ($settings['link_style']) {
    case 'button':
        $link_style = '{wk}-button';
        break;
    case 'primary':
        $link_style = '{wk}-button {wk}-button-primary';
        break;
    case 'button-large':
        $link_style = '{wk}-button {wk}-button-large';
        break;
    case 'primary-large':
        $link_style = '{wk}-button {wk}-button-large {wk}-button-primary';
        break;
    case 'button-link':
        $link_style = '{wk}-button {wk}-button-link';
        break;
    default:
        $link_style = '';
}

// Link Target
$link_target = ($settings['link_target']) ? ' target="_blank"' : '';

// Image
$image = $settings['image'];

if ($settings['image_hero_width'] != 'auto' || $settings['image_hero_height'] != 'auto') {

    $width  = ($settings['image_hero_width'] != 'auto') ? $settings['image_hero_width'] : '';
    $height = ($settings['image_hero_height'] != 'auto') ? $settings['image_hero_height'] : '';

    $image = $app['image']->thumbnailUrl($settings['image'], $width, $height);

}

?>

<?php if ($settings['image']) : ?>

<div class="<?php echo $settings['class']; ?>">
    <div class="{wk}-position-relative {wk}-display-inline-block">

        <img src="<?php echo $image; ?>" alt="Map Greifenstein">

        <?php foreach ($items as $i => $item) :

            $d_marker_icon = "d-none"; 
            $d_marker      = "d-inline-block"; 
            
            // Position
            $left  = isset($item['left']) && $item['left'] ? (float) $item['left'] : '';
            $top   = isset($item['top']) && $item['top'] ? (float) $item['top'] : '';

            if ($left !== 0 && !$left || $top !== 0 && !$top) continue;

            $left .= '%';
            $top  .= '%';

            $toggle_text = isset($item['id_marker']) ? $item['id_marker'] : '';

        ?>

        <div class="{wk}-position-absolute " style="left:<?php echo $left; ?>; top:<?php echo $top; ?>;" data-{wk}-dropdown="<?php echo $options; ?>">

            <?php if ($settings['contrast']) echo '<div class="{wk}-contrast">'; ?>
            
            <?php if ($item['media']) : 
                $d_marker_icon = "d-inline-block"; 
                $d_marker      = "d-none"; 
                $toggle        .= " icon ";   
            endif; ?> 

            <a id="<?php echo 'marker_no_'. $toggle_text;?>" class="<?php echo $toggle; ?>" title="<?php echo $item['title'];?>">
                <?php if ($item['media']) : ?>

                
                <span class="<?php echo $d_marker_icon;?> marker-icon d-block"><?php echo $item->media('media'); ?></span>

                <?php else: ?>

                <span class="<?php echo $d_marker;?>"><?php echo $toggle_text; ?></span>
                <?php endif; ?>   

            </a>

            <?php if ($settings['contrast']) echo '</div>'; ?>

            <div id="<?php echo 'popover_no_'. $toggle_text;?>" class="{wk}-dropdown-blank {wk}-hidden-small" <?php echo ($settings['width']) ? 'style="width:' . $settings['width'] . 'px;"': ''; ?>>

               <?php echo $this->render('plugins/widgets/' . $widget->getConfig('name')  . '/views/_content.php', compact('item', 'settings', 'panel', 'title_size', 'link_style', 'link_target')); ?>

            </div>

        </div>

    <?php endforeach; ?>
    </div>

    <div class="{wk}-margin {wk}-visible-small" data-{wk}-slideset="{default: 1}">
        <div class="{wk}-margin">
            <ul class="{wk}-slideset {wk}-grid {wk}-flex-center">
                <?php foreach ($items as $i => $item) : ?>
                <li><?php echo $this->render('plugins/widgets/' . $widget->getConfig('name')  . '/views/_content.php', compact('item', 'settings', 'panel', 'title_size', 'link_style', 'link_target')); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <ul class="{wk}-slideset-nav {wk}-dotnav {wk}-flex-center"></ul>
    </div>

</div>
<?php endif; ?>
