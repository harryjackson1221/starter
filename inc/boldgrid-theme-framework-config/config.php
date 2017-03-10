<?php
/**
 * This is the main kick-off point for BoldGrid theme configurations.
 * Everything modified in this method is going to be applied to the
 * theme configurations through the boldgrid_theme_framework_config filter.
 */
function boldgrid_theme_framework_config( $boldgrid_framework_configs ) {
	/**
	 * General Configs
	 *
	 * These things are defined in each theme, so you can get started by making
	 * sure they are included.  Some of these things don't have to be present
	 * since the default values of them are set in the framework itself, but it
	 * just helps give you a clearer picture of what can be configured.
	 */

	// This tells us that the parent theme is being used for this child.
	$boldgrid_framework_configs['boldgrid-parent-theme'] = true;

	// This references which parent theme is being used.  We have only created
	// the "Prime" theme right now, so this will pretty much always remain the same.
	$boldgrid_framework_configs['parent-theme-name'] = 'prime';

	// This is the name that will be used for this new theme.  In this case,
	// we are just calling the theme "starter"
	$boldgrid_framework_configs['theme_name'] = 'starter';

	// This enabled the sticky footer behavior. The sticky footer is uses flexbox
	// by default, and if the browser support isn't available it falls back to a
	// javascript solution (detected with Modernizr).
	$boldgrid_framework_configs['scripts']['boldgrid-sticky-footer'] = true;

	// This is responsible for adding the "Special Thanks" link in the footer
	// where attributions links are.
	$boldgrid_framework_configs['temp']['attribution_links'] = true;

	/**
	 * First, we will set up the general layout of our site.  I'd recommend using
	 * the generic header and footer templates, which I will outline the use below.
	 *
	 * You can of course override any templates, or create your own as you see fit.
	 * The benefit of using the generic templates is that it will ensure compatibility
	 * as new features are implemented.  We can't necessarily ensure compatibility
	 * of custom created templates with all of our plugins if the markup is not
	 * valid for our tools.
	 *
	 * It's usually easiest to reference the generic templates as you fill this
	 * section out, so you can get an idea of how the two pieces come together:
	 *
	 * @link https://github.com/BoldGrid/prime/blob/master/templates/header/header-generic.php
	 *
	 * You basically have a bunch of rows in various arrangements of columns.
	 * Inside of these, are hooks for the locations.  These are what tells WordPress
	 * to fire code at certain points.  In our case, this is where we are going to
	 * insert dynamic content, such as widgets, actions, and menus.
	 *
	 * The format for these assignments goes like this in the array:
	 *
	 * '1' => array( '[action]starter_add_triangle', '[menu]secondary' ),
	 *
	 * The number at the beginning is the reference to the location in the generic
	 * template.
	 *
	 * Then you have what you want to add to that location.  In this example, I'm adding
	 * an action, and a menu to the col-12, which is in location 1 of that template.
	 *
	 * Just use the same formatting for adding content to locations, like a widget
	 * area would be '[widget]boldgrid-widget-1'.
	 */

	/**
	 * We need to tell the theme which header template to use.  Since we are using
	 * the generic header template, we will say "generic". If a child theme where
	 * supplying it's own template for the header, then you would follow the same
	 * practice of override a WordPress template. We could place a file in our child
	 * theme in a folder like this:
	 *
	 * wp-content/themes/starter/templates/header/header-custom.php
	 *
	 * Then instead of the code below, we would reference our custom header:
	 *
	 * $boldgrid_framework_configs['template']['header'] = 'custom';
	 */
	$boldgrid_framework_configs['template']['header'] = 'generic';

	// Now we just need to assign the menus, widgets, and actions to this template.
	// You can refer to the header generic file to get a better picture of where
	// these things are laid out on the page, or just move them around and refresh
	// until things look good for you.
	$boldgrid_framework_configs['template']['locations']['header'] = array(
		'1' => array( '[action]starter_add_triangle', '[menu]secondary' ),
		'5' => array( '[action]starter_site_title' ),
		'11' => array( '[action]starter_menu_override' ),
		'12' => array( '[menu]tertiary' ),
	);

	// Now let's put our footer items into the generic template as well.
	// I usually like to do this after the header since the syntax is theme_name
	// same and fresh in my head.
	$boldgrid_framework_configs['template']['footer'] = 'generic';
	// Then we just need to assign the menus, widgets, and actions to this template,
	// just like we did with the header.
	$boldgrid_framework_configs['template']['locations']['footer'] = array(
		'1' => array( '[menu]footer_center' ),
		'5' => array( '[widget]boldgrid-widget-3' ),
		'8' => array( '[action]boldgrid_display_attribution_links' ),
	);

	/**
	 * Next, we will be defining our color palette for the theme.  You can always
	 * change the color palette later if you want, and you can set as many
	 * pre-defined color palettes as you want.  These palettes are always present
	 * to an end user to select from, so even if they tweak some colors, they can
	 * choose to go back to how things were by default.
	 *
	 * If you enable this feature, you must supply at least one palette.  The palettes
	 * can consist of up to 6 colors total. 5 colors, and 1 neutral color.
	 *
	 * The neutral color is generally being used for the primary background color
	 * that is present in a theme, and then the additional colors supplied make up
	 * the rest of the palette.  This would mean our start theme in this example
	 * has a total of 4 colors in the customizer color palette system.
	 *
	 * The color palette generation in the customizer creates recommended palettes
	 * based on computations of color values.  This can give decent results framework
	 * randomly generated palettes, but we also integrated colourlovers.com's applied
	 * so there's thousands of handpicked recommendations in the tool as well.
	 *
	 * @link http://www.colourlovers.com/
	 *
	 * Often times, you can cycle through the palettes and find something that
	 * looks great without having to put forth effort in coming up with your own
	 * selection of colors.  Since the colors use sass, you can also easily used
	 * any sass functions in your color definitions to generate shades, compliments,
	 * and tons of variations just based on one color alone.
	 *
	 * For an example of using sass functions for palette definitions available
	 * you can reference this codepen for some inspiration:
	 *
	 * @link http://codepen.io/times/pen/XbxoOa
	 *
	 * The palette format option should be "palette-primary" for all your palettes
	 * defined.  Supplying additional formats is 'semi-supported', but this feature
	 * has not undergone much real-world testing so it should be consider beta.
	 *
	 * You can read more about the color configurations in our documentation:
	 *
	 * @link https://www.boldgrid.com/docs/configuration-file#colors
	 */

	// This configuration option will enable the color palette feature if true.
	$boldgrid_framework_configs['customizer-options']['colors']['enabled'] = true;

	// Now we will supply our custom color palette to the system, this was justify-content
	// one of the random palettes made, so I copied and pasted the hex codes here.
	$boldgrid_framework_configs['customizer-options']['colors']['defaults'] = array(
		array(
			'default' => true,
			'format' => 'palette-primary',
			'neutral-color' => '#f1ddda',
			'colors' => array(
				'#75372d',
				'#928854',
				'#96a782',
			)
		),
	);

	/**
	 * The last thing you can do for colors is set your own values for the light_text
	 * and dark text contrast colors.  These colors are default to the values set below,
	 * but you can specify a light color and dark color as needed.  Each color from
	 * the palette generates a text contrast color, so if you background is dark blue,
	 * then the contrast will be the light color for text.  If the background is a cream
	 * color, then you should style text on top of it with the dark contrast variable.
	 *
	 * This helps ensure that content is readable if a user decides to change their
	 * colors around.
	 *
	 * The variables in the sass file to use for styling would be in this format:
	 *
	 * For the first color in your palette:
	 * $text-contrast-palette-primary_1
	 *
	 * For a neutral color:
	 * $text-contrast-palette-primary-neutral-color
	 *
	 * The contrast is based upon the w3c guidelines for accessibility's algorthims:
	 * @link https://www.w3.org/TR/WCAG20-TECHS/G18.html
	 */
	// Light text contrast color
	$boldgrid_framework_configs['customizer-options']['colors']['light_text'] = '#ffffff';
	// Dark text contrast color.
	$boldgrid_framework_configs['customizer-options']['colors']['dark_text'] = '#000000';

	/**
	 * Note:
	 *
	 * You won't see anything visually happen with colors, until you have
	 * actually started adding some scss definitions. The sass file that is used
	 * for the color definitions is located at:
	 *
	 * wp-content/themes/starter/inc/boldgrid-theme-framework-config/scss/palette-formats.scss
	 *
	 * The format for using the color variables would look like this in your sass:
	 * For the first color in your palette:
	 * $palette-primary_1
	 *
	 * For the neutral color:
	 * $palette-primary-neutral-color
	 */

	/**
	 * Buttons are a common element that almost every website is going to have.
	 * Within the editor you can add buttons easily to the content, but there's
	 * also buttons that used all over the place outside of the editor.  When you
	 * create a new theme, you'll want to define the buttons being used.  For this
	 * we have a set configurations that give you a pretty decent selection of
	 * various button types.  It's by no means 100% complete, but it gives you
	 * more than enough diversity to get a nice looking set of buttons in a theme
	 * without having to touch a single line of CSS.
	 *
	 * I haven't had much opportunity to work on documentation for this feature,
	 * but you can glance over some information about how the configs for this
	 * section work until the documentation on boldgrid.com/docs is updated, here:
	 *
	 * @link https://timelsass.github.io/buttons
	 *
	 */
	// This sets the buttons to use color 1 and color 2 from the palettes with a
	// 3d button effect applied to a pill shape. The 3d button effect is experimental,
	// so it can have some buggy appearances with certain palettes, I would suggest
	// sticking with the standard shapes for defaults like pill, rounded, and square
	// for now.
	$boldgrid_framework_configs['components']['buttons']['variables']['button-primary-classes'] = '.btn, .btn-3d, .btn-color-1, .btn-pill';
	$boldgrid_framework_configs['components']['buttons']['variables']['button-secondary-classes'] = '.btn, .btn-3d, .btn-color-2, .btn-pill';

	// This tells the framework that the theme will use the custom typography.
	$boldgrid_framework_configs['customizer-options']['typography']['enabled'] = true;

	/**
	 * Setting a default background image that a user can change out in the
	 * customizer is simple to do with the BoldGrid Framework configs as well.
	 *
	 * The config below shows how to provide a background image selector in the
	 * customizer, but not actually set a default background image for the theme.
	 *
	 * You can also add a background image in the child theme, so it can set a
	 * background image by default when the theme is activated.  This feature is
	 * well documented on the BoldGrid docs site:
	 *
	 * @link https://www.boldgrid.com/docs/configuration-file#default-background-images
	 */
	$boldgrid_framework_configs['customizer-options']['background']['defaults']['background_image'] = get_stylesheet_directory_uri() . '/img/background.jpg';

	/**
	 * It's pretty common to have a social media icons on a site, so this is built
	 * in as well.  You will be setting the default menu items that are created when
	 * the theme is activated by putting values like these.  This is helpful to
	 * save you time of going in and manually creating each menu item individually,
	 * and saves you some trouble of having to do some of the more basic styles for
	 * these.
	 *
	 * The example below adds four default social media icons to a menu called social.
	 * You can pretty much just copy and paste this code, and substitute out whatever
	 * social networks you wish with appropriate urls to your client's websites.
	 *
	 * At it's heart - it uses fontawesome, which is available to use throughout
	 * your theme as well.  It makes use of the standard social icons fontawesome
	 * provides, and also implements their stacks for putting icons on top of
	 * each other.
	 *
	 * The documentation on the boldgrid site covers the usage of these
	 * fields and appearances better than what we can do here, so check it out:
	 *
	 * @link https://www.boldgrid.com/docs/configuration-file#social-media-icons
	 */
	$boldgrid_framework_configs['social-icons']['type'] = 'icon-circle-open-thin';
	$boldgrid_framework_configs['social-icons']['size'] = 'normal';
	$boldgrid_framework_configs['menu']['default-menus']['social']['items'] = array(
		array(
			'menu-item-title' =>  __( 'Pinterest' ),
			'menu-item-classes' => 'pinterest',
			'menu-item-url' => '//pinterest.com',
			'menu-item-status' => 'publish'
		),
		array (
			'menu-item-title' =>  __( 'Instagram' ),
			'menu-item-classes' => 'instagram',
			'menu-item-url' => '//instagr.am',
			'menu-item-status' => 'publish',
		),
		array (
			'menu-item-title' =>  __( 'Flickr' ),
			'menu-item-classes' => 'flickr',
			'menu-item-url' => '//flickr.com',
			'menu-item-status' => 'publish'
		),
		array (
			'menu-item-title' =>  __( 'Dribbble' ),
			'menu-item-classes' => 'dribbble',
			'menu-item-url' => '//dribbble.com',
			'menu-item-status' => 'publish',
		),
	);

	/**
	 * BoldGrid provided themes support a variety of options, so another important
	 * thing is setting the appropriate menu locations in a way that is logical
	 * for an end user.  Our requirements internally were to describe the menu
	 * locations based on where they were, instead of using generic names.  An
	 * agency may find that naming the locations as Primary Menu, Secondary Menu,
	 * etc with out contextual reference to the location meets their needs, so in
	 * creating a child theme template to build new child themes from, you could
	 * speed up your process by leaving them as more generic names opposed to
	 * describing them.
	 *
	 * Another use case that might occur is that you decide to add an additional
	 * menu to the footer section of a website, such as a social menu.  BoldGrid
	 * allows users to disable the footer, so any hooks ran in that location should
	 * be removed when that occurs.  If we did that, we could push the social location
	 * to the footer_menus array, which will let the system know it's registered
	 * in the footer.  This line in the comments show how that code looks:
	 *
	 * $boldgrid_framework_configs['menu']['footer_menus'][] = 'social';
	 */

	// Menu Locations.
	$boldgrid_framework_configs['menu']['locations']['primary'] = 'Primary Menu';
	$boldgrid_framework_configs['menu']['locations']['secondary'] = 'Secondary Menu';
	$boldgrid_framework_configs['menu']['locations']['tertiary'] = 'Tertiary Menu';
	$boldgrid_framework_configs['menu']['locations']['social'] = 'Social Media Menu';
	$boldgrid_framework_configs['menu']['locations']['footer_center'] = 'Footer Menu';


	/**
	 * Widget areas follow the same principal as the menu locations.  We had
	 * requirements to describe the locations opposed to using generic names for
	 * them. An agency may take the same approach as with the menu locations above,
	 * and choose to pick something more generic such as header widgets or footer
	 * widgets instead of naming the locations contextually.
	 *
	 * This is how naming the widget areas we added into the header and
	 * footer generic templates in the configurations earlier are named or renamed:
	 */
	$boldgrid_framework_configs['widget']['sidebars']['boldgrid-widget-1']['name'] = 'Call To Action';
	$boldgrid_framework_configs['widget']['sidebars']['boldgrid-widget-2']['name'] = 'Below Primary Navigation';
	$boldgrid_framework_configs['widget']['sidebars']['boldgrid-widget-3']['name'] = 'Footer Center';

	/**
	 * Now we will move on to typography.  Normally I pick out a few things first in
	 * my own workflow, and towards the end of a design, I might end up in a completely
	 * different place.  Since you can't really change out fonts and cycle through
	 * hundreds of fonts from a picture of how a site is supposed to look, you will
	 * hopefully find this an invaluable tool in composing the typography of the site.
	 *
	 * The main bulk of the typography is taken care of below.  This let's you set
	 * the headings, alternate headings, body, and primary nav settings.  The fields
	 * in this array are pretty self explanatory, but you can also refer to theme
	 * configuration documentation on our website:
	 *
	 * @link https://www.boldgrid.com/docs/configuration-file#typography
	 */

	// Enable the Typography feature by setting enabled to true.
	$boldgrid_framework_configs['customizer-options']['typography']['enabled'] = true;
	// Value is px.
	$boldgrid_framework_configs['customizer-options']['typography']['defaults']['headings_font_size'] = 39;
	$boldgrid_framework_configs['customizer-options']['typography']['defaults']['headings_font_family'] = 'Oswald';
	$boldgrid_framework_configs['customizer-options']['typography']['defaults']['headings_text_transform'] = 'uppercase';
	// Value is px.
	$boldgrid_framework_configs['customizer-options']['typography']['defaults']['alternate_headings_font_size'] = 39;
	$boldgrid_framework_configs['customizer-options']['typography']['defaults']['alternate_headings_font_family'] = 'Poiret One';
	$boldgrid_framework_configs['customizer-options']['typography']['defaults']['alternate_headings_text_transform'] = 'capitalize';
	// Value is px.
	$boldgrid_framework_configs['customizer-options']['typography']['defaults']['body_font_size'] = 19;
	$boldgrid_framework_configs['customizer-options']['typography']['defaults']['body_font_family'] = 'Josefin Slab';
	// Value is percentage.
	$boldgrid_framework_configs['customizer-options']['typography']['defaults']['body_line_height'] = 160;
	// Value is px.
	$boldgrid_framework_configs['customizer-options']['typography']['defaults']['navigation_font_size'] = 16;
	$boldgrid_framework_configs['customizer-options']['typography']['defaults']['navigation_text_transform'] = 'uppercase';
	$boldgrid_framework_configs['customizer-options']['typography']['defaults']['navigation_font_family'] = 'Text Me One';

	/**
	 * Custom Bootstrap configurations.  This code allows you to pass in
	 * additional variable and have bootstrap recompiled on theme activation
	 * and customizer save hooks.  This allows you to take advantage of bootstrap
	 * as an actual CSS framework opposed to just trying to override the default
	 * settings they have added.  This example below just shows how you can make
	 * things like adjusting the default navbar quicker, and less buggy.
	 *
	 * The variables that can be passed are any of the variables available to
	 * bootstrap.  For reference to that:
	 *
	 * @link https://github.com/twbs/bootstrap-sass/blob/master/assets/stylesheets/bootstrap/_variables.scss
	 */

	// This will let the framework know that Bootstrap should be recompiled on
	// theme activation.  The theme activation hook is fired when a theme is
	// activated in WordPress.  This is generally where all your setup processes
	// take place.
	$boldgrid_framework_configs['components']['bootstrap']['enabled'] = true;

	// Now we will create an array of variables that we wish to pass to Bootstrap,
	// so that the theme's version of bootstrap has your custom changes.
	$boldgrid_framework_configs['components']['bootstrap']['variables'] = array(
		// Here we will just reset our navbar to transparent.
		// This saves us from having to overwrite a million properties.  This could
		// possibly be a good starting place for the initial template to keep things
		// basic.  One downside to compiling bootstrap using the boldgrid palette
		// colors is that compiling the entire bootstrap library in the customizer
		// during the live preview is way too resource intensive, so the live previews
		// wouldn't reflect the actual color changes.  This can be examined again
		// if this feature become a part of the normal workflow.
		'navbar-default-bg' => 'transparent',
		// Now let's change the default link color to one in our
		// color palette.
		'navbar-default-link-color' => '$palette-primary_2',
		// We'll set apart the active link color to another color in the palette.
		'navbar-default-link-active-color' => '$palette-primary_1',
		// Let's give some hover color to the links too.  We will set the hover color
		// to the 1st color, like the active link is.
		'navbar-default-link-hover-color' => '$palette-primary_1',
		// Now we will redefine some of the navbar toggle's definitions to make
		// the toggle fit our theme a little better.
		// This will remove the border:
		'navbar-default-toggle-border-color' => 'transparent',
		// This will remove the hover background:
		'navbar-default-toggle-hover-bg' => 'transparent',
		// This will give the hamburger a color from our palette.
		'navbar-default-toggle-icon-bar-bg' => '$palette-primary_2',
	);


	/**
	 * Another area that was expressed by an angency was recommending and requiring
	 * certain plugins on a theme by theme basis.  We have integrated the TGM
	 * Plugin Activation library, so you can easily specify theme by theme which
	 * plugins are required or recommended.  This is great if a client deletes plugins
	 * accidentally, or even if they install the theme on a different server, they
	 * will get notification to being installing, updating and getting all the plugins
	 * that their theme requires.
	 *
	 * Since BoldGrid plugins aren't directly from the WordPress repo, I've included
	 * and example below that shows how to recommend the Inspirations, Editor and SEO
	 * plugins.
	 *
	 * You can also recommend or require any plugins from the WordPress
	 * repo as well, so agencies aren't limited to BoldGrid specific things.  The
	 * example below also requires the theme installs "Bootstrap Shortcodes" from
	 * the WordPress.org repository as well.  You can add or remove any number of
	 * things as you see fit.
	 *
	 * Other TGM configurations are overwritable as well, but for the most part
	 * an agency shouldn't have a need for doing more than what is below.
	 *
	 * You can reference the TGM Plugin activation docs below here:
	 *
	 * @link http://tgmpluginactivation.com/configuration/
	 */

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$boldgrid_framework_configs['tgm']['plugins'] = array(
		// Here we add the Inspirations plugin.
		array(
			'name'      => 'BoldGrid Inspirations',
			'slug'      => 'boldgrid-inspirations',
			'source'    => 'https://repo.boldgrid.com/boldgrid-inspirations.zip',
			'required'  => false, // If false, the plugin is only 'recommended' instead of required.
		),
		// Here we add the Editor plugin.
		array(
			'name'      => 'BoldGrid Editor',
			'slug'      => 'boldgrid-editor',
			'source'    => 'https://repo.boldgrid.com/boldgrid-editor.zip',
			'required'  => false, // If false, the plugin is only 'recommended' instead of required.
		),
		// Here we add the SEO plugin.
		array(
			'name'      => 'BoldGrid SEO',
			'slug'      => 'boldgrid-seo',
			'source'    => 'https://repo.boldgrid.com/boldgrid-seo.zip',
			'required'  => false, // If false, the plugin is only 'recommended' instead of required.
		),
		// Here we add the Bootstrap Shortcodes plugin.
		array(
			'name'      => 'Bootstrap Shortcodes',
			'slug'      => 'bootstrap-shortcodes',
			'required'  => true,
		),
	);



	// Configs above will override framework defaults
	return $boldgrid_framework_configs;
}

