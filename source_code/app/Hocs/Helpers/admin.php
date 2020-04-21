<?php


if(! function_exists('admin_sidebar')) {
    /**
     * Get admin sidebar
     * @return array
     */
    function admin_sidebar() {
        $sidebar = config('admin.sidebar');
        return $sidebar;
    }
}
