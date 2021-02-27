<?php

$user = wp_get_current_user();
if (in_array('contributor', (array) $user->roles)) {
	get_header();
	echo "<br><br>";
}

$ativado = get_field('ativado');  
$permitido = false;
foreach (get_field('conteudista') as $cont) {
   if(get_current_user_id() == $cont){
      $permitido = true;
   }   
}                  

if (($ativado[0] == "Ativado" && $permitido) || in_array('administrator', (array) $user->roles) || in_array('author', (array) $user->roles)) {


/**
 * Post advanced form for inclusion in the administration panels.
 *
 * @package WordPress
 * @subpackage Administration
 */

// Don't load directly.
if (!defined('ABSPATH')) {
	die('-1');
}

/**
 * @global string       $post_type
 * @global WP_Post_Type $post_type_object
 * @global WP_Post      $post             Global post object.
 */
global $post_type, $post_type_object, $post;

// Flag that we're not loading the block editor.
$current_screen = get_current_screen();
$current_screen->is_block_editor(false);

if (is_multisite()) {
	add_action('admin_footer', '_admin_notice_post_locked');
} else {
	$check_users = get_users(
		array(
			'fields' => 'ID',
			'number' => 2,
		)
	);

	if (count($check_users) > 1) {
		add_action('admin_footer', '_admin_notice_post_locked');
	}

	unset($check_users);
}

wp_enqueue_script('post');

$_wp_editor_expand   = false;
$_content_editor_dfw = false;

if (
	post_type_supports($post_type, 'editor')
	&& !wp_is_mobile()
	&& !($is_IE && preg_match('/MSIE [5678]/', $_SERVER['HTTP_USER_AGENT']))
) {
	/**
	 * Filters whether to enable the 'expand' functionality in the post editor.
	 *
	 * @since 4.0.0
	 * @since 4.1.0 Added the `$post_type` parameter.
	 *
	 * @param bool   $expand    Whether to enable the 'expand' functionality. Default true.
	 * @param string $post_type Post type.
	 */
	if (apply_filters('wp_editor_expand', true, $post_type)) {
		wp_enqueue_script('editor-expand');
		$_content_editor_dfw = true;
		$_wp_editor_expand   = ('on' === get_user_setting('editor_expand', 'on'));
	}
}

if (wp_is_mobile()) {
	wp_enqueue_script('jquery-touch-punch');
}

/**
 * Post ID global
 *
 * @name $post_ID
 * @var int
 */
$post_ID = isset($post_ID) ? (int) $post_ID : 0;
$user_ID = isset($user_ID) ? (int) $user_ID : 0;
$action  = isset($action) ? $action : '';

if ((int) get_option('page_for_posts') === $post_ID && empty($post->post_content)) {
	add_action('edit_form_after_title', '_wp_posts_page_notice');
	remove_post_type_support($post_type, 'editor');
}

$thumbnail_support = current_theme_supports('post-thumbnails', $post_type) && post_type_supports($post_type, 'thumbnail');
if (!$thumbnail_support && 'attachment' === $post_type && $post->post_mime_type) {
	if (wp_attachment_is('audio', $post)) {
		$thumbnail_support = post_type_supports('attachment:audio', 'thumbnail') || current_theme_supports('post-thumbnails', 'attachment:audio');
	} elseif (wp_attachment_is('video', $post)) {
		$thumbnail_support = post_type_supports('attachment:video', 'thumbnail') || current_theme_supports('post-thumbnails', 'attachment:video');
	}
}

if ($thumbnail_support) {
	add_thickbox();
	wp_enqueue_media(array('post' => $post_ID));
}

// Add the local autosave notice HTML.
add_action('admin_footer', '_local_storage_notice');

/*
 * @todo Document the $messages array(s).
 */
$permalink = get_permalink($post_ID);
if (!$permalink) {
	$permalink = '';
}

$messages = array();

$preview_post_link_html   = '';
$scheduled_post_link_html = '';
$view_post_link_html      = '';

$preview_page_link_html   = '';
$scheduled_page_link_html = '';
$view_page_link_html      = '';

$preview_url = get_preview_post_link($post);

$viewable = is_post_type_viewable($post_type_object);

if ($viewable) {

	// Preview post link.
	$preview_post_link_html = sprintf(
		' <a target="_blank" href="%1$s">%2$s</a>',
		esc_url($preview_url),
		__('Preview post')
	);

	// Scheduled post preview link.
	$scheduled_post_link_html = sprintf(
		' <a target="_blank" href="%1$s">%2$s</a>',
		esc_url($permalink),
		__('Preview post')
	);

	// View post link.
	$view_post_link_html = sprintf(
		' <a href="%1$s">%2$s</a>',
		esc_url($permalink),
		__('View post')
	);

	// Preview page link.
	$preview_page_link_html = sprintf(
		' <a target="_blank" href="%1$s">%2$s</a>',
		esc_url($preview_url),
		__('Preview page')
	);

	// Scheduled page preview link.
	$scheduled_page_link_html = sprintf(
		' <a target="_blank" href="%1$s">%2$s</a>',
		esc_url($permalink),
		__('Preview page')
	);

	// View page link.
	$view_page_link_html = sprintf(
		' <a href="%1$s">%2$s</a>',
		esc_url($permalink),
		__('View page')
	);
}

$scheduled_date = sprintf(
	/* translators: Publish box date string. 1: Date, 2: Time. */
	__('%1$s at %2$s'),
	/* translators: Publish box date format, see https://www.php.net/manual/datetime.format.php */
	date_i18n(_x('M j, Y', 'publish box date format'), strtotime($post->post_date)),
	/* translators: Publish box time format, see https://www.php.net/manual/datetime.format.php */
	date_i18n(_x('H:i', 'publish box time format'), strtotime($post->post_date))
);

$messages['post']       = array(
	0  => '', // Unused. Messages start at index 1.
	1  => __('Post updated.') . $view_post_link_html,
	2  => __('Custom field updated.'),
	3  => __('Custom field deleted.'),
	4  => __('Post updated.'),
	/* translators: %s: Date and time of the revision. */
	5  => isset($_GET['revision']) ? sprintf(__('Post restored to revision from %s.'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
	6  => __('Post published.') . $view_post_link_html,
	7  => __('Post saved.'),
	8  => __('Post submitted.') . $preview_post_link_html,
	/* translators: %s: Scheduled date for the post. */
	9  => sprintf(__('Post scheduled for: %s.'), '<strong>' . $scheduled_date . '</strong>') . $scheduled_post_link_html,
	10 => __('Post draft updated.') . $preview_post_link_html,
);
$messages['page']       = array(
	0  => '', // Unused. Messages start at index 1.
	1  => __('Page updated.') . $view_page_link_html,
	2  => __('Custom field updated.'),
	3  => __('Custom field deleted.'),
	4  => __('Page updated.'),
	/* translators: %s: Date and time of the revision. */
	5  => isset($_GET['revision']) ? sprintf(__('Page restored to revision from %s.'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
	6  => __('Page published.') . $view_page_link_html,
	7  => __('Page saved.'),
	8  => __('Page submitted.') . $preview_page_link_html,
	/* translators: %s: Scheduled date for the page. */
	9  => sprintf(__('Page scheduled for: %s.'), '<strong>' . $scheduled_date . '</strong>') . $scheduled_page_link_html,
	10 => __('Page draft updated.') . $preview_page_link_html,
);
$messages['attachment'] = array_fill(1, 10, __('Media file updated.')); // Hack, for now.

/**
 * Filters the post updated messages.
 *
 * @since 3.0.0
 *
 * @param array[] $messages Post updated messages. For defaults see `$messages` declarations above.
 */
$messages = apply_filters('post_updated_messages', $messages);

$message = false;
if (isset($_GET['message'])) {
	$_GET['message'] = absint($_GET['message']);
	if (isset($messages[$post_type][$_GET['message']])) {
		$message = $messages[$post_type][$_GET['message']];
	} elseif (!isset($messages[$post_type]) && isset($messages['post'][$_GET['message']])) {
		$message = $messages['post'][$_GET['message']];
	}
}

$notice     = false;
$form_extra = '';
if ('auto-draft' === $post->post_status) {
	if ('edit' === $action) {
		$post->post_title = '';
	}
	$autosave    = false;
	$form_extra .= "<input type='hidden' id='auto_draft' name='auto_draft' value='1' />";
} else {
	$autosave = wp_get_post_autosave($post_ID);
}

$form_action  = 'editpost';
$nonce_action = 'update-post_' . $post_ID;
$form_extra  .= "<input type='hidden' id='post_ID' name='post_ID' value='" . esc_attr($post_ID) . "' />";

// Detect if there exists an autosave newer than the post and if that autosave is different than the post.
if ($autosave && mysql2date('U', $autosave->post_modified_gmt, false) > mysql2date('U', $post->post_modified_gmt, false)) {
	foreach (_wp_post_revision_fields($post) as $autosave_field => $_autosave_field) {
		if (normalize_whitespace($autosave->$autosave_field) !== normalize_whitespace($post->$autosave_field)) {
			$notice = sprintf(
				/* translators: %s: URL to view the autosave. */
				__('There is an autosave of this post that is more recent than the version below. <a href="%s">View the autosave</a>'),
				get_edit_post_link($autosave->ID)
			);
			break;
		}
	}
	// If this autosave isn't different from the current post, begone.
	if (!$notice) {
		wp_delete_post_revision($autosave->ID);
	}
	unset($autosave_field, $_autosave_field);
}

$post_type_object = get_post_type_object($post_type);

// All meta boxes should be defined and added before the first do_meta_boxes() call (or potentially during the do_meta_boxes action).
require_once ABSPATH . 'wp-admin/includes/meta-boxes.php';

register_and_do_post_meta_boxes($post);

add_screen_option(
	'layout_columns',
	array(
		'max'     => 2,
		'default' => 2,
	)
);

if ('post' === $post_type) {
	$customize_display = '<p>' . __('The title field and the big Post Editing Area are fixed in place, but you can reposition all the other boxes using drag and drop. You can also minimize or expand them by clicking the title bar of each box. Use the Screen Options tab to unhide more boxes (Excerpt, Send Trackbacks, Custom Fields, Discussion, Slug, Author) or to choose a 1- or 2-column layout for this screen.') . '</p>';

	get_current_screen()->add_help_tab(
		array(
			'id'      => 'customize-display',
			'title'   => __('Customizing This Display'),
			'content' => $customize_display,
		)
	);

	$title_and_editor  = '<p>' . __('<strong>Title</strong> &mdash; Enter a title for your post. After you enter a title, you&#8217;ll see the permalink below, which you can edit.') . '</p>';
	$title_and_editor .= '<p>' . __('<strong>Post editor</strong> &mdash; Enter the text for your post. There are two modes of editing: Visual and Text. Choose the mode by clicking on the appropriate tab.') . '</p>';
	$title_and_editor .= '<p>' . __('Visual mode gives you an editor that is similar to a word processor. Click the Toolbar Toggle button to get a second row of controls.') . '</p>';
	$title_and_editor .= '<p>' . __('The Text mode allows you to enter HTML along with your post text. Note that &lt;p&gt; and &lt;br&gt; tags are converted to line breaks when switching to the Text editor to make it less cluttered. When you type, a single line break can be used instead of typing &lt;br&gt;, and two line breaks instead of paragraph tags. The line breaks are converted back to tags automatically.') . '</p>';
	$title_and_editor .= '<p>' . __('You can insert media files by clicking the button above the post editor and following the directions. You can align or edit images using the inline formatting toolbar available in Visual mode.') . '</p>';
	$title_and_editor .= '<p>' . __('You can enable distraction-free writing mode using the icon to the right. This feature is not available for old browsers or devices with small screens, and requires that the full-height editor be enabled in Screen Options.') . '</p>';
	$title_and_editor .= '<p>' . sprintf(
		/* translators: %s: Alt + F10 */
		__('Keyboard users: When you&#8217;re working in the visual editor, you can use %s to access the toolbar.'),
		'<kbd>Alt + F10</kbd>'
	) . '</p>';

	get_current_screen()->add_help_tab(
		array(
			'id'      => 'title-post-editor',
			'title'   => __('Title and Post Editor'),
			'content' => $title_and_editor,
		)
	);

	get_current_screen()->set_help_sidebar(
		'<p>' . sprintf(
			/* translators: %s: URL to Press This bookmarklet. */
			__('You can also create posts with the <a href="%s">Press This bookmarklet</a>.'),
			'tools.php'
		) . '</p>' .
			'<p><strong>' . __('For more information:') . '</strong></p>' .
			'<p>' . __('<a href="https://wordpress.org/support/article/wordpress-editor/">Documentation on Writing and Editing Posts</a>') . '</p>' .
			'<p>' . __('<a href="https://wordpress.org/support/">Support</a>') . '</p>'
	);
} elseif ('page' === $post_type) {
	$about_pages = '<p>' . __('Pages are similar to posts in that they have a title, body text, and associated metadata, but they are different in that they are not part of the chronological blog stream, kind of like permanent posts. Pages are not categorized or tagged, but can have a hierarchy. You can nest pages under other pages by making one the &#8220;Parent&#8221; of the other, creating a group of pages.') . '</p>' .
		'<p>' . __('Creating a Page is very similar to creating a Post, and the screens can be customized in the same way using drag and drop, the Screen Options tab, and expanding/collapsing boxes as you choose. This screen also has the distraction-free writing space, available in both the Visual and Text modes via the Fullscreen buttons. The Page editor mostly works the same as the Post editor, but there are some Page-specific features in the Page Attributes box.') . '</p>';

	get_current_screen()->add_help_tab(
		array(
			'id'      => 'about-pages',
			'title'   => __('About Pages'),
			'content' => $about_pages,
		)
	);

	get_current_screen()->set_help_sidebar(
		'<p><strong>' . __('For more information:') . '</strong></p>' .
			'<p>' . __('<a href="https://wordpress.org/support/article/pages-add-new-screen/">Documentation on Adding New Pages</a>') . '</p>' .
			'<p>' . __('<a href="https://wordpress.org/support/article/pages-screen/">Documentation on Editing Pages</a>') . '</p>' .
			'<p>' . __('<a href="https://wordpress.org/support/">Support</a>') . '</p>'
	);
} elseif ('attachment' === $post_type) {
	get_current_screen()->add_help_tab(
		array(
			'id'      => 'overview',
			'title'   => __('Overview'),
			'content' =>
			'<p>' . __('This screen allows you to edit fields for metadata in a file within the media library.') . '</p>' .
				'<p>' . __('For images only, you can click on Edit Image under the thumbnail to expand out an inline image editor with icons for cropping, rotating, or flipping the image as well as for undoing and redoing. The boxes on the right give you more options for scaling the image, for cropping it, and for cropping the thumbnail in a different way than you crop the original image. You can click on Help in those boxes to get more information.') . '</p>' .
				'<p>' . __('Note that you crop the image by clicking on it (the Crop icon is already selected) and dragging the cropping frame to select the desired part. Then click Save to retain the cropping.') . '</p>' .
				'<p>' . __('Remember to click Update Media to save metadata entered or changed.') . '</p>',
		)
	);

	get_current_screen()->set_help_sidebar(
		'<p><strong>' . __('For more information:') . '</strong></p>' .
			'<p>' . __('<a href="https://wordpress.org/support/article/edit-media/">Documentation on Edit Media</a>') . '</p>' .
			'<p>' . __('<a href="https://wordpress.org/support/">Support</a>') . '</p>'
	);
}

if ('post' === $post_type || 'page' === $post_type) {
	$inserting_media  = '<p>' . __('You can upload and insert media (images, audio, documents, etc.) by clicking the Add Media button. You can select from the images and files already uploaded to the Media Library, or upload new media to add to your page or post. To create an image gallery, select the images to add and click the &#8220;Create a new gallery&#8221; button.') . '</p>';
	$inserting_media .= '<p>' . __('You can also embed media from many popular websites including Twitter, YouTube, Flickr and others by pasting the media URL on its own line into the content of your post/page. <a href="https://wordpress.org/support/article/embeds/">Learn more about embeds</a>.') . '</p>';

	get_current_screen()->add_help_tab(
		array(
			'id'      => 'inserting-media',
			'title'   => __('Inserting Media'),
			'content' => $inserting_media,
		)
	);
}

if ('post' === $post_type) {
	$publish_box  = '<p>' . __('Several boxes on this screen contain settings for how your content will be published, including:') . '</p>';
	$publish_box .= '<ul><li>' .
		__('<strong>Publish</strong> &mdash; You can set the terms of publishing your post in the Publish box. For Status, Visibility, and Publish (immediately), click on the Edit link to reveal more options. Visibility includes options for password-protecting a post or making it stay at the top of your blog indefinitely (sticky). The Password protected option allows you to set an arbitrary password for each post. The Private option hides the post from everyone except editors and administrators. Publish (immediately) allows you to set a future or past date and time, so you can schedule a post to be published in the future or backdate a post.') .
		'</li>';

	if (current_theme_supports('post-formats') && post_type_supports('post', 'post-formats')) {
		$publish_box .= '<li>' . __('<strong>Format</strong> &mdash; Post Formats designate how your theme will display a specific post. For example, you could have a <em>standard</em> blog post with a title and paragraphs, or a short <em>aside</em> that omits the title and contains a short text blurb. Your theme could enable all or some of 10 possible formats. <a href="https://wordpress.org/support/article/post-formats/#supported-formats">Learn more about each post format</a>.') . '</li>';
	}

	if (current_theme_supports('post-thumbnails') && post_type_supports('post', 'thumbnail')) {
		$publish_box .= '<li>' . sprintf(
			/* translators: %s: Featured image. */
			__('<strong>%s</strong> &mdash; This allows you to associate an image with your post without inserting it. This is usually useful only if your theme makes use of the image as a post thumbnail on the home page, a custom header, etc.'),
			esc_html($post_type_object->labels->featured_image)
		) . '</li>';
	}

	$publish_box .= '</ul>';

	get_current_screen()->add_help_tab(
		array(
			'id'      => 'publish-box',
			'title'   => __('Publish Settings'),
			'content' => $publish_box,
		)
	);

	$discussion_settings  = '<p>' . __('<strong>Send Trackbacks</strong> &mdash; Trackbacks are a way to notify legacy blog systems that you&#8217;ve linked to them. Enter the URL(s) you want to send trackbacks. If you link to other WordPress sites they&#8217;ll be notified automatically using pingbacks, and this field is unnecessary.') . '</p>';
	$discussion_settings .= '<p>' . __('<strong>Discussion</strong> &mdash; You can turn comments and pings on or off, and if there are comments on the post, you can see them here and moderate them.') . '</p>';

	get_current_screen()->add_help_tab(
		array(
			'id'      => 'discussion-settings',
			'title'   => __('Discussion Settings'),
			'content' => $discussion_settings,
		)
	);
} elseif ('page' === $post_type) {
	$page_attributes = '<p>' . __('<strong>Parent</strong> &mdash; You can arrange your pages in hierarchies. For example, you could have an &#8220;About&#8221; page that has &#8220;Life Story&#8221; and &#8220;My Dog&#8221; pages under it. There are no limits to how many levels you can nest pages.') . '</p>' .
		'<p>' . __('<strong>Template</strong> &mdash; Some themes have custom templates you can use for certain pages that might have additional features or custom layouts. If so, you&#8217;ll see them in this dropdown menu.') . '</p>' .
		'<p>' . __('<strong>Order</strong> &mdash; Pages are usually ordered alphabetically, but you can choose your own order by entering a number (1 for first, etc.) in this field.') . '</p>';

	get_current_screen()->add_help_tab(
		array(
			'id'      => 'page-attributes',
			'title'   => __('Page Attributes'),
			'content' => $page_attributes,
		)
	);
}

require_once ABSPATH . 'wp-admin/admin-header.php';
?>

<div class="wrap">	

	<?php
	if (isset($post_new_file) && current_user_can($post_type_object->cap->create_posts)) {
		echo ' <a href="' . esc_url(admin_url($post_new_file)) . '" class="page-title-action">' . esc_html($post_type_object->labels->add_new) . '</a>';
	}
	?>

	<hr class="wp-header-end">

	<?php if ($notice) : ?>
		<div id="notice" class="notice notice-warning">
			<p id="has-newer-autosave"><?php echo $notice; ?></p>
		</div>
	<?php endif; ?>
	<?php if ($message) : ?>
		<div id="message" class="updated notice notice-success is-dismissible">
			<p><?php echo $message; ?></p>
		</div>
	<?php endif; ?>
	<div id="lost-connection-notice" class="error hidden">
		<p><span class="spinner"></span> <?php _e('<strong>Connection lost.</strong> Saving has been disabled until you&#8217;re reconnected.'); ?>
			<span class="hide-if-no-sessionstorage"><?php _e('We&#8217;re backing up this post in your browser, just in case.'); ?></span>
		</p>
	</div>
	<form name="post" action="post.php" method="post" id="post" <?php
																/**
																 * Fires inside the post editor form tag.
																 *
																 * @since 3.0.0
																 *
																 * @param WP_Post $post Post object.
																 */
																do_action('post_edit_form_tag', $post);

																$referer = wp_get_referer();
																?>>
		<?php wp_nonce_field($nonce_action); ?>
		<input type="hidden" id="user-id" name="user_ID" value="<?php echo (int) $user_ID; ?>" />
		<input type="hidden" id="hiddenaction" name="action" value="<?php echo esc_attr($form_action); ?>" />
		<input type="hidden" id="originalaction" name="originalaction" value="<?php echo esc_attr($form_action); ?>" />
		<input type="hidden" id="post_author" name="post_author" value="<?php echo esc_attr($post->post_author); ?>" />
		<input type="hidden" id="post_type" name="post_type" value="<?php echo esc_attr($post_type); ?>" />
		<input type="hidden" id="original_post_status" name="original_post_status" value="<?php echo esc_attr($post->post_status); ?>" />
		<input type="hidden" id="referredby" name="referredby" value="<?php echo $referer ? esc_url($referer) : ''; ?>" />
		<?php if (!empty($active_post_lock)) { ?>
			<input type="hidden" id="active_post_lock" value="<?php echo esc_attr(implode(':', $active_post_lock)); ?>" />
		<?php
		}
		if ('draft' !== get_post_status($post)) {
			wp_original_referer_field(true, 'previous');
		}

		echo $form_extra;

		wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false);
		wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false);
		?>

		<?php
		/**
		 * Fires at the beginning of the edit form.
		 *
		 * At this point, the required hidden fields and nonces have already been output.
		 *
		 * @since 3.7.0
		 *
		 * @param WP_Post $post Post object.
		 */
		do_action('edit_form_top', $post);
		?>

		<div id="poststuff">
			<div id="emailsproposta"></div>
			<div id="post-body" class="metabox-holder columns-<?php echo (1 === get_current_screen()->get_columns()) ? '1' : '2'; ?>">
				<div id="post-body-content">
					<?php if (post_type_supports($post_type, 'title')) { ?>
						<div id="titlediv">
							<div id="titlewrap">
								<?php
								/**
								 * Filters the title field placeholder text.
								 *
								 * @since 3.1.0
								 *
								 * @param string  $text Placeholder text. Default 'Add title'.
								 * @param WP_Post $post Post object.
								 */
								$title_placeholder = apply_filters('enter_title_here', __('Add title'), $post);
								?>
								<label class="screen-reader-text" id="title-prompt-text" for="title">1. TÍTULO DA CAPACITAÇÃO<?php //echo $title_placeholder; 
																																?></label>
								<input type="text" name="post_title" size="30" value="<?php echo esc_attr($post->post_title); ?>" id="title" spellcheck="true" autocomplete="off" />
							</div>
							<?php
							/**
							 * Fires before the permalink field in the edit form.
							 *
							 * @since 4.1.0
							 *
							 * @param WP_Post $post Post object.
							 */
							do_action('edit_form_before_permalink', $post);
							?>
							<div class="inside">
								<?php
								if ($viewable) :
									$sample_permalink_html = $post_type_object->public ? get_sample_permalink_html($post->ID) : '';

									// As of 4.4, the Get Shortlink button is hidden by default.
									if (has_filter('pre_get_shortlink') || has_filter('get_shortlink')) {
										$shortlink = wp_get_shortlink($post->ID, 'post');

										if (!empty($shortlink) && $shortlink !== $permalink && home_url('?page_id=' . $post->ID) !== $permalink) {
											$sample_permalink_html .= '<input id="shortlink" type="hidden" value="' . esc_attr($shortlink) . '" />' .
												'<button type="button" class="button button-small" onclick="prompt(&#39;URL:&#39;, jQuery(\'#shortlink\').val());">' .
												__('Get Shortlink') .
												'</button>';
										}
									}

									if (
										$post_type_object->public
										&& !('pending' === get_post_status($post) && !current_user_can($post_type_object->cap->publish_posts))
									) {
										$has_sample_permalink = $sample_permalink_html && 'auto-draft' !== $post->post_status;
								?>
										<div id="edit-slug-box" class="hide-if-no-js">
											<?php
											if ($has_sample_permalink) {
												echo $sample_permalink_html;
											}
											?>
										</div>
								<?php
									}
								endif;
								?>
							</div>
							<?php
							wp_nonce_field('samplepermalink', 'samplepermalinknonce', false);
							?>
						</div><!-- /titlediv -->
					<?php
					}
					/**
					 * Fires after the title field.
					 *
					 * @since 3.5.0
					 *
					 * @param WP_Post $post Post object.
					 */
					do_action('edit_form_after_title', $post);

					if (post_type_supports($post_type, 'editor')) {
						$_wp_editor_expand_class = '';
						if ($_wp_editor_expand) {
							$_wp_editor_expand_class = ' wp-editor-expand';
						}
					?>
						<div id="postdivrich" class="postarea<?php echo $_wp_editor_expand_class; ?>">

							<?php
							wp_editor(
								$post->post_content,
								'content',
								array(
									'_content_editor_dfw' => $_content_editor_dfw,
									'drag_drop_upload'    => true,
									'tabfocus_elements'   => 'content-html,save-post',
									'editor_height'       => 300,
									'tinymce'             => array(
										'resize'                  => false,
										'wp_autoresize_on'        => $_wp_editor_expand,
										'add_unload_trigger'      => false,
										'wp_keep_scroll_position' => !$is_IE,
									),
								)
							);
							?>
							<table id="post-status-info">
								<tbody>
									<tr>
										<td id="wp-word-count" class="hide-if-no-js">
											<?php
											printf(
												/* translators: %s: Number of words. */
												__('Word count: %s'),
												'<span class="word-count">0</span>'
											);
											?>
										</td>
										<td class="autosave-info">
											<span class="autosave-message">&nbsp;</span>
											<?php
											if ('auto-draft' !== $post->post_status) {
												echo '<span id="last-edit">';
												$last_user = get_userdata(get_post_meta($post_ID, '_edit_last', true));
												if ($last_user) {
													/* translators: 1: Name of most recent post author, 2: Post edited date, 3: Post edited time. */
													printf(__('Last edited by %1$s on %2$s at %3$s'), esc_html($last_user->display_name), mysql2date(__('F j, Y'), $post->post_modified), mysql2date(__('g:i a'), $post->post_modified));
												} else {
													/* translators: 1: Post edited date, 2: Post edited time. */
													printf(__('Last edited on %1$s at %2$s'), mysql2date(__('F j, Y'), $post->post_modified), mysql2date(__('g:i a'), $post->post_modified));
												}
												echo '</span>';
											}
											?>
										</td>
										<td id="content-resize-handle" class="hide-if-no-js"><br /></td>
									</tr>
								</tbody>
							</table>

						</div>
					<?php
					}
					/**
					 * Fires after the content editor.
					 *
					 * @since 3.5.0
					 *
					 * @param WP_Post $post Post object.
					 */
					do_action('edit_form_after_editor', $post);
					?>
				</div><!-- /post-body-content -->
			</div><!-- /post-body -->

			<div id="postbox-container-2" class="postbox-container">
				<?php

				do_meta_boxes(null, 'normal', $post);

				if ('page' === $post_type) {
					/**
					 * Fires after 'normal' context meta boxes have been output for the 'page' post type.
					 *
					 * @since 1.5.0
					 *
					 * @param WP_Post $post Post object.
					 */
					do_action('edit_page_form', $post);
				} else {
					/**
					 * Fires after 'normal' context meta boxes have been output for all post types other than 'page'.
					 *
					 * @since 1.5.0
					 *
					 * @param WP_Post $post Post object.
					 */
					do_action('edit_form_advanced', $post);
				}


				do_meta_boxes(null, 'advanced', $post);

				?>
			</div>


			<div id="postbox-container-1" class="postbox-container">
				<?php

				if ('page' === $post_type) {
					/**
					 * Fires before meta boxes with 'side' context are output for the 'page' post type.
					 *
					 * The submitpage box is a meta box with 'side' context, so this hook fires just before it is output.
					 *
					 * @since 2.5.0
					 *
					 * @param WP_Post $post Post object.
					 */
					do_action('submitpage_box', $post);
				} else {
					/**
					 * Fires before meta boxes with 'side' context are output for all post types other than 'page'.
					 *
					 * The submitpost box is a meta box with 'side' context, so this hook fires just before it is output.
					 *
					 * @since 2.5.0
					 *
					 * @param WP_Post $post Post object.
					 */
					do_action('submitpost_box', $post);
				}


				do_meta_boxes($post_type, 'side', $post);

				?>
			</div>			
			<?php
			/**
			 * Fires after all meta box sections have been output, before the closing #post-body div.
			 *
			 * @since 2.1.0
			 *
			 * @param WP_Post $post Post object.
			 */
			do_action('dbx_post_sidebar', $post);

			?>

			<br class="clear" />
		</div><!-- /poststuff -->
	</form>
</div>

<?php
if (post_type_supports($post_type, 'comments')) {
	wp_comment_reply();
}
?>

<?php if (!wp_is_mobile() && post_type_supports($post_type, 'title') && '' === $post->post_title) : ?>
	<script type="text/javascript">
		try {
			document.post.title.focus();
		} catch (e) {}
	</script>
<?php endif; ?>

<?php
/* conteudista, captura dos valores */	
$id_conteud = "";
$atual_conteud = "";
$email_conteud = "";
if (get_field('conteudista')[0] == "") {
	$atual_conteud = "Ninguém";
} else {
	foreach (get_field('conteudista') as $cont) {
		$id_conteud = $id_conteud . $cont . ",";
		$atual_conteud = $atual_conteud . get_userdata($cont)->display_name . ", ";
		$email_conteud = $email_conteud . get_userdata($cont)->user_email . ", ";
	 }
	 $id_conteud = substr($id_conteud,0,-1);
	 $atual_conteud = substr($atual_conteud,0,-2);
	 $email_conteud = substr($email_conteud,0,-2);
}
?>

<script>
	/* Funções extras do formulário */
	/*Cabeçalho*/
	
	var cabh1 = document.createElement("h1");
	cabh1.setAttribute("class","titulo-principal");
	cabh1.innerHTML = "DESENVOLVIMENTO DE SOLUÇÃO DE APRENDIZAGEM";

	var cabp1 = document.createElement("p");
	cabp1.setAttribute("class","post-sub-title");
	cabp1.innerHTML = "Roteiro para elaboração de solução de capacitação preenchido conjuntamente entre CONTEUDISTA E EQUIPE, até a validação da versão final.";

	var cabh2 = document.createElement("h2");
	cabh2.setAttribute("class","wp-heading-inline");
	cabh2.innerHTML = "I. CARACTERIZAÇÃO DA DEMANDA<br><br>1. TÍTULO DA CAPACITAÇÃO";

	var cabp2 = document.createElement("p");
	cabp2.setAttribute("class","post-sub-title");
	cabp2.innerHTML = "Escreva o nome final exato do curso";

	var cabecalho = document.querySelector("#titlediv");
	cabecalho.before(cabh1);
	cabecalho.before(cabp1);
	cabecalho.before(cabh2);
	cabecalho.before(cabp2);	

	/* objetivo */

	var objetivo = document.querySelector("#objetivo .acf-label");
	var strong = document.createElement("strong");
	strong.innerHTML = "1. Resultados para a SOCIEDADE:";	
	objetivo.append(strong);	

	var objetivo = document.querySelector("#objetivo .acf-input ul li:nth-child(4)");
	var hr = document.createElement("hr");
	objetivo.append(hr);
	var strong = document.createElement("strong");
	strong.innerHTML = "2. Para excelência no ENSINO, PESQUISA E EXTENSÃO:";
	objetivo.append(strong);

	var objetivo = document.querySelector("#objetivo .acf-input ul li:nth-child(9)");
	var hr = document.createElement("hr");
	objetivo.append(hr);
	var strong = document.createElement("strong");
	strong.innerHTML = "3. Para excelência na GESTÃO:";
	objetivo.append(strong);


	/* conteudista, criação do select */	
	var conteudista = document.querySelector("#conteudista select");			

	<?php
	$conteudistas = get_users(array('role__in' => array('contributor')));	
	foreach ($conteudistas as $conteudista) { ?>
		var option = document.createElement("option");
		option.innerHTML = '<?php echo $conteudista->display_name; ?>';	
		option.setAttribute("value", '<?php echo $conteudista->id; ?>');			
		conteudista.append(option);
	<?php } ?>

	/* valor atual do conteudista*/
	
	valcont = document.createElement("span");
	valcont.setAttribute("id","valcont");
	valcont.setAttribute("style","opacity:0;");
	valcont.innerHTML = "<?php echo $atual_conteud; ?>";
	conteudista.after(valcont);

	valcontid = document.createElement("span");
	valcontid.setAttribute("id","valcontid");
	valcontid.setAttribute("style","opacity:0;");
	valcontid.innerHTML = "<?php echo $id_conteud; ?>";
	conteudista.after(valcontid);

	/* emailadmin & emailconteudista Selected */
	var emailproposta = document.querySelector("#emailsproposta");
	emailadmin = document.createElement("span");
	emailadmin.setAttribute("id","emailadmin");
	emailadmin.setAttribute("style","opacity:0;");
	emailadmin.innerHTML = "<?php echo get_option('admin_email'); ?>";
	emailproposta.after(emailadmin);

	emailconteudista = document.createElement("span");
	emailconteudista.setAttribute("id","emailconteudista");
	emailconteudista.setAttribute("style","opacity:0;");
	<?php
	$user = wp_get_current_user();
    if (in_array('administrator', (array) $user->roles) || in_array('author', (array) $user->roles)) 
	{ ?>	
	emailconteudista.innerHTML = "<?php echo $email_conteud; ?>";	
	<?php }else{ ?>
		emailconteudista.innerHTML = "";	
	<?php } ?>
	emailproposta.after(emailconteudista);

	/*II caracterização */

	var caracterizacao = document.querySelector("#ementa");	
	var h2 = document.createElement("h2");
	h2.setAttribute("style","font-weight:600;font-size:17px;margin-left:-10px");
	h2.innerHTML = "<hr><br>II. CARACTERIZAÇÃO DO CURSO";
	caracterizacao.before(h2);

	/* carga */

	var cargatotal = document.querySelector("#cargatotal input");	
	cargatotal.readOnly = true;

	var carga1 = document.querySelector("#carga1 input");
	var carga2 = document.querySelector("#carga2 input");
	var carga3 = document.querySelector("#carga3 input");
	var carga4 = document.querySelector("#carga4 input");
	var carga5 = document.querySelector("#carga5 input");

	if(carga1.value == "")carga1.value = 0;
	if(carga2.value == "")carga2.value = 0;
	if(carga3.value == "")carga3.value = 0;
	if(carga4.value == "")carga4.value = 0;
	if(carga5.value == "")carga5.value = 0;
	if(cargatotal.value == "")cargatotal.value = 0;
	
	function calcularcarga(){
		if(carga1.value != "" && carga2.value != "" && carga3.value != "" && carga4.value != "" && carga5.value != ""){
			cargatotal.value = parseFloat(carga1.value) + parseFloat(carga2.value) + parseFloat(carga3.value) + parseFloat(carga4.value) + parseFloat(carga5.value);
		}else{
			cargatotal.value = 0;
		}
	}

	carga1.setAttribute("min","0");
	carga2.setAttribute("min","0");
	carga3.setAttribute("min","0");
	carga4.setAttribute("min","0");
	carga5.setAttribute("min","0");

	carga1.setAttribute("oninput","calcularcarga()");
	carga2.setAttribute("oninput","calcularcarga()");
	carga3.setAttribute("oninput","calcularcarga()");
	carga4.setAttribute("oninput","calcularcarga()");
	carga5.setAttribute("oninput","calcularcarga()");

	/*III caracterização*/
	var caractcurso = document.querySelector("#bibliografia");	
	var h2 = document.createElement("h2");
	h2.setAttribute("style","font-weight:600;font-size:17px;margin-left:-10px;margin-top:30px;");
	h2.innerHTML = "III. CARACTERIZAÇÃO DO OFERECIMENTO";
	caractcurso.after(h2);

	/* calendario */	
	$pretabela = "<table style='border-spacing: 0px;width: 100%;'><tbody><tr><td style='width=100px;padding:10px;border: 1px solid #000;'>Turma</td><td style='width=100px;padding:10px;border: 1px solid#000;'>Data</td><td style='width=100px;padding:10px;border: 1px solid #000;'>Dia da semana</td><td style='width=100px;padding:10px;border: 1px solid #000;'>Horário</td><td style='width=100px;padding:10px;border: 1px solid #000;'>Instrutor</td><td style='width=100px;padding:10px;border: 1px solid #000;'>Carga Horária</td></tr><tr><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td><td style='width=100px;padding:10px;border: 1px solid #000;'></td></tr></tbody></table>";

	var calendario = document.querySelector("#calendario textarea");
	if(calendario.value == ""){
		calendario.value = $pretabela;
	}

	/*IV gerencial*/
	var gerencial = document.querySelector("#local");	
	var h2 = document.createElement("h2");
	h2.setAttribute("style","font-weight:600;font-size:17px;margin-left:-10px;margin-top:20px;");
	h2.innerHTML = "IV. INFORMAÇÕES GERENCIAIS";
	gerencial.after(h2);

	/*pagamento*/
	$prepagamento = "<table style='border-spacing: 0px;width: 100%;'><tbody><tr><td style='width=120px;padding:10px;border: 1px solid #000;'>Nome</td><td style='width=120px;padding:10px;border: 1px solid #000;'>Dias</td><td style='width=120px;padding:10px;border: 1px solid #000;'>Atuação</td><td style='width=120px;padding:10px;border: 1px solid #000;'>Carga Horária</td><td style='width=120px;padding:10px;border: 1px solid #000;'>Valor</td></tr><tr><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td></tr><tr><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td><td style='width=120px;padding:10px;border: 1px solid #000;'></td></tr></tbody></table>";
	var pagamento = document.querySelector("#pagamento textarea");
	if(pagamento.value == ""){
		pagamento.value = $prepagamento;
	}
	
</script>

<?php } else { ?>
   <script>
      window.location.href = "/naopermitido"
   </script>
<?php }