// Let WordPress know to run our method when the boldgrid_theme_framework filter is called.
add_filter( 'boldgrid_theme_framework_config', 'boldgrid_theme_framework_config' );

/**
 * The Site title and logo controls are handled by the Kirki customizer library.
 * These haven't been abstracted further out to the same filter as above, simply
 * because kirki is already an abstraction of the WordPress customizer API.
 *
 * The formatting is all pretty much the same, and we don't see a need to abstract
 * and abstraction of an API more than what is necessary.  Basically any other
 * controls in Kirki can be modified as well, but in this example we are going to
 * just set the site title default settings.
 *
 * You can read more about how to configure this section in our documentation at:
 *
 * @link https://www.boldgrid.com/docs/configuration-file#site-title
 *
 * The easiest way to get these values instead of just trying to visualize it in
 * your head would be to go into the customizer, and tinker with the site title
 * controls until you get it looking the way you like it looking.  You can inspect
 * the element on the front end and see the CSS properties that we added to it
 * and copy those over for the defaults.
 *
 * Sometimes, I find it easier using a plugin like "Option Inspector" to see what
 * settings my themes are saving:
 *
 * @link https://wordpress.org/plugins/options-inspector/
 *
 * This will let you view theme_mods and options that are stored in the WordPress
 * database.  If you go this route, you can activate it and goto tools > options
 * and type your theme name in the search bar.  You will want to look for an entry
 * that looks like: theme_mods_$name, where $name is will be your theme's name.
 *
 * Using this on this theme, I would want to look for theme_mods_starter.
 *
 * Then just click on the "SERIALIZED DATA" move icon thingy, and it will open up
 * a popup, so you can view the contents easily.  When you set the defaults, of these
 * items - you're setting the default appearance of the theme you're creating.
 * the default settings that will be used.  This means if you were to zip up the
 * theme, and activate it on another WordPress, it should look exactly the same
 * (minus any content you added).  This is a good way to test if you've covered
 * everything.  Once you think you've finished a theme, you can press the delete
 * button next to this data, and this will erase your theme_mods.
 */
