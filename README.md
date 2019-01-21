# ReportLog
ReportLog captura el error y lo almacena en un archivo de texto plano ".txt" o tambien permite almacenarlo en una tabla de la base de datos, según la configuración.

## Configurando el tipo de almacenamiento
Para configurar el tipo de almacenamiento, debe modificar la siguiente linea en el archivo <code>Connection.php</code>.

<pre>
private static $useDB = false; // Switch to True if you are using the database
</pre>

## Almacenamiento en .txt
Si desea almacenar los datos en un archivo de texto ".txt" debe establecer la siguiente variable en false.
<pre>
private static $useDB = false;
</pre>

Al establecer el almacenamiento de log en el archivo .txt, se creara un directorio con el nombre de <code>storage</code> y dentro de este se crearan archivos con el nombre <code>log_2019-01-21.txt</code>, donde la fecha cambia según el dia del error, para asi poder identificarlo mucho mas rapido.

#### Rutade almacenamiento del log en .txt
El almacenamiento de los logs se encuentran en el directorio <code>storage</code>, el cual sera creado la primera vez que se genere un error, siempre y cuando la variable <code>$useDB</code> este en false;

## Almacenamiento en base de datos
Para almacenar los datos a una tabla de la base de datos debera ejecutar el script <code>create_report_logs_table.sql</code> en su base de datos.

Al importar el archivo <code>create_report_logs_table.sql</code>, se creara una tabla con los campos necesarios para el almacenamiento de los errores.

Si desea almacenar los datos en una tabla de la base datos debe establecer la siguiente variable en true.
<pre>
private static $useDB = true;
</pre>

Ademas debera configurar las credenciales para la conexión de la base de datos en las siguientes variables.

<pre>
private static $HOST = 'localhost';
private static $PORT = 3306;
private static $DB = 'DATABASE'; // Database name
private static $USER = 'USERNAME'; // Database username
private static $PASS = 'PASSWORD'; // Database password
</pre>

La tabla <code>report_logs</code> tiene los siguientes campos:

* id (ID del error)
* type_error (Tipo de error)
* message (Mensaje de error)
* trace (Traza de propagación del error)
* file (Archivo final de propagación del error)
* line (Linea de codigo cercano al error)

## Importación de la conexión
Importe el archivo de conexión 

<pre>
require_once 'Connection.php';
</pre>

Cree una variable privada para el ReportLog
<pre> 
private $reportLog;
</pre>
Inicialize la variable del reportLog con una nueva instancia.
<pre>
function __construct() {
    $this->reportLog = new ReportLog();
}
</pre>

Para guardar el log debera establecer en un try-catch

<pre>
try {
    // Bloque de codigo que puede generar un error
} catch (\Exception $e) {
    // Capturamos el error
    $this->reportLog->error($e);
}
</pre>

## Tipos de logs de errores

Podrá usar los siguientes logs de errores, según la necesidad.

<pre>
$this->reportLog->emergency($exception);
$this->reportLog->alert($exception);
$this->reportLog->critical($exception);
$this->reportLog->error($exception);
$this->reportLog->warning($exception);
$this->reportLog->notice($exception);
$this->reportLog->info($exception);
$this->reportLog->debug($exception);
</pre>
