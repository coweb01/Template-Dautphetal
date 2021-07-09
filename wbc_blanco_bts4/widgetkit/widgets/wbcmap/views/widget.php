<?php

if ($app['config']->get('googlemapseapikey') && !$app['scripts']->get('googlemapsapi')) {
    $app['scripts']->add('googlemapsapi', 'GOOGLE_MAPS_API_KEY = "'.trim($app['config']->get('googlemapseapikey')).'";', array(), 'string');
}

$app['scripts']->add('widgetkit-maps', 'assets/js/maps/maps.js', array(), array('defer' => true));
$app['scripts']->add('widgetkit-marker', 'assets/js/maps/marker-helper.js', array(), array('defer' => true));

$map_id  = uniqid('wk-map');
$markers = array();
$width   = $settings['width']  == 'auto' ? 'auto'  : ((int)$settings['width']).'px';
$height  = $settings['height'] == 'auto' ? '300px' : ((int)$settings['height']).'px';

// Markers
foreach ($items as $i => $item) {

    if (isset($item['location']) && $item['location']) {

        $icon = trim(isset($item['location']['marker']) ? $item['location']['marker'] : '');

        if ($icon && !filter_var($icon, FILTER_VALIDATE_URL) && realpath($icon)) {
            $icon = $app['request']->getBaseUrl() .'/'. $item['location']['marker'];
        }

        $marker_id = isset($item['marker']) ? $item['marker'] : ''; /* override webconcept */

        $marker = array(
            'lat'     => $item['location']['lat'],
            'lng'     => $item['location']['lng'],
            'icon'    => $icon,
            'title'   => $item['title'],
            'content' => ''
        );

        if (($item['title'] && $settings['title']) ||
            ($item['content'] && $settings['content']) ||
            ($item['media'] && $settings['media'])) {
                $marker['content'] = $app->convertUrls($this->render('plugins/widgets/' . $widget->getConfig('name')  . '/views/_content.php', compact('item', 'settings')));
        }

        $markers[] = $marker;
    }
}



$settings['markers'] = $markers;
$settings['directionsText'] = $app['translator']->trans('Get Directions');

?>

<script type="widgetkit/map" data-id="<?= $map_id;?>" data-class="<?= $settings['class'] ?> {wk}-preserve-width" data-style="width:<?= $width?>;height:<?= $height?>;">
    <?= json_encode($settings) ?>
</script>

<?php 
// legende markers
echo '<ul class="wbc-map-legende uk-list">';
foreach ($items as $i => $item) {

      echo '<li><span class="wbc-marker"><span class="wbc-marker-txt">' . $item['marker'] . '</span></span><span>' . $item['title']. '</span></li>';
    }
echo '</ul>';
?>