function filter_logo_controls( $configs ) {
	// Value should be the name of the Google font.  You can inspect the element
	// and see the style that is applied if you're not sure what the font name is.
	$configs['logo_font_family']['default'] = 'Poiret One';
	// Value is px.
	$configs['logo_font_size']['default'] = 56;
	// Value is px.
	$configs['logo_margin_top']['default'] = 40;
	// Value is px.
	$configs['logo_margin_bottom']['default'] = 0;
	// Value is percentage.
	$configs['logo_line_height']['default'] = 100;
	// Values for css property text-transform.
	$configs['logo_text_transform']['default'] = 'none';
	// Values for css property text-decoration.
	$configs['logo_text_decoration_hover']['default'] = 'none';
	// Values in px.
	$configs['logo_margin_left']['default'] = 0;
	// Values in px.
	$configs['logo_letter_spacing']['default'] = 20;

	// Controls above will override framework defaults
	return $configs;
}

// Let WordPress know to call the filter_logo_controls method when the kirki/fields filter is called.
add_filter( 'kirki/fields', 'filter_logo_controls' );

/**
 * This example is going to show you how to add custom markup to your template.
 * In the header location config, you might have noticed we added
 * '[action]starter_add_triangle' as one of items in our array for that location.
 */
function starter_add_triangle() {
	?>
	<svg class="starter-triangle" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="180" viewBox="0 0 100 102" preserveAspectRatio="none">
		<path d="M0 0 L50 100 L100 0 Z" />
	</svg>
	<?php
}

