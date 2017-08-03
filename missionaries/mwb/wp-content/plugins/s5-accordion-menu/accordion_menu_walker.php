<?php

class Accordion_Menu_Walker extends Walker_Nav_Menu{

	var $options;

	function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output){
        // check, whether there are children for the given ID and append it to the element with a (new) ID
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
		$this->options['isParent'] = $element->hasChildren;
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$this->options = array_merge($args->walker_arg,$this->options); extract($this->options);
		$indent = str_repeat("\t", $depth);
		if($depth == 0 && !$this->options['isParent']){
		}else{
		$output .= "\n$indent<ul class=\"s5_am_innermenu\">\n";}
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$this->options = array_merge($args->walker_arg,$this->options); extract($this->options);
		$indent = str_repeat("\t", $depth);
		if($depth == 0 && !$this->options['isParent']){
		}else{
		$output .= "$indent</ul>\n";
		}
	}

    function start_el(&$output, $item, $depth, $args){
		$this->options = array_merge($args->walker_arg,$this->options); extract($this->options);

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		if($depth == 0){
			$output .= '<h3 class="s5_am_toggler ';
			$output .= ($this->options['isParent'] == 1) ? ' s5_am_parent' : ' s5_am_not_parent';
			$output .= '"';
			$output .= strpos($class_names,'current') ? ' id="current"' : '';
			$output .= '>';
		}elseif($item->title == 'Column Splitter'){
			$output .= $indent . '<li class="s5_am_inner_li" style="display:none;">';//'<li' . $id . $value . $class_names .'>';
		}else{
			$output .= $indent . '<li class="s5_am_inner_li">';//'<li' . $id . $value . $class_names .'>';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<span class="s5_accordion_menu_left">'."\n".'<a'. $attributes .' class="mainlevel">'."\n".'<span>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</span></a></span>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		if($depth == 0){
			$output .= '</h3>'."\n".'<div style="display: none; border: medium none; overflow: hidden; padding: 0px; margin: 0px; opacity: 0; height: 0px;" class="s5_accordion_menu_element"';
			$output .= strpos($class_names,'current') ? ' id="s5_am_parent_div_current"':'';
			$output .= '>';
		}
		//$output .= $this->options['isParent'] ? '<ul class="s5_am_innermenu">' : '';

	}
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$this->options = array_merge($args->walker_arg,$this->options); extract($this->options);
		//$output .= $depth;
		//
		if($depth == 0){
			$output .= ($this->options['isParent'] == 1) ? '</ul>' : '';
			$output .= '</div>'."\n";
		}else{
			$output .= "</li>";
		}
		$output = str_replace('</span><li','</span></li><li',$output);
		$output = str_replace('</span></ul>','</span></li></ul>',$output);
		$output = str_replace('</ul><li','</ul></li><li',$output);
		$output = str_replace('</li></li>','</li>',$output);
		$output = str_replace('</li></div>','</li></ul></div>',$output);
		$output = str_replace('</ul></ul>','</ul></li></ul>',$output);
	}

}