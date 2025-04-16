<?php
// === Allow HEIC uploads ===
add_filter('upload_mimes', function($mimes) {
    $mimes['heic'] = 'image/heic';
    return $mimes;
});

// === Before Upload: Rename .heic to .png ===
add_filter('wp_handle_upload_prefilter', function($file) {
    if (!empty($file['type']) && $file['type'] === 'image/heic') {
        $file['name'] = preg_replace('/\\.heic$/i', '.png', $file['name']);
    }
    return $file;
});

// === After Upload: Convert HEIC to PNG (Manual uploads) ===
add_filter('wp_handle_upload', function($upload) {
    $file_path = $upload['file'];

    if (file_exists($file_path) && mime_content_type($file_path) === 'image/heic') {
        try {
            $imagick = new Imagick($file_path);
            $imagick->setImageFormat('png');

            $new_path = preg_replace('/\\.heic$/i', '.png', $file_path);
            $imagick->writeImage($new_path);

            $imagick->clear();
            $imagick->destroy();

            unlink($file_path); // Remove original HEIC

            $upload['file'] = $new_path;
            $upload['url'] = preg_replace('/\\.heic$/i', '.png', $upload['url']);
            $upload['type'] = 'image/png';
        } catch (Exception $e) {
            error_log('HEIC to PNG conversion failed (manual upload): ' . $e->getMessage());
        }
    }

    return $upload;
});

// === After REST API Upload (Shortcuts, mobile apps) ===
add_action('rest_after_insert_attachment', function($attachment, $request, $creating) {
    $file_path = get_attached_file($attachment->ID);

    if (file_exists($file_path) && mime_content_type($file_path) === 'image/heic') {
        try {
            $imagick = new Imagick($file_path);
            $imagick->setImageFormat('png');

            $new_path = preg_replace('/\\.heic$/i', '.png', $file_path);
            $imagick->writeImage($new_path);

            $imagick->clear();
            $imagick->destroy();

            unlink($file_path); // Remove original HEIC

            update_attached_file($attachment->ID, $new_path);
            wp_update_attachment_metadata($attachment->ID, wp_generate_attachment_metadata($attachment->ID, $new_path));

            $attachment->guid = preg_replace('/\\.heic$/i', '.png', $attachment->guid);
            wp_update_post([
                'ID' => $attachment->ID,
                'guid' => $attachment->guid
            ]);

        } catch (Exception $e) {
            error_log('HEIC to PNG conversion failed (REST upload): ' . $e->getMessage());
        }
    }
}, 10, 3);

// === Replace .heic in post content with .png ===
add_filter('the_content', function($content) {
    return str_replace('.heic', '.png', $content);
});