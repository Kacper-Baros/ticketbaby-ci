<?php

function admin_img($uri, $tag=false)
{
    return theme_url('assets/admin/images/'.$uri);
}

function admin_css($uri, $tag=false)
{
    return theme_url('assets/admin/css/'.$uri);
}

function admin_js($uri, $tag=false)
{
    return theme_url('assets/admin/js/'.$uri);
}


?>
