<?php 

/**
@class: bbcode
@author: Deivydas Žibkus
@author email: info@deivydas.com
@created: 2017-08-10
@description: converts bbcode into html tags
**/

	class bbcode
	{
		public $tags;

		function __construct($tags = NULL)
		{
			if($tags != NULL)
			{
				if($this->CheckIfTagsAreValid($tags))
				{
					$this->tags = $tags;
				}
				else
				{
					die("The array schema of tags is invalid!");
				}
			}
			else
			{
				$this->tags = $this->DefaultTags();
			}
		}

		//Function for replacing all the tags
		public function ChangeTags($content)
		{
			foreach ($this->tags as $value) {
				$content = $this->replace_string_between($content, $value);
			}

			return $content;
		}

		//function for changing a tag
		private function replace_string_between($string, $params)
		{
			while($ini = strpos($string, $params['start']))
			{
				if($params['end'] != NULL) 
				{
					//starting position
					$ini += strlen($params['start']);

					//content length
					$len = strpos($string, $params['end'], $ini) - $ini;

					$content_between_tags = substr($string, $ini, $len);

					$content_with_tags = $params['start'] . $content_between_tags . $params['end'];

					$change_to = str_replace($params['replace_tag'], $content_between_tags, $params['replace_into']);

					$string = str_replace($content_with_tags, $change_to, $string);
				}

				else
				{
					$string = str_replace($params['start'], $params['replace_into'], $string);
				}

			}

		    return $string;
		}

		//function for checking if the tags given are valid by their array schema
		private function CheckIfTagsAreValid($tags)
		{
			$valid = true;

			foreach ($tags as $value) 
			{
				if(!array_key_exists('start', $value))
				{
					return false;
				}

				if(!array_key_exists('end', $value))
				{
					return false;
				}

				if(!array_key_exists('replace_into', $value))
				{
					return false;
				}

				if(!array_key_exists('replace_tag', $value))
				{
					return false;
				}

			}

			return $valid;			
		}		

		//function of default tags
		private function DefaultTags()
		{
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

			return $tags;
		}
	}

?>
