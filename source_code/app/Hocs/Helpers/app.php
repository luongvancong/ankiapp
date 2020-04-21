<?php

if( ! function_exists('parse_file_url') ) {
    /**
     * Lấy url của ảnh
     * @param  string $image
     * @return string
     */
    function parse_file_url($image) {
        $explode = explode('___', $image);
        if(isset($explode[1])) {
            return '/'. config('upload.upload_folder') .'/' . date('Y/m/d', $explode[1]) . '/' . $image;
        }
    }
}


if( ! function_exists('setting') ) {
    /**
     * Setting metadata
     * @return App\Hocs\Core\Metadata\Metadata
     */
    function setting() {
        return resolve('Setting');
    }
}

if( ! function_exists('get_image_folder') ) {
    /**
     * Lấy tên folder chứa ảnh theo tên ảnh
     * @param  string $image
     * @return string
     */
    function get_image_folder($image) {
        $explode = explode('___', $image);
        if(isset($explode[1])) {
            return date('Y/m/d', $explode[1]);
        }

        return '';
    }
}

if( ! function_exists('gallery_init') ) {
    /**
     * Tạo control chọn ảnh gallery
     * @param  string $imgId
     * @param  string $controlName
     * @return string
     */
    function gallery_init($imgId, $controlName, $defaultValueControl = null) {
        return view('resource::admin/gallery/control', [
            'imgId'       => $imgId,
            'controlName' => $controlName,
            'defaultValueControl' => $defaultValueControl
        ]);
    }
}

if( ! function_exists('enqueue_asset')) {
    /**
     * Add css, javascript with version to website
     * See more: \App\Helper\Asset, Middleware\Asset, AppServiceProvider
     * @return \App\Helper\Asset
     */
    function enqueue_asset() {
        return app('Asset');
    }
}