<?php

/**
 * Build configuration template for acp configuration pages
 */
function build_cfg_template($tpl_type, $key, &$new, $config_key, $vars, $lang, $explain)
{

    $tpl = '';
    $name = $config_key;

    // Make sure there is no notice printed out for non-existent config options (we simply set them)
    if (!isset($new[$config_key]))
    {
        $new[$config_key] = '';
    }

    switch ($tpl_type[0])
    {
        case 'headLi':
            $tpl = '<li><a href="javascript:void(0)" class="vertex-style-link" rel="' . $name . '">' . $lang . '</a></li>';
            break;

        case 'openFader':
            $tpl = '<div id="' . $name . '" class="faderPage">';
            break;

        case 'closeFader':
            $tpl = '</div>';
            break;

        case 'openTab':
            $tpl = '<div class="da-fader da-fader-panel" id="' . $vars['id'] . '"><h2 class="df-h2">' . $lang . '</h2><div class="fader-panel">';
            break;

        case 'closeTab':
            $tpl = '</div></div>';
            break;

        case 'text':
        case 'password':
            $size = (int)$tpl_type[1];
            $maxlength = (int)$tpl_type[2];

            $tpl = '<dl class="item">
                    <dt class="item-name"><label for="' . $name . '">' . $lang . ':</label>' . ($explain != '' ? '<br /><span>' . $explain . '</span>' : '') . '</dt>
                    <dd class="item-value"><input id="' . $key . '" type="' . $tpl_type[0] . '"' . (($size) ? ' size="' . $size . '"' : '') . ' maxlength="' . (($maxlength) ? $maxlength : 255) . '" name="' . $name . '" value="' . $new . '" /></dd>
                </dl>';
            break;

        case 'wid_styles':
            global $sb_styles;
            echo implode(',',$sb_styles);
           	if(!isset($sb_styles)){break;}
            $style_count=00;
            $explain = "Enter the IDs of each widget needing this style";
            $new = "none";
            foreach($sb_styles as $style){
                $size = (int)$tpl_type[1];
                $maxlength = (int)$tpl_type[2];
                $name = THEME_NAME.'mod_style'.$style_count;
                $lang = "Widgets with the &quot;".$$sb_styles."&quot; style";
                $tpl = '<dl class="item">
                        <dt class="item-name"><label for="' . $name . '">' . $lang . ':</label>' . ($explain != '' ? '<br /><span>' . $explain . '</span>' : '') . '</dt>
                        <dd class="item-value"><input id="' . $key . '" type="' . $tpl_type[0] . '"' . (($size) ? ' size="' . $size . '"' : '') . ' maxlength="' . (($maxlength) ? $maxlength : 255) . '" name="' . $name . '" value="' . $new . '" /></dd>
                    </dl>';
                $style_count++;
            }break;

        case 'dimension':
            $size = (int)$tpl_type[1];
            $maxlength = (int)$tpl_type[2];

            $tpl = '<dl class="item">
                    <dt class="item-name"><label for="' . $name . '">' . $lang . ':</label>' . ($explain != '' ? '<br /><span>' . $explain . '</span>' : '') . '</dt>
                    <dd class="item-value"><input id="' . $key . '" type="text"' . (($size) ? ' size="' . $size . '"' : '') . ' maxlength="' . (($maxlength) ? $maxlength : 255) . '" name="' . $config_key . '_width" value="' . $new . '_width' . '" /> x <input type="text"' . (($size) ? ' size="' . $size .
                '"' : '') . ' maxlength="' . (($maxlength) ? $maxlength : 255) . '" name="' . $config_key . '_height" value="' . $new . '_height' . '" /></dd>
                </dl>';
            break;

        case 'textarea':
            $rows = (int)$tpl_type[1];
            $cols = (int)$tpl_type[2];

            $tpl = '<dl class="item">
                    <dt class="item-name"><label for="' . $name . '">' . $lang . ':</label>' . ($explain != '' ? '<br /><span>' . $explain . '</span>' : '') . '</dt>
                    <dd class="item-value"><textarea id="' . $key . '" name="' . $name . '" rows="' . $rows . '" cols="' . $cols . '">' . $new . '</textarea></dd>
                </dl>';
            break;

        case 'radio':
            $key_yes = ($new[$config_key]) ? ' checked="checked"':
            '';
            $key_no = (!$new[$config_key]) ? ' checked="checked"':
            '';

            $tpl_type_cond = explode('_', $tpl_type[1]);
            $type_no = ($tpl_type_cond[0] == 'disabled' || $tpl_type_cond[0] == 'enabled') ? false:
            true;

            $tpl_no = '<label><input type="radio" name="' . $name . '" value="0"' . $key_no . ' class="radio" /> ' . (($type_no) ? 'No' : 'Disabled') . '</label>';
            $tpl_yes = '<label><input type="radio" id="' . $key . '" name="' . $name . '" value="1"' . $key_yes . ' class="radio" /> ' . (($type_no) ? 'Yes' : 'Enabled') . '</label>';

            $tpl = ($tpl_type_cond[0] == 'yes' || $tpl_type_cond[0] == 'enabled') ? '<dl class="item">
                    <dt class="item-name"><label for="' . $name . '">' . $lang . ':</label>' . ($explain != '' ? '<br /><span>' . $explain . '</span>' : '') . '</dt>
                    <dd class="item-value">' . $tpl_yes . $tpl_no . '</dd>
                </dl>':
            $tpl_no . $tpl_yes;
            break;

        case 'select':
        case 'custom':

            $return = '';

            if (isset($vars['function']))
            {
                $call = $vars['function'];
            } else
            {
                break;
            }

            if (isset($vars['params']))
            {
                $args = array();
                foreach ($vars['params'] as $value)
                {
                    switch ($value)
                    {
                        case '{CONFIG_VALUE}':
                            $value = $new;
                            break;

                        case '{KEY}':
                            $value = get_option($key);
                            break;
                    }

                    $args[] = $value;
                }
            } else
            {
                $args = array($new, $key);
            }

            $return = call_user_func_array($call, $args);

            if ($tpl_type[0] == 'select')
            {
                $tpl = '<dl class="item">
                    <dt class="item-name"><label for="' . $name . '">' . $lang . ':</label>' . ($explain != '' ? '<br /><span>' . $explain . '</span>' : '') . '</dt>
                    <dd class="item-value"><select id="' . $key . '" name="' . $name . '">' . $return . '</select></dd>
                </dl>';
            } else
            {
                $tpl = $return;
            }

            break;

        case 'custom_text':

            $return = '';

            if (isset($vars['custom_text']))
            {
                $return = $vars['custom_text'];
            } else
            {
                break;
            }

            $tpl = $return;

            break;


        default:
            break;
    }

    if (isset($vars['append']))
    {
        $tpl .= $vars['append'];
    }

    return $tpl;
}

