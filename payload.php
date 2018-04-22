<!DOCTYPE html>

<html>

<div id="here"></div>


<?php
include 'simple_html_dom.php';
require_once('url_to_absolute.php');

$context = stream_context_create(array(
    'http' => array(
        'header' => array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201'),
    ),
));
$html = file_get_html("https://www.reddit.com/r/MachineLearning/comments/2ujkvu/music_recognition_the_shazam_algorithm/");
$array = array();
foreach($html->find('a') as $element){
	if($element->href){


		$test = url_to_absolute($html, $element->href);
		$trimmed = trim(preg_replace('/,\t*(?=]\s*})/', "", $test));
		array_push($array, $trimmed);
	}
	
}
foreach($array as $val){
	if($val == FALSE){
		echo("empty file" ."<br>");
	}
	else{
		$html2 = @file_get_html($val);
		
		foreach ($html2->find('a') as $element2) {
			echo urldecode($element2->href) . "<br>";
		}
	}
}

?>
</html>