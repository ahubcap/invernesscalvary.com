<?php

  $xml = $this->xml_dir.'wid_opts.xml';
  $xml = simplexml_load_file($xml);

  foreach($xml->config->fields->fieldset->field as $option){
	$opt_name = '';
	$opt_name = $option['name'];
	//$opt_value = $instance["$opt_name"];
	$field_id = $this->get_field_id($option['name']);
	$field_name = $this->get_field_name($option['name']);
	$field_value = isset( $instance["$opt_name"] ) ? $instance["$opt_name"] : $option['default'];
	switch($option['type']){
	  case "text":
		$output = '<p><label for="'.$field_id.'">'.$option['label'].':</label><input class="widefat" id="'.$field_id.'"	name="'.$field_name.'" type="text" value="'.$field_value.'" style="width:100%;" /></p>';
		echo $output;
		unset($output);
		break;
	  case "radio":
	  case "list":
		$output = '<p><label for="'.$field_id.'">'.$option['label'].'</label><select id="'.$field_id.'" name="'.$field_name.'" class="widefat" style="width:100%;">';
			foreach($option->option as $select){
				$output .='<option ';
				if ( $select['value'] == $field_value ) $output .= 'selected="selected"';
				$output .=' value="'.$select['value'].'">'.$select.'</option>';}

		$output .= '</select></p>';
		echo $output;
		unset($output);
		break;
	  case "textarea":
		$output = '<p><label for="'.$field_id.'">'.$option['label'].':</label><textarea class="widefat" id="'.$field_id.'"	name="'.$field_name.'" rows="'.$option['rows'].'" cols="'.$option['cols'].'" value="'.$field_value.'" style="width:100%;height:100px">'.$field_value.'</textarea></p>';
		echo $output;
		unset($output);
		break;
	  default:
		break;
	}
  }


?>