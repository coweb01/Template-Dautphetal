<?php

return array(

    'name' => 'widget/popover-map',

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => array(

        'name'  => 'popover-map',
        'label' => 'Popover-map',
        'core'  => true,
        'icon'  => 'plugins/widgets/popover-map/widget.svg',
        'view'  => 'plugins/widgets/popover-map/views/widget.php',
        'item'  => array('title', 'content', 'media'),
        'fields' => array(
            array(
                'type' => 'text',
                'name' => 'top',
                'label' => 'Top (%)'
            ),
            array(
                'type' => 'text',
                'name' => 'left',
                'label' => 'Left (%)'
            ),
            array(
                'type' => 'text',
                'name' => 'id_marker',
                'label' => 'marker'
            )
        ),
        'settings' => array(
            'width'             => '',
            'image'             => '',
            'image_hero_width'  => 'auto',
            'image_hero_height' => 'auto',
            'position'          => 'top-center',
            'mode'              => 'hover',
            'toggle'            => 'plus',
            'contrast'          => true,
            'panel'             => 'box',
            'panel_link'        => false,

            'media'             => true,
            'image_width'       => 'auto',
            'image_height'      => 'auto',
            'media_overlay'     => 'icon',
            'overlay_animation' => 'fade',
            'media_animation'   => 'scale',

            'title'             => true,
            'content'           => true,
            'social_buttons'    => true,
            'title_size'        => 'panel',
            'text_align'        => 'left',
            'link'              => true,
            'link_style'        => 'button',
            'link_text'         => 'Read more',

            'link_target'       => false,
            'class'             => ''
        )

    ),

    'events' => array(

        'init.site' => function($event, $app) {
        },

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('popover-map.edit', 'plugins/widgets/popover-map/views/edit.php', true);
        }

    )

);