function getBuildAdmin($get_var = false, $current_value = '', $functions = false, $getHead = false)
{
    if (TYPE == 'WP')
    {
        $file = XML_PATH;
        $xml = simplexml_load_file($file) or die("Admin not loading...");
        if ($functions == true)
        {
            $fader = '';
        } else
        {
            $fader = array();
        }

        $i = 0;
        $n = 0;
        $fader = array();
        $fader_content = array();
        $pageId = 0;
        $faderId = 0;
        $tabId = 0;

        foreach ($xml->config->field as $key => $value)
        {

            if ($functions == true)
            {
                $patterns = 'xml_';
                $replacements = THEME_NAME;
                $var_change = str_replace($patterns, $replacements, $value['name']);
                //print_r($var_change);
                if ($value['type'] == 'list')
                {
                    if ($get_var != false && $get_var == $var_change)
                    {
                        $fader = '';
                        $build_function = '';
                        foreach ($value->option as $key => $value)
                        {
                            $fader .= '<option value="' . $value['value'] . '"' . (($current_value == $value['value']) ? ' selected="selected"' : '') . '>' . $value . '</option>';
                            $n++;
                        }
                    }
                }
            } else
            {
                if ($value['type'] != 'spacer')
                {

                    $patterns = 'xml_';
                    $replacements = THEME_NAME;
                    $var_change = str_replace($patterns, $replacements, $value['name']);
                    $upped = strtoupper($var_change);

                    $openClose = $value['name'];

                    $defualt = '';
                    $defualt = $value['default'];
                    $desc = '';
                    $desc = $value['description'];
                    $name = '';
                    $name = $value['label'];

                    if ($getHead == true)
                    {
                        if ($value['type'] == 'openFader')
                        {
                            $fader[$var_change] = array('lang' => $name, 'type' => 'headLi', 'id' => 'fader' . $pageId);

                        }
                        if ($value['type'] == 'closeFader')
                        {

                            $pageId++;
                            //print_r($fader_current);
                        }
                    } else
                    {
                        if ($value['type'] == 'openFader')
                        {
                            $fader[$var_change] = array('lang' => $name, 'type' => 'openFader', 'id' => 'fader' . $faderId);

                        }
                        if ($value['type'] == 'closeFader')
                        {
                            $fader[$var_change] = array('lang' => $name, 'type' => 'closeFader');

                        }
                        if ($value['type'] == 'openTab')
                        {
                            $id = str_replace(' ', '_', strtolower($name));
                            $fader[$var_change] = array('lang' => $name, 'type' => 'openTab', 'id' => $id);
                            $faderId++;
                        }
                        if ($value['type'] == 'closeTab')
                        {
                            $fader[$var_change] = array('lang' => $name, 'type' => 'closeTab');
                            $pageId++;

                        }

                        if ($value['type'] == 'text')
                        {
                            if (preg_match("/color/i", $value['label']))
                            {
                                $fader[$var_change] = array('lang' => $name, 'validate' => 'string', 'type' => 'text:6:6', 'explain' => $desc, 'default' => $defualt);
                            } /*elseif (preg_match("/width/i", $value['label']))
                            {
                                $fader[$var_change] = array('lang' => $name, 'validate' => 'string', 'type' => 'text:4:4', 'explain' => $desc, 'default' => $defualt);
                            } */else
                            {
                                $fader[$var_change] = array('lang' => $name, 'validate' => 'string', 'type' => 'text:29:255', 'explain' => $desc, 'default' => $defualt);
                            }
                        }
                        if ($value['type'] == 'list')
                        {
                            if (preg_match("/fixed_fluid/i", $var_change))
                            {
                                $fader[$var_change] = array('lang' => $name, 'validate' => 'string', 'type' => 'select', 'function' => 'vertex_body_type', 'params' => array('{KEY}'), 'explain' => $desc, 'default' => $defualt);
                            } elseif (preg_match("/s5_menu/i", $var_change))
                            {
                                $fader[$var_change] = array('lang' => $name, 'validate' => 'string', 'type' => 'select', 'function' => 'vertex_s5_menu', 'params' => array('{KEY}'), 'explain' => $desc, 'default' => $defualt);
                            } elseif (preg_match("/fonts/i", $var_change))
                            {
                                $fader[$var_change] = array('lang' => $name, 'validate' => 'string', 'type' => 'select', 'function' => 'vertex_fonts', 'params' => array('{KEY}'), 'explain' => $desc, 'default' => $defualt);
                            } else
                            {
                                $fader[$var_change] = array('lang' => $name, 'validate' => 'string', 'type' => 'select', 'function' => $var_change, 'params' => array('{KEY}'), 'explain' => $desc, 'default' => $defualt);
                            }
                        }
                        if ($value['type'] == 'radio')
                        {
                            $fader[$var_change] = array('lang' => $name, 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => $desc, 'default' => $defualt);
                        }

                        if ($value['type'] == 'fader_close')
                        {
                            $fader[$var_change] = array('lang' => $name, 'type' => 'fader_close', 'id' => 'fader' . $pageId);

                            $pageId++;
                            //print_r($fader_current);
                        }
                    }

                }
            }
            $i++;

        }

        return $fader;
    }
}

