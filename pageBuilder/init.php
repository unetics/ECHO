<?php
// remove the tabs
remove_filter('siteorigin_panels_widget_dialog_tabs', 'siteorigin_panels_add_widgets_dialog_tabs', 20);

// remove recomended widgets but add back the custom icons
function widgets_icons($widgets){
	$widgets['SiteOrigin_Panels_Widgets_Layout']['icon'] = 'dashicons dashicons-analytics';
	$widgets['button']['icon'] = 'dashicons dashicons-admin-links';
	$widgets['SiteOrigin_Widget_GoogleMap_Widget']['icon'] = 'dashicons dashicons-location-alt';
	return $widgets;
}
remove_filter('siteorigin_panels_widgets', 'siteorigin_widget_add_bundle_groups', 11);
add_filter('siteorigin_panels_widgets', 'widgets_icons');

function parralax_row_style_fields($fields) {
  $fields['id'] = array(
      'name'        => 'Row id',
      'type'        => 'text',
      'group'       => 'attributes',
      'description' => 'A CSS Id',
      'priority'    => 5,
  );
  return $fields;
}

add_filter( 'siteorigin_panels_row_style_fields', 'parralax_row_style_fields' );

function parralax_row_style_attributes( $attributes, $args ) {
    if( !empty( $args['id'] ) ) {
        $attributes['id'] = $args['id'];
    }

    return $attributes;
}

add_filter('siteorigin_panels_row_style_attributes', 'parralax_row_style_attributes', 10, 2);

function mytheme_add_widget_tabs($tabs) {
    $tabs[] = array(
        'title' => __('My Tab', 'mytheme'),
        'filter' => array(
            'groups' => array('depreciated')
        )
    );

    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'mytheme_add_widget_tabs', 20);