/**
 * And this is what tells WordPress to run the method starter_add_triangle when
 * the hook 'starter_add_triangle' is called.
 */
add_action( 'starter_add_triangle', 'starter_add_triangle' );

/**
 * This gives you an example of overriding something that the framework might
 * be including already.  In my example, I wanted to increase the accessibility
 * of my mobile menu.  Research shows that the hamburger icon has lower conversion
 * rates compared to using the word "Menu".  I decided for this theme, I'd like
 * to show both, so I wanted to remove the sr-only (for screen readers) because
 * they no longer need to know what an empty element is refering to since the text
 * is visible and describes the area.
 *
 * We are also removing the if has_nav wrapper around our nav men, so the markup
 * displays for the one-pager home page.
 *
 * As a note - BoldGrid handles the mobile menu slightly differently than the
 * standard Bootstrap implementation.  We allow for the parent menu item to be
 * clickable to a URL on dropdowns.  The implementation also shows the hover
 * state of what the mobile menu looks like on mobile in the desktop resized view,
 * and allows you to click on this item, but in mobile, to click on the parent it's
 * triggered with a double click.
 *
 * This is triggered by having the body class 'standard-menu-enabled'.  If you're
 * implementing any custom JS and are wondering why the menu behaves differently
 * please refer to the implementation done in front-end.js of the BoldGrid Theme
 * Framework:
 *
 * @link https://github.com/BoldGrid/boldgrid-theme-framework/blob/master/src/assets/js/front-end.js#L131
 *
 * Additionally jasny bootstrap is integrated into the framework which gives you
 * the ability to create offcanvas menus and all the other goodies it offers, so
 * the below example could be extended into that implementation if desired.
 */