class vertex_admin
{
    function makeHeadTabs()
    {
        global $themename, $shortname, $options;

        $display_vars = array('vars' => getBuildAdmin(false, '', false, true));

        $templateBuild = '';
        $i = 0;
        $fader = "fader$i";
        //echo pp($display_vars);
        //print_r($display_vars);
        foreach ($display_vars['vars'] as $config_key => $vars)
        {
            if (!is_array($vars) && strpos($config_key, 'legend') === false)
            {
                continue;
            }

            $type = explode(':', $vars['type']);
            $l_explain = '';

            if ($vars['explain'])
            {
                $l_explain = (isset($vars['lang'])) ? $vars['explain'] : '';
            }
            if (!get_option($config_key))
            {
                $default = (isset($vars['default'])) ? $vars['default'] : '';
            } else {
                $default = get_option($config_key);
            }
            $templateBuild .= build_cfg_template($type, $config_key, $default, $config_key, $vars, isset($vars['lang']) ? $vars['lang'] : '', $l_explain);

            unset($display_vars['vars'][$config_key]);

            $i++;
        }
        return $templateBuild;
    }

    function display()
    {
        global $themename, $shortname, $options;

        $display_vars = array('vars' => getBuildAdmin());

        $this->new_config = $options;
        $cfg_array = array();
        $error = array();

        add_theme_page("S5 Theme Options", "S5 Theme Options", 'edit_themes', basename(__file__), 'mytheme_admin');

        $templateBuild = '';
        $i = 0;
        $fader = "fader$i";
        //echo pp($display_vars);
        //print_r($display_vars);
        foreach ($display_vars['vars'] as $config_key => $vars)
        {
            if (!is_array($vars))
            {
                continue;
            }

            $type = explode(':', $vars['type']);
            $l_explain = '';

            if ($vars['explain'])
            {
                $l_explain = (isset($vars['lang'])) ? $vars['explain'] : '';
            }

            if (!get_option($config_key))
            {
                $default = (isset($vars['default'])) ? $vars['default'] : '';
            } else {
                $default = get_option($config_key);
            }
            $templateBuild .= build_cfg_template($type, $config_key, $default, $config_key, $vars, isset($vars['lang']) ? $vars['lang'] : '', $l_explain);

            unset($display_vars['vars'][$config_key]);

            $i++;
        }
        return $templateBuild;
    }
}


?>