<?php

function msl_metatags_create_menu() {
	add_menu_page('MetaTagsFromContent', 'MetaTags', 'administrator', __FILE__, 'msl_metatags_settings_page', plugins_url('/images/msl_metatags_icon.png', __FILE__));
}

function msl_metatags_settings_page() {
?>
<div class="wrap">
<h1>Metatags from content</h1>
<h2>How to use</h2>
<p>Find the post. Click "Edit post". Activate the "Text" tab of your post.</p>
<p>
To modify the &lt;title&gt; tag of your post, add a simple string into your post content:
</p>
<p><pre>&lt;!--title="your title"--&gt;</pre></p>
<p>
To modify the &lt;description&gt; tag of your post, add:
</p>
<p><pre>&lt;!--description="your description"--&gt;</pre></p>
<h2>Multilingual support</h2>
<p>If some kind of multilingual plugins are active (for example Multilanguage by BestWebSoft) - you can define titles and descriptions in other way:</p>
<p>
    <strong>English locale (United States)</strong>
    <br>&lt;!--title<strong>_en_US</strong>="your title"--&gt;
    <br>&lt;!--description<strong>_en_US</strong>="your description"--&gt;
</p>
<p>
    <strong>Українська локаль</strong>
    <br>&lt;!--title<strong>_uk</strong>="Ваш заголовок"--&gt;
    <br>&lt;!--description<strong>_uk</strong>="Ваш опис"--&gt;
</p>
<p>
    <strong>Русская локаль</strong>
    <br>&lt;!--title<strong>_ru_RU</strong>="Ваш заголовок"--&gt;
    <br>&lt;!--description<strong>_ru_RU</strong>="Ваше описание"--&gt;
</p>
</div>
<?php
}

function msl_metatags_is_yoast_active() {
	return is_plugin_active( 'wordpress-seo/wp-seo.php' );
}

function msl_metatags_description($description) {
	global $post;
	$MSL_DESCRIPTION_PATTERN = '/<\!--description(_'.get_locale().')?="(.*?)"-->/i';
	$post_content = $post->post_content;
	preg_match($MSL_DESCRIPTION_PATTERN,$post_content,$matches);
	if (isset($matches[2])) {
		$description = $matches[2];
	}
	if (msl_metatags_is_yoast_active())
		return $description;
	else {
		$description = "<meta name=\"description\" content=\"$description\"/>\n";
		echo $description;
		return $description;
	}
}

function msl_metatags_title($title) {
	global $post;
	$MSL_TITLE_PATTERN = '/<\!--title(_'.get_locale().')?="(.*?)"-->/i';
	$post_content = $post->post_content;
	preg_match($MSL_TITLE_PATTERN,$post_content,$matches);
	if (isset($matches[2])) {
		$title = $matches[2];
	}
	return $title;
}