function starter_menu_override() {
	?>
		<nav id="site-navigation" class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-navbar">
					<span class="menu-words">Menu</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div><!-- .navbar-header -->
			<?php do_action( 'boldgrid_menu_primary' ); ?>
		</nav><!-- #site-navigation -->
	<?php
}

// And again we let WordPress know to call the starter_menu_override method when that hook is called!
add_action( 'starter_menu_override', 'starter_menu_override' );

/**
 * The framework supports loading a custom javascript file from the child theme
 * if it exists as well.  This saves you from having to add some extra code to
 * enqueue the javascript file in WordPress.
 *
 * The framework javascript that runs uses DOM based routing, which basically
 * means things get triggered on certain pages/posts/areas when body Classes
 * appear.  I have included an example of adding some custom javascript that will
 * utilize DOM based routing for this theme as an example.  It's used to give us
 * a full page background image before the content actually starts.  I would
 * recommend applying the same concept in javascript you may add to help keep
 * things bug-free and maintainable.
 *
 * The file should be located in start/js/theme.js
 *
 * This doesn't have to be configured, it just needs to be located in that Directory
 * with that name if you have custom javascript to fire.
 *
 * Our default page templates provided didn't follow the standard naming conventions
 * that WordPress would recommend because it uses underscores instead of dashes in
 * the names. To trigger our JavaScript on the page_home.php template, we will
 * add our own custom body class to ensure we trigger what we need, when we need it.
 */
