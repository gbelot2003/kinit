Bienvenidos a KumbiaPHP Framework 

Preparando la salida de la beta2.

Manual en construcción de la beta2: http://goo.gl/aPgvZ

Rápida introducción a lo nuevo de la beta2 (faltan por añadir): http://wiki.kumbiaphp.com/KumbiaPHP_Framework_Versi%C3%B3n_1.0_Beta2

CRUD en beta2: http://wiki.kumbiaphp.com/Beta2_CRUD_en_KumbiaPHP_Framework

API para usuarios de la beta2: http://www.kumbiaphp.com/api/beta2/

API para los desarrolladores del core: http://www.kumbiaphp.com/api/beta2-dev/
Seguimos trabajando para actualizar bien el phpdoc y tener actualizado el API.


http://www.kumbiaphp.com  Web oficial (pronto en KumbiaPHP)
http://wiki.kumbiaphp.com Wiki
http://foro.kumbiaphp.com Foro de KumbiaPHP
http://groups.google.com/group/kumbia/   Grupo de KumbiaPHP

Largo historial de repos durante estos años ;)
cvs(sf.net), svn(sf.net), bzr(launchpad.com) y ahora git(github.com)
-----------------------------------------------------------------------------------------------------------

KINIT

Configuración Inicial de Sitio

Sistema de login
-----------------
El sistema de login es el Auth estandar integrado en KumbiaPHP.
el sistema de login esta en controller/index_controller.php

Utilizamos ACL segun este link en la wiki de kumbiaPHP http://wiki.kumbiaphp.com/ACL_Configurado_a_Traves_de_un_Archivo_ini.

para tener un sistema de roles y permisos.

definimos las tablas de:
->usuarios
->rol

y detallamos implementación en archivo adjunto .sql

-----------------------------------------------------------------------------------------------

Plantilla basada en Bootstra de Twitter.
----------------------------------------
Directorio de archivos de Bootstrap

kinit/app/public/
-css
--bootstrap
---bootstrap.css
---bootstrap.min.css
---bootstrap-responsive.css
---bootstrap-responsive.min.css

-javascript
--bootstrap
---bootstrap.js
---bootstrap.min.js

-img
--glyphicons-halflings
--glyphicons-halflings-white
adjunto tree directorios de carpeta public.

Los diferentes template estan en : 
kinit/app/views/_shared/template/bootstrap/*

Modificamos el archivo:
core/extentions/helpers/flash.php para adaptarse a los mensajes de advertencia de Bootstrap.

----------------------------------------------------------------------------------------------------

Clases Globales y manejadores de template
-----------------------------------------

Estas son instanciadas en su mayoria en app_controller y admin_controller, estas deberian sobreescribirse en cada metodo del controller.

el * indicará el template donde se implementa, si es "-" es un partial.

$this->siteTitle -- define el <title /> en header.
	*bootstrapMain
	*bootstrapLogin

$this->title | NULL -- define el titulo de la pagina.
	*bootstrapMain


