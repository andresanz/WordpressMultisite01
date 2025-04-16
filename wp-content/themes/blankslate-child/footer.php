<?php
/**
 * The template for displaying the footer
 */
?>
        </div><!-- #container -->

        <div class="container">
            
        <?php dynamic_sidebar('footer-widgets'); ?>
</div>




        <footer id="footer" role="contentinfo">
            <div class="container">
                <?php if (is_active_sidebar('footer-widgets')) : ?>
     
                <?php endif; ?>
                
                <?php if (has_nav_menu('footer-menu')) : ?>
                <nav id="footer-menu">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'container' => false,
                        'depth' => 1
                    )); ?>
                </nav>
                <?php endif; ?>

                <div id="copyright">
                    &copy; <?php echo esc_html(date_i18n(__('Y', 'blankslate-child'))); ?> <?php echo esc_html(get_bloginfo('name')); ?>
                </div>
                
                
            </div>
        </footer>
    </div><!-- #wrapper -->
    <?php wp_footer(); ?>
    
    <script type="text/javascript">
jQuery(document).ready(function($) {
    // Target all wp-block-image figures
    $('figure.wp-block-image img').each(function() {
        var $img = $(this);
        
        // Get the full-size image URL
        var imgSrc = $img.attr('src');
        var fullSizeUrl = imgSrc;
        
        // If the image has srcset, try to get the largest version
        if ($img.attr('srcset')) {
            var srcsetItems = $img.attr('srcset').split(',');
            var largestSrc = '';
            var largestWidth = 0;
            
            // Find the largest image in srcset
            for (var i = 0; i < srcsetItems.length; i++) {
                var parts = srcsetItems[i].trim().split(' ');
                if (parts.length >= 2) {
                    var width = parseInt(parts[parts.length-1].replace('w', ''));
                    if (width > largestWidth) {
                        largestWidth = width;
                        largestSrc = parts[0];
                    }
                }
            }
            
            if (largestSrc) {
                fullSizeUrl = largestSrc;
            }
        }
        
        // Try to get the original image URL by removing size suffixes
        fullSizeUrl = fullSizeUrl.replace(/-\d+x\d+(?=\.(jpg|jpeg|png|gif))/i, '');
        
        // Wrap the image with a lightbox link if it's not already wrapped
        if (!$img.parent('a').length) {
            $img.wrap('<a href="' + fullSizeUrl + '" data-fancybox="gallery" data-caption="' + ($img.attr('alt') || '') + '"></a>');
        } else {
            // If already in a link, just add the fancybox attributes
            $img.parent('a').attr({
                'data-fancybox': 'gallery',
                'href': fullSizeUrl,
                'data-caption': $img.attr('alt') || ''
            });
        }
    });
    
    // Add custom CSS for WordPress logged-in users
    $('<style>')
        .text(`
            .fancybox-image { cursor: zoom-in !important; }
            
            /* Force toolbar to always be visible */
            .fancybox-toolbar {
                opacity: 1 !important;
                visibility: visible !important;
                display: block !important;
            }
            
            /* Position toolbar to avoid admin bar conflict */
            body.admin-bar .fancybox-toolbar {
                top: 46px !important;
            }
            @media screen and (min-width: 783px) {
                body.admin-bar .fancybox-toolbar {
                    top: 32px !important;
                }
            }
            
            /* Ensure lightbox container doesn't get hidden under admin bar */
            body.admin-bar .fancybox-container {
                top: 32px;
                height: calc(100% - 32px);
            }
            @media screen and (max-width: 782px) {
                body.admin-bar .fancybox-container {
                    top: 46px;
                    height: calc(100% - 46px);
                }
            }
            
            /* Make sure all buttons are visible */
            .fancybox-button {
                display: inline-block !important;
                opacity: 0.8 !important;
                visibility: visible !important;
            }
            .fancybox-button:hover {
                opacity: 1 !important;
            }
        `)
        .appendTo('head');
    
    // Initialize FancyBox with special handling for admin users
    $('[data-fancybox]').fancybox({
        buttons: [
            "zoom",
            "slideShow",
            "fullScreen",
            "thumbs",
            "close"
        ],
        loop: true,
        animationEffect: "fade",
        infobar: true,
        toolbar: true,
        idleTime: false,         // Never hide the toolbar
        baseClass: $('body').hasClass('admin-bar') ? 'fancybox-admin-mode' : '',
        clickContent: "zoom",
        clickSlide: "close",
        dblclickContent: "zoom",
        touch: {
            vertical: true,
            momentum: true
        },
        beforeShow: function() {
            // Check if FancyBox CSS is loaded
            if (!$('link[href*="jquery.fancybox.min.css"]').length) {
                $('<link>')
                    .attr({
                        rel: 'stylesheet',
                        type: 'text/css',
                        href: 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css'
                    })
                    .appendTo('head');
            }
        },
        afterShow: function() {
            // Force toolbar to always be visible
            $('.fancybox-toolbar').css({
                'opacity': '1',
                'visibility': 'visible',
                'display': 'block'
            });
            
            // Ensure buttons are visible
            $('.fancybox-button').css({
                'display': 'inline-block',
                'opacity': '0.8',
                'visibility': 'visible'
            });
        }
    });
});
</script>

</body>
</html>