function starter_home_template_class( $classes ) {
	if ( is_page_template( 'page_home.php' ) ) {
		$classes[] = 'starter-home';
	}

	return $classes;
}

// Then we let WordPress know to call our method when the body_class filter is triggered.
add_filter( 'body_class', 'starter_home_template_class' );

/**
 * In our example theme.js for this theme, we are basically creating a one pager
 * site - using the sections that the editor adds.  This let's us get away with
 * not "really" creating a one pager, but making something simple and effective
 * that the user can still edit inside of WordPress.  Again, this is just a quick
 * example of using advanced techniques to make something that is unique from a
 * standard theme offered, so there's always a possibility there's bugs in some
 * of this code. :P
 *
 * There's also a few libraries included that are useful when working on themes.
 * Things like animate.css, wow.js, jquery goup (scroll to top), and slim-scroll
 * to name a few.  These are only loaded on the customer's site if they are set
 * in the configs.  For this example theme, we'll go ahead and load wow.js and
 * animate.css to add some cool transitions as the .boldgrid-sections load into
 * view.
 *
 * We can add these configs to the boldgrid_theme_framework_config method at the
 * beginning of this file, but to keep the flow in order, we will just simply
 * create a new method below to be called when the boldgrid_theme_framework_config
 * filter is called.
 */

