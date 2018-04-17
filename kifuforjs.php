<?php
/**
* @package kifuforjs
* @version 1.0
*/
/*
Plugin Name: kifuforjs
Plugin URI: https://github.com/seitarok/kifuforjs-wp-plugin
Description: ブログ記事にkifuforjsを表示する
Author: seitarok
Version: 1.0
Author URI: http://futago-life.com/wife-support
*/

add_action( 'wp_enqueue_scripts', 'enqueue_kifuforjs' );
function enqueue_kifuforjs() {
	wp_enqueue_style( 'kifuforjs', plugins_url('Kifu-for-JS/css/kifuforjs.css', __FILE__));
	wp_enqueue_script(
		'kifuforjs',
		plugins_url('Kifu-for-JS/out/kifuforjs.js', __FILE__),
		array( 'jquery' ),
		false,
		true
	);
  wp_enqueue_style( 'kifuforjs-wp-plugin', plugins_url('kifuforjs.css', __FILE__));
  wp_enqueue_script(
    'kifuforjs-wp-plugin',
    plugins_url('kifuforjs.js', __FILE__),
    array( 'kifuforjs' ),
    false,
    true
  );
  wp_localize_script('kifuforjs-wp-plugin', 'args', array('ImageDirectoryPath' => plugins_url('Kifu-for-JS/images', __FILE__)));
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
    $a = shortcode_atts( array(
        'text' => null,
        'url' => null,
        'tesuu' => null,
        'reverse' => null,
        'comment' => null,
    ), $atts );

    $attr = '';
    foreach ( $a as $key => $value ) {
      $attr .= " {$key}='{$value}'";
    }
    $attr = preg_replace('/<[Bb][Rr](\s+\/)?>/', '', $attr); // textから<br>タグを削除
    return "<div class='board' {$attr}></div>";
}
add_shortcode( 'board', 'board_func' );

?>