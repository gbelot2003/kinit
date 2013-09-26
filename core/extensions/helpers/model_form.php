<?php
/**
 * KumbiaPHP web & app Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://wiki.kumbiaphp.com/Licencia
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@kumbiaphp.com so we can send you a copy immediately.
 *
 * @copyright  Copyright (c) 2005-2012 KumbiaPHP Team (http://www.kumbiaphp.com)
 * @license    http://wiki.kumbiaphp.com/Licencia     New BSD License
 */

/**
 * Helper para crear Formularios de un modelo automáticamente
 *
 * @category   KumbiaPHP
 * @package    Helpers
 */
class ModelForm
{

    /**
     * Genera un form de un modelo (objeto) automáticamente
     *
     * @var object 
     */
    public static function create($model, $action = NULL)
    {

        $model_name = Util::smallcase(get_class($model));
        if (!$action)
            $action = ltrim(Router::get('route'), '/');

        echo '<form action="', PUBLIC_PATH . $action, '" method="post" id="', $model_name, '" class="scaffold form-horizontal">' . PHP_EOL;
        
        echo "<div class=\"modal-header\">". PHP_EOL;
        echo "<a class=\"close\" data-dismiss=\"modal\">&times;</a>". PHP_EOL;
        echo "<h3>$model_name</h3>". PHP_EOL;
        echo "</div>". PHP_EOL;

        $pk = $model->primary_key[0];
        echo "<div class=\"modal-body\">". PHP_EOL;
        echo " <fieldset>" . PHP_EOL;
        echo '<input id="', $model_name, '_', $pk, '" name="', $model_name, '[', $pk, ']" class="id" value="', $model->$pk . '" type="hidden">' . PHP_EOL;

        $fields = array_diff($model->fields, $model->_at, $model->_in, $model->primary_key);

        foreach ($fields as $field) {

            $tipo = trim(preg_replace('/(\(.*\))/', '', $model->_data_type[$field])); //TODO: recoger tamaño y otros valores
            $alias = $model->get_alias($field);
            $formId = $model_name . '_' . $field;
            $formName = $model_name . '[' . $field . ']';

            if (in_array($field, $model->not_null)) {
                echo "<div class='control-group'>". PHP_EOL;
                echo "<label for=\"$formId\" class=\"required control-label\">$alias *</label>" . PHP_EOL;
            } else
                echo "<label class='control-label' for=\"$formId\">$alias</label>" . PHP_EOL;

            switch ($tipo) {
                case 'tinyint': case 'smallint': case 'mediumint':
                case 'integer': case 'int': case 'bigint':
                case 'float': case 'double': case 'precision':
                case 'real': case 'decimal': case 'numeric':
                case 'year': case 'day': case 'int unsigned': // Números

                    if (strripos($field, '_id', -3)) {
                        echo "<div class='controls'>";
                        echo Form::dbSelect($model_name . '.' . $field, NULL, NULL, 'Seleccione', NULL, $model->$field);
                        echo "</div>";
                        echo "</div>";
                        break;
                    } else {
                        echo "<div class='controls'>". PHP_EOL;
                        echo "<input id=\"$formId\" type=\"number\" name=\"$formName\" value=\"{$model->$field}\">" . PHP_EOL;
                        echo "</div>". PHP_EOL;
                        echo "</div>". PHP_EOL;
                        break;
                    }

                case 'date': // Usar el js de datetime
                    echo "<div class='controls'>". PHP_EOL;
                    echo "<input id=\"$formId\" type=\"date\" name=\"$formName\" value=\"{$model->$field}\">" . PHP_EOL;
                    echo "</div>". PHP_EOL;
                    echo "</div>". PHP_EOL;
                    break;
                case 'datetime': case 'timestamp':
                    echo "<div class='controls'>". PHP_EOL;
                    echo "<input id=\"$formId\" type=\"datetime\" name=\"$formName\" value=\"{$model->$field}\">" . PHP_EOL;
                    echo "</div>". PHP_EOL;
                    echo "</div>". PHP_EOL;
                    //echo '<script type="text/javascript" src="/javascript/kumbia/jscalendar/calendar.js"></script>
                    //<script type="text/javascript" src="/javascript/kumbia/jscalendar/calendar-setup.js"></script>
                    //<script type="text/javascript" src="/javascript/kumbia/jscalendar/calendar-es.js"></script>'.PHP_EOL;
                    //echo date_field_tag("$formId");
                    break;

                case 'enum': case 'set': case 'bool':
                    // Intentar usar select y lo mismo para los field_id
                    echo "<div class='controls'>". PHP_EOL;
                    echo "<input id=\"$formId\" class=\"select\" name=\"$formName\" type=\"text\" value=\"{$model->$field}\">" . PHP_EOL;
                    echo "</div>". PHP_EOL;
                    echo "</div>". PHP_EOL;

                    break;

                case 'text': case 'mediumtext': case 'longtext':
                case 'blob': case 'mediumblob': case 'longblob': // Usar textarea
                    echo "<div class='controls'>". PHP_EOL;
                    echo "<textarea id=\"$formId\" name=\"$formName\">{$model->$field}</textarea>" . PHP_EOL;
                    echo "</div>". PHP_EOL;
                    echo "</div>". PHP_EOL;
                    break;

                default: //text,tinytext,varchar, char,etc se comprobara su tamaño
                    echo "<div class='controls'>". PHP_EOL;
                    echo "<input id=\"$formId\" type=\"text\" name=\"$formName\" value=\"{$model->$field}\">" . PHP_EOL;
                    echo "</div>". PHP_EOL;
                    echo "</div>". PHP_EOL;
                //break;
            }
        }
        //echo radio_field_tag("actuacion", array("U" => "una", "D" => "dos", "N" => "Nada"), "value: N");
        echo  "</fieldset>". PHP_EOL; 
        echo "</div>". PHP_EOL; // modal Body

        echo "<div class=\"modal-footer\">". PHP_EOL;
        echo '<input type="submit" value="Enviar" class="btn btn-primary" />' . PHP_EOL;
        echo '<a class="btn" data-dismiss="modal">Close</a>';
        echo "</div>". PHP_EOL; // modal Body 
       
        echo '</form>' . PHP_EOL;
    }

}