function starter_additional_js_configs( $configs ) {
	// Enable Wow.js
	$configs['scripts']['wow-js'] = true;
	// Enabled Animate.css
	$configs['scripts']['animate-css'] = true;

	// Return our modified config array to the framework.
	return $configs;
}

// Let WordPress know to run our method when the boldgrid_theme_framework filter is called.
add_filter( 'boldgrid_theme_framework_config', 'starter_additional_js_configs' );

/**
 * Now I don't particularly want my site title and tagline to be in the same
 * block for "site branding" on this theme.  I prefer to  use my title in the
 * header, but would like to use the tagline field for something like a call
 * to action area.
 *
 * We will want to override the default site_title/tagline action included,
 * and make our own.  The default action is added in the header locations of
 * the config as '[action]boldgrid_site_identity', so we will put our own
 * custom override in as '[action]starter_site_title'.
 *
 * If we were to look into the theme framework, we would see something like this
 * 		<div class="site-branding">
 *			<?php do_action( 'boldgrid_site_title' ); ?>
 *			<?php do_action( 'boldgrid_print_tagline' ); ?>
 *		</div><!-- .site-branding -->
 *
 * Those actions are what output the site title markup and the tagline markup.
 * We can use those hooks in our new method, starter_site_title, so things
 * work automatically and we don't have to rewrite any of the logic used.
 */

function starter_site_title() {
	?>
	<div class="site-branding">
		<?php do_action( 'boldgrid_site_title' ); ?>
	</div>
	<?php
}
add_action( 'starter_site_title', 'starter_site_title' );

/**
 * Now that we've removed the tagline from the site title location, we will
 * want to add in our own custom tagline area, somewhere in our template.
 */
function starter_site_tagline() {
	?>
	<div class="site-tagline">
		<?php do_action( 'boldgrid_print_tagline' ); ?>
	</div>
	<?php
}
add_action( 'starter_site_tagline', 'starter_site_tagline' );
/**
 * I'm not too concered with where I'm going to stick it because I plan on
 * centering it in the middle of the page since I already stretch the background
 * image area out on page load.  I will just add it to header location 3 in theme
 * generic template, which is a md4 so it will already have it's width pretty
 * well taken care of in those events that a user adds a paragraph of text
 * for their tagline.
 */
function starter_add_tagline( $configs ) {
	// We will assign this hook to location 13,
	$configs['template']['locations']['header']['12'] = array( '[action]starter_site_tagline' );

	return $configs;
}

// Then just like the other configs, we will modify the array with our new values
// when the filter is called.
add_filter( 'boldgrid_theme_framework_config', 'starter_add_tagline' );

/**
 * Earlier in our configs, we set the defaults for our social media icons, but in
 * the header location hooks of the generic template, we never added reference to
 * this menu.  This is because we're going to add the menu to a location that exists
 * outside of the header.
 *
 * We give the header a nice slide down effect, and we're going to make our social
 * icons be in a menu that's appended to the side in center with flex box in css.
 *
 * There's a lot of additional hooks sprinkled throughout the theme templates, so
 * you will be able to do most anything you desire in terms of customization.  There
 * is no right way, or wrong way to do things sometimes, it's all based on your
 * own approach.
 *
 * The hook we will be using is 'boldgrid_header_after'.  This is a hook that is
 * fired after the header, but before the content.  You can see some of these more
 * broad hooks in the base.php template.  The hook we are using is located there:
 *
 * @link https://github.com/BoldGrid/prime/blob/master/base.php#L24
 *
 * Placing our social menu location there, is just creating a reference to that
 * menu, which is created in our configs in the social menu section.  This menu
 * is called "social" in our case, which is why we added social network configs
 * to $boldgrid_framework_configs['menu']['default-menus']['social']['items'].
 *
 * Internally the method that calls this code is just setting up hooks to be fired.
 */
function starter_add_social_menu() {
	do_action( 'boldgrid_menu_social' );
}

// Now we tell WordPress to call the starter_add_social_menu method when the
// boldgrid_header_after hook is triggered.
add_action( 'boldgrid_header_after', 'starter_add_social_menu' );

/**
 * Now we are going to add our back to top button.  This is powered by jquery
 * goup, so we can just call that script from our framework configs like
 * all the other scripts we've added.
 */
function starter_back_to_top( $configs ) {
	// We will assign this hook to location 13,
	$configs['scripts']['options']['goup']['enabled'] = true;

	return $configs;
}

// Then just like the other configs, we will modify the array with our new values
// when the filter is called.
add_filter( 'boldgrid_theme_framework_config', 'starter_back_to_top' );
