<?php

return array(

    'name' => 'widget/wbcmap',

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => array(

        'name'  => 'wbcmap',
        'label' => 'WBC Map',
        'core'  => true,
        'icon'  => 'plugins/widgets/wbcmap/widget.svg',
        'view'  => 'plugins/widgets/wbcmap/views/widget.php',
        'item'  => array('title', 'content', 'media'),
        'fields' => array(
            array('name' => 'location'),
            array(
                'type' => 'text',
                'name' => 'marker',
                'label' => 'marker-id'
            )
        ),
        'settings' => array(
            'width'                   => 'auto',
            'height'                  => 400,
            'maptypeid'               => 'roadmap',
            'maptypecontrol'          => false,
            'mapctrl'                 => true,
            'zoom'                    => '9',
            'marker'                  => '2',
            'marker_icon'             => '',
            'markercluster'           => false,
            'popup_max_width'         => 300,
            'zoomwheel'               => true,
            'draggable'               => true,
            'directions'              => false,
            'disabledefaultui'        => false,

            'styler_invert_lightness' => false,
            'styler_hue'              => '',
            'styler_saturation'       => 0,
            'styler_lightness'        => 0,
            'styler_gamma'            => 0,

            'media'                   => true,
            'image_width'             => 'auto',
            'image_height'            => 'auto',
            'media_align'             => 'top',
            'media_width'             => '1-2',
            'media_breakpoint'        => 'm',
            'media_border'            => 'none',
            'media_overlay'           => 'icon',
            'overlay_animation'       => 'fade',
            'media_animation'         => 'scale-up',

            'title'                   => true,
            'content'                 => true,
            'social_buttons'          => true,
            'title_size'              => 'h3',
            'title_element'           => 'h3',
            'text_align'              => 'left',
            'link'                    => true,
            'link_style'              => 'button',
            'link_text'               => 'Read more',

            'link_target'             => false,
            'class'                   => ''
        )

    ),

    'events' => array(

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('wbcmap.edit', 'plugins/widgets/wbcmap/views/edit.php', true);

            if ($app['config']->get('googlemapseapikey')) {
                $app['scripts']->add('googlemapsapi', 'GOOGLE_MAPS_API_KEY = "'.trim($app['config']->get('googlemapseapikey')).'";', array(), 'string');
            }
        }

    )

);
