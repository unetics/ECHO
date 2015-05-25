<?php
$team = tr_post_type('Gallery', 'Gallery', array(
										'supports' => array('title', 'thumbnail'  ),
										));
$team->id = 'gallery';
$team->icon('gallery');
$team->title = 'Enter Gallery Name';
$team->form['editor'] = true; // set


function add_form_content_gallery_editor() {
$form = tr_form();
$form->gallerys('Gallery Images');
}