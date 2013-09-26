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
 * Flash Es la clase standard para enviar advertencias,
 * informacion y errores a la pantalla
 *
 * @category   Kumbia
 * @package    Flash
 * @copyright  Copyright (c) 2005-2012 Kumbia Team (http://www.kumbiaphp.com)
 * @license    http://wiki.kumbiaphp.com/Licencia     New BSD License
 */

/**
 * Clase para enviar mensajes a la vista
 *
 * Envio de mensajes de advertencia, éxito, información
 * y errores a la vista.
 * Tambien envia mensajes en la consola, si se usa desde consola.
 *
 * @category   Kumbia
 * @package    Flash
 */

/**
* Modificaciones de Core
* Modificamos esta capeta para adaptarse a los mensajes de advertencia de Bootstrap
**/
class Flash
{

    /**
     * Visualiza un mensaje flash
     *
     * @param string $name  Para tipo de mensaje y para CSS class='$name'.
     * @param string $text  Mensaje a mostrar
     */
    public static function show($name, $text)
    {
        if (isset($_SERVER['SERVER_SOFTWARE'])) {
            echo '<div class="', $name, ' flash">', $text, '</div>', PHP_EOL;
        } else {
            echo $name, ': ', strip_tags($text), PHP_EOL;
        }
    }

    /**
     * Visualiza un mensaje de error
     *
     * @param string $text
     */
    public static function error($text)
    {
        $btn = "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
        $btn .= "<h4>Error !!</h4>";
        $btn .= $text;
        return self::show('alert  alert-block alert-error', $btn);
    }

    /**
     * Visualiza un mensaje de advertencia en pantalla
     *
     * @param string $text
     */
    public static function warning($text)
    {
        $btn = "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
        $btn .= "<h4>Advetencia !!</h4>";
        $btn .= $text;
        return self::show('alert alert-block alert-success', $btn);
    }

    /**
     * Visualiza informacion en pantalla
     *
     * @param string $text
     */
    public static function info($text)
    {
        $btn = "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
        $btn .= "<h4>Atencion !!</h4>";
        $btn .= $text;
        return self::show('alert alert-info  alert-block', $btn);
    }

    /**
     * Visualiza informacion de suceso correcto en pantalla
     *
     * @param string $text
     */
    public static function valid($text)
    {
        $btn = "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
        $btn .= "<h4>Todo Correcto !!</h4>";
        $btn .= $text;
        return self::show('alert alert-success alert-block', $btn);
    }

    /**
     * Visualiza informacion en pantalla
     *
     * @param string $text
     *
     * @deprecated  ahora Flah::info()
     */
    public static function notice($text)
    {
        $btn = "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
        $btn .= $text;
        return self::show('alert alert-block  alert-block', $btn);
    }

    /**
     * Visualiza informacion de Suceso en pantalla
     *
     * @param string $text
     *
     * @deprecated  ahora Flash::valid()
     */
    public static function success($text)
    {
        $btn  = "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
        $btn .= "<h4>Accion Completada !!</h4>";
        $btn .= $text;
        return self::show('alert alert-success  alert-block', $btn);
    }

}