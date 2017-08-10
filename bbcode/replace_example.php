<?php 

include('bbcode.php');

//object with default bbcode tags
$bbcode = new bbcode();

//tags

$tags = array(
	'img' => array(
		'start' => '[img]',
		'end' => '[/img]',
		'replace_into' => '<img src="[@image]" class="img-responsive" />',
		'replace_tag' => '[@image]'
	),

	'br' => array(
		'start' => '[br]',
		'end' => '',
		'replace_into' => '<br />',
		'replace_tag' => ''
	),	

	'h1' => array(
		'start' => '[h1]',
			'end' => '[/h1]',
		'replace_into' => '<h1>[@text]</h1>',
		'replace_tag' => '[@text]'		
	),

	'h2' => array(
		'start' => '[h2]',
		'end' => '[/h2]',
		'replace_into' => '<h2>[@text]</h2>',
		'replace_tag' => '[@text]'		
	)
);

//object with custom bbcode tags
$bbcode_custom = new bbcode($tags);

$string = 
"
[h1]Lorem ipsum[/h1]
Lorem ipsum dolor sit amet, consectetur adipisicing elit.[br]
[img]https://www.w3schools.com/css/img_fjords.jpg[/img][br]
Fuga hic optio, aliquam officiis eos autem, unde.
Ipsum, magni, distinctio molestiae, excepturi cum odit tempora enim dolorum labore quam at placeat.
";

echo $bbcode_custom->ChangeTags($string);

?>