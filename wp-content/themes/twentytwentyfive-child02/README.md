# Twenty Twenty-Five Child Theme

A customized child theme for WordPress Twenty Twenty-Five with Open Sans font and cornsilk as a secondary color.

## Features

- **Open Sans** as the primary font throughout the theme
- **Cornsilk** color as the secondary color
- Multiple style variations (Light, Dark, Colorful)
- Admin panel for easily switching between styles
- Custom block patterns optimized for the theme
- Full compatibility with the WordPress block editor

## Installation

1. Make sure the parent Twenty Twenty-Five theme is installed in your WordPress site
2. Download this child theme as a zip file
3. Go to your WordPress admin panel, then to **Appearance > Themes > Add New**
4. Click the **Upload Theme** button
5. Choose the downloaded zip file and click **Install Now**
6. After installation, click **Activate** to activate the child theme

## Directory Structure

```
twentytwentyfive-child/
├── functions.php          # Core theme functionality
├── style.css              # Main stylesheet
├── theme.json             # Block editor settings
├── styles/                # Additional style variations
│   ├── light.css          # Light style variant
│   ├── dark.css           # Dark style variant
│   └── colorful.css       # Colorful style variant
└── README.md              # This file
```

## Usage

### Switching Styles

1. After activating the theme, go to **Theme Styles** in the WordPress admin menu
2. Select your preferred style from the dropdown (Default, Light, Dark, or Colorful)
3. Click **Save Settings**
4. Visit your site to see the changes

### Using Block Patterns

This theme includes custom block patterns that take advantage of Open Sans and the cornsilk color scheme:

1. In the block editor, click the **+** button to add a new block
2. Go to the **Patterns** tab
3. Look for the **Twenty Twenty-Five Child** category
4. Choose from the available patterns to add them to your content

## Customization

### Adding More Styles

To add more style variations:

1. Create a new CSS file in the `styles/` directory (e.g., `modern.css`)
2. Add your custom CSS rules
3. Open `functions.php` and find the `$styles` array in the `twentytwentyfive_child_theme_options_page_html` function
4. Add your new style to the array: `'modern' => 'Modern Style'`

### Editing Theme Settings

For more advanced customization, you can modify:

- `theme.json` to change global theme settings and block editor configuration
- `functions.php` to add or modify theme functionality
- `style.css` to update the base styling

## Support

If you need help with this theme, please contact your theme developer or visit the WordPress support forums.