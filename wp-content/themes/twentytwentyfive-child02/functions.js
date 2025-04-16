/**
 * Custom JavaScript functionality for Twenty Twenty-Five Child Theme
 */

(function() {
    'use strict';

    // Document ready equivalent
    document.addEventListener('DOMContentLoaded', function() {
        
        // Add Open Sans font class to relevant elements if not already applied
        function applyOpenSansToElements() {
            const elements = document.querySelectorAll('h1, h2, h3, h4, h5, h6, p, li, a, button');
            elements.forEach(function(element) {
                if (!element.style.fontFamily) {
                    element.style.fontFamily = 'Open Sans, sans-serif';
                }
            });
        }

        // Apply styles based on URL parameters (for style preview functionality)
        function checkForStylePreview() {
            const urlParams = new URLSearchParams(window.location.search);
            const previewStyle = urlParams.get('preview_style');
            
            if (previewStyle) {
                // Remove any existing preview styles
                const existingPreviewStyle = document.getElementById('preview-style-css');
                if (existingPreviewStyle) {
                    existingPreviewStyle.remove();
                }
                
                // Add the new preview style
                const styleLink = document.createElement('link');
                styleLink.id = 'preview-style-css';
                styleLink.rel = 'stylesheet';
                styleLink.href = wp_theme_styles.style_url.replace('STYLE_NAME', previewStyle);
                document.head.appendChild(styleLink);
                
                // Add an indicator for the preview
                const previewIndicator = document.createElement('div');
                previewIndicator.className = 'style-preview-indicator';
                previewIndicator.innerHTML = 'Previewing: ' + previewStyle + ' style <a href="' + window.location.pathname + '">Exit Preview</a>';
                document.body.prepend(previewIndicator);
            }
        }

        // Initialize functionality
        if (document.body.classList.contains('wp-admin')) {
            // Admin-specific code
            
            // Add style preview functionality to admin
            const styleSelects = document.querySelectorAll('select[name="style"]');
            if (styleSelects.length > 0) {
                styleSelects.forEach(function(select) {
                    // Create preview button
                    const previewBtn = document.createElement('button');
                    previewBtn.className = 'button';
                    previewBtn.type = 'button';
                    previewBtn.textContent = 'Preview Style';
                    previewBtn.style.marginLeft = '10px';
                    
                    // Insert after select
                    select.parentNode.insertBefore(previewBtn, select.nextSibling);
                    
                    // Add click event
                    previewBtn.addEventListener('click', function() {
                        const selectedStyle = select.value;
                        if (selectedStyle) {
                            window.open(wp_theme_styles.home_url + '?preview_style=' + selectedStyle, '_blank');
                        }
                    });
                });
            }
        } else {
            // Frontend-specific code
            applyOpenSansToElements();
            checkForStylePreview();
        }
    });

})();