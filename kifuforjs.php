<?php
/**
* @package kifuforjs
* @version 2.0.0
*/
/*
Plugin Name: kifuforjs
Plugin URI: https://github.com/seitarok/kifuforjs-wp-plugin
Description: ブログ記事にkifuforjsを表示する
Author: seitarok
Version: 2.0.0.0
Author URI: http://futago-life.com/wife-support
*/

add_action( 'wp_enqueue_scripts', 'enqueue_kifuforjs' );
function enqueue_kifuforjs() {
  wp_enqueue_script(
    'kifu-for-js-2.0.0',
    plugins_url('kifu-for-js-2.0.0.min.js', __FILE__),
    array( 'jquery' ),
    false,
    true
  );
  wp_enqueue_style( 'kifuforjs-wp-plugin', plugins_url('kifuforjs.css', __FILE__));
  wp_enqueue_script(
    'kifuforjs-wp-plugin',
    plugins_url('kifuforjs.js', __FILE__),
    array( 'kifu-for-js-2.0.0' ),
    false,
    true
  );
}

// KIF, KI2, CSA, JKF ファイルをアップロード可能に
function custom_mime_types( $mimes ) {
  $mimes['kif'] = 'text/plain';
  $mimes['ki2'] = 'text/plain';
  $mimes['csa'] = 'text/plain';
  $mimes['jkf'] = 'text/plain';
  return $mimes;
}
add_filter( 'upload_mimes', 'custom_mime_types' );

function custom_ext2type($mimes) {
    array_push($mimes, array('document' => 'kif'));
    array_push($mimes, array('document' => 'ki2'));
    array_push($mimes, array('document' => 'csa'));
    array_push($mimes, array('document' => 'jkf'));
    return $mimes;
}
add_filter('ext2type', 'custom_ext2type');

// shortcodeの登録
// [board text="kifu text" url="kifu file path" tesuu=number_of_tesuu reverse=1 comment=1]
function board_func( $atts ) {
    $id = 0;
    $a = shortcode_atts( array(
        'text' => null,
        'url' => null,
        'tesuu' => null,
        'reverse' => null,
        'comment' => null,
    ), $atts );

    $attr = '';
    foreach ( $a as $key => $value ) {
      $value = strip_tags($value); // htmlタグを削除
      $search = array ("'^\s+'","'\s{2,}'","'\s+$'","'手数.*指手.*消費時間.*\n'");
      $replace = array ("","\n","","手数----指手---------消費時間--\n");
      $value = preg_replace ($search, $replace, $value); // 不要な改行を削除
      $attr .= " {$key}='{$value}'";
    }
    $html = "<div class='board' {$attr}></div>";
    return $html;
}
add_shortcode( 'board', 'board_func' );

?>