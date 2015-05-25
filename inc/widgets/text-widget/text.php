<?php
/*
Plugin Name: Text Widget
Version: 1.2.2
Description: WYSIWYG editor inside a widget
Author: Mitchell Bray
*/

if (!class_exists('HC_Text_Widget')) {

	// Include widget
	add_action('widgets_init', 'hc_text_widget');
	function hc_text_widget(){
		register_widget('HC_Text_Widget');
	}

	class HC_Text_Widget extends WP_Widget {

		public function __construct() {
			// Instantiate the parent object
			parent::__construct(
				'hc_text', // Base ID
				'Text/HTML Editor', // Name
				array('description' => 'Text or HTML with visual editor'), // Args
				array('width' => 600, 'height' => 550)
			);
		}

		public function widget($args, $instance) {
			extract($args);

			if (!$instance['title'] && !$instance['text']) return;

			$title = apply_filters('widget_title', $instance['title']);
			$text = apply_filters('widget_text', $instance['text'], $instance);

			// our filter
			$text = apply_filters('hc_widget_text', $text, $instance);

			echo $before_widget; ?>

				<?php if ($title) echo $before_title . $title . $after_title; ?>
				<?php if ($text) : ?><div class="text"><?php echo $text; ?></div><?php endif; ?>

			<?php echo $after_widget;
		}

		public function form($instance) {
			$instance = wp_parse_args((array)$instance, array('title' => '', 'text' => ''));
			?>
<!--
			<p>
				<label for="<?= $this->get_field_id('title'); ?>">Title:</label>
				<input class="widefat" id="<?= $this->get_field_id('title'); ?>" name="<?= $this->get_field_name('title'); ?>" type="text" value="<?= esc_attr($instance['title']); ?>">
			</p>
-->

			<?php 
			hc_tinymce(array(
				'id' 	=> $this->get_field_id('text'),
				'name' 	=> $this->get_field_name('text'),
				'value' => $instance['text'],
				'rows' 	=> 15
				)); 
		}

		public function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['text'] = $new_instance['text'];
			return $instance;
		}
	}

	add_action('admin_print_footer_scripts', '_hc_tinymce_footer_scripts');
	function _hc_tinymce_footer_scripts() {
		?>
		<style>
			.wp-media-buttons {float: left;}
			.mceIframeContainer {background: #fff;}
			.widget-content .wp-editor-wrap {margin-bottom: 15px;}
		</style>
		<script>
			(function($){

				// parse $_GET params from url
				function getQueryParams(qs) {
					qs = qs.split("+").join(" ");
					var params = {},
						tokens,
						re = /[?&]?([^=]+)=([^&]*)/g;
					while (tokens = re.exec(qs)) {
						params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
					}
					return params;
				}

				// on every ajax call reinit tinyMCE
				$(document).ajaxSuccess(function(evt, request, settings) {
					if (!settings.data) return;

					var $_GET = getQueryParams(settings.data);

					// new widget added
					if ($_GET['widget-id'] && !$_GET['delete_widget']) {
						var widget_id = 'widget-' + $_GET['widget-id'] + '-text';
						hc_tinymce_init(widget_id,['blabla','lll']);
					}

					// reordering widgets
					if ($_GET.action == 'widgets-order') {
						for (var prop in $_GET) {
							if (prop.indexOf('sidebars') === 0) {
								var widgets = $_GET[prop].split(',');
								if (widgets.length > 0) {
									for (var i in widgets) {
										var widget = widgets[i].replace(/widget-\d+_/, '');
										if (widget.indexOf('hc_text-') === 0) {
											hc_tinymce_init('widget-' + widget + '-text');
										}
									}
								}
							}
						}
					}
				});

			})(jQuery);
		</script>
		<?php
	}

	/**
	 * Dynamic TinyMCE
	 */
	if (!function_exists('hc_tinymce')) {
		function hc_tinymce($args) {
			?>
			<div id="wp-<?php echo $args['id']; ?>-wrap" class="wp-core-ui wp-editor-wrap tmce-active has-dfw">
				<div id="wp-<?php echo $args['id']; ?>-editor-tools" class="wp-editor-tools hide-if-no-js">
					<div id="wp-<?php echo $args['id']; ?>-media-buttons" class="wp-media-buttons">
						<?php do_action('media_buttons', $args['id']); ?>
					</div>
					<div class="wp-editor-tabs">
						<a id="<?php echo $args['id']; ?>-html" class="wp-switch-editor switch-html" onclick="switchEditors.switchto(this);">Text</a>
						<a id="<?php echo $args['id']; ?>-tmce" class="wp-switch-editor switch-tmce" onclick="switchEditors.switchto(this);">Visual</a>
					</div>
				</div>
				<?php
				$the_editor = apply_filters('the_editor', '<div id="wp-' . $args['id'] . '-editor-container" class="wp-editor-container"><textarea class="wp-editor-area tinymce-custom-field widefat" rows="'.(isset($args['rows']) ? $args['rows'] : 10).'" cols="40" name="' . $args['name'] . '" id="' . $args['id'] . '">%s</textarea></div>');
				$content = apply_filters('the_editor_content', $args['value']);
				printf($the_editor, $content);
				?>
			</div>
			<script>hc_tinymce_init('<?php echo $args['id']; ?>');</script>
			<?php
		}
		add_action('admin_footer', '_hc_dummy_editor');
		function _hc_dummy_editor() { ?>
			<div class="tinymce-dummy" style="display:none">
				<?php wp_editor('', 'hc-dummy-editor', array(
					'textarea_name' => 'tinymce-dummy',
					'media_buttons' => true
				)); ?>
			</div>
			<?php
		}
		add_action('admin_head', '_hc_tinymce_script');
		function _hc_tinymce_script() { ?>
			<script>
				// call tinymce on textarea
				function hc_tinymce_init(editor_id, ignore_ids) {

					// check if DOM loaded
					if (typeof tinymce === 'undefined') {
						jQuery(document).ready(function(){
							hc_tinymce_init(editor_id);
						});
						return;
					}

					// remove editor if already exist
					if (tinymce.majorVersion == 4) {
						tinyMCE.execCommand("mceRemoveEditor", false, editor_id);
					} else {
						tinyMCE.execCommand("mceRemoveControl", false, editor_id);
					}

					// remove quick tags
					jQuery('#' + editor_id).parent().find('.quicktags-toolbar').remove();

					var ignore = ['hc-dummy-editor', 'widget-hc_text-__i__-text'],
						dummy = 'hc-dummy-editor';

					if (typeof ignore_ids != 'undefined') {
						if (jQuery.isArray(ignore_ids)) {
							ignore = ignore.concat(ignore_ids);
						} else {
							ignore.push(ignore_ids);
						}
					}

					// copy mce init
					var tinyMCENewInit = tinyMCEPreInit;

					var mceInit = jQuery.extend(true, {}, tinyMCEPreInit['mceInit'][dummy]),
						qtInit = jQuery.extend(true, {}, tinyMCEPreInit['qtInit'][dummy]);

					tinyMCENewInit['mceInit'] = {};
					tinyMCENewInit['mceInit'][editor_id] = mceInit;
					tinyMCEPreInit['mceInit'][dummy] = mceInit;
					tinyMCENewInit['mceInit'][editor_id]['elements'] = editor_id; // tinyMCE 3
					tinyMCENewInit['mceInit'][editor_id]['selector'] = '#'+editor_id; // tinyMCE 4

					tinyMCENewInit['qtInit'] = {};
					tinyMCENewInit['qtInit'][editor_id] = qtInit;
					tinyMCENewInit['qtInit'][dummy] = qtInit;
					tinyMCENewInit['qtInit'][editor_id]['id'] = editor_id;

					if (tinymce.majorVersion == 4) {

						(function(){
							var init, edId, qtId, firstInit, wrapper;

							var editorEvent = function(e) {
								jQuery('#' + this.id).val(this.getContent());
							}

							if (typeof tinymce !== 'undefined') {

								for (edId in tinyMCENewInit.mceInit) {

									if (jQuery.inArray(edId, ignore) > -1) continue;

									jQuery('#wp-' + edId + '-wrap').on('click.wp-editor', function() {
										if (this.id) {
											window.wpActiveEditor = this.id.slice(3, -5);
										}
									});

									// copy ttext from editor to textarea
									tinyMCENewInit.mceInit[edId]['setup'] = function(ed) {
										ed.on('keyup', editorEvent);
										ed.on('ExecCommand', editorEvent);
									};

									if (firstInit) {
										init = tinyMCENewInit.mceInit[edId] = tinymce.extend({}, firstInit, tinyMCENewInit.mceInit[edId]);
									} else {
										init = firstInit = tinyMCENewInit.mceInit[edId];
									}

									wrapper = tinymce.DOM.select('#wp-' + edId + '-wrap')[0];

									if ((tinymce.DOM.hasClass(wrapper, 'tmce-active') || !tinyMCENewInit.qtInit.hasOwnProperty(edId)) && !init.wp_skip_init) {

										try {
											tinymce.init(init);

											if (!window.wpActiveEditor) {
												window.wpActiveEditor = edId;
											}
										} catch(e){}
									}
								}
							}

							if (typeof quicktags !== 'undefined') {
								for (qtId in tinyMCENewInit.qtInit) {

									if (jQuery.inArray(qtId, ignore) > -1) continue;

									try {
										quicktags(tinyMCENewInit.qtInit[qtId]);

										if (! window.wpActiveEditor) {
											window.wpActiveEditor = qtId;
										}
									} catch(e){};

									// init buttons
									QTags._buttonsInit();
								}
							}
						}());

					} else { // tinyMCE 3

						(function(){
							var edId, qtId, DOM, el, i, mce = 0;

							var editorEvent = function(ed) {
								jQuery('#' + ed.id).val(tinyMCE.get(ed.id).getContent());
							}

							if (typeof tinymce == 'object') {
								DOM = tinymce.DOM;
								// mark wp_theme/ui.css as loaded
								DOM.files[tinymce.baseURI.getURI() + '/themes/advanced/skins/wp_theme/ui.css'] = true;

								for (edId in tinyMCENewInit.mceInit) {

									if (jQuery.inArray(edId, ignore) > -1) continue;

									DOM.events.add(DOM.select('#wp-' + edId + '-wrap'), 'mousedown', function(e){
										if (this.id) {
											wpActiveEditor = this.id.slice(3, -5);
										}
									});

									// copy ttext from editor to textarea
									tinyMCENewInit.mceInit[edId]['setup'] = function(ed) {
										ed.onKeyUp.add(editorEvent);
										ed.onExecCommand.add(editorEvent);
									};

									if (mce)
										try {
											tinymce.init(tinyMCENewInit.mceInit[edId])
										} catch(e){}
								}
							} else {
								if (tinyMCENewInit.qtInit) {
									for (i in tinyMCENewInit.qtInit) {
										el = tinyMCENewInit.qtInit[i].id;
										if (el) {
											document.getElementById('wp-'+el+'-wrap').onmousedown = function(){
												wpActiveEditor = this.id.slice(3, -5)
											};
										}
									}
								}
							}

							if (typeof QTags != 'undefined') {

								for (qtId in tinyMCENewInit.qtInit) {

									if (jQuery.inArray(qtId, ignore) > -1) continue;

									try {
										quicktags(tinyMCENewInit.qtInit[qtId])
									} catch(e){}

									// init buttons
									QTags._buttonsInit();

									jQuery('#' + qtId + '-tmce').click();
								}
							}
						})();

					}
				}
			</script>
			<?php
		}
	}
}

?>