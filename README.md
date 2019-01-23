# ReportLog
#### *Versión en Español*

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

## Intalación por NPM

Para instalar como paquete desde npm ejecute el siguiente comando.
<pre>
npm i @jesusmatiz/reportlog
</pre>

## Requerimientos

* PHP >= 5.6

#### *Version in English*

ReportLog captures the error and stores it in a plain text file  ".txt " or also allows it to be stored in a database table, depending on the configuration.

## Configuring the storage Type

To configure the storage type, you must modify the following line in the <code>Connection.php</code> file.
<pre>
private static $useDB = false; Switch to True If you are using the database
</pre>

## .txt storage

If you want to store the data in a text file  <code>".txt"</code> You must set the following variable to false.

<pre>
private static $useDB = false;
</pre>

When you set log storage to the file <code>.txt</code>, will create a directory with the name of storage and within this will create files named <code>log_2019-01-21.txt</code>, where the date changes according to the day of the error, so you can identify much faster.

### Log storage path in .txt

Log storage is located in the <code>storage</code> directory, which will be created the first time an error is generated, as long as the variable <code>$useDB</code> is set to false;

## Database storage

To store the data to a database table you must run the <code>create_report_logs_table.sql</code> script in your database.

When you import the <code>create_report_logs_table.sql</code> file, you create a table with the required fields for error storage.

If you want to store the data in a table in the database, you must set the following variable to true.

<pre>
private static $useDB = true;
</pre>

You must also configure the credentials for the database connection in the following variables.

<pre>
private static $HOST = 'localhost';
private static $PORT = 3306;
private static $DB = 'DATABASE'; // Database Name
private static $USER = 'USERNAME'; // Database username
private static $PASS = 'PASSWORD'; // Database Password
</pre>

The report_logs table has the following fields:

<pre>
id (Error ID)
type_error (Error type)
message (Message error)
trace (Error propagation trace)
file (end error propagation file)
line (line of code close to the error)
</pre>

##Importing the connection

Import the Connection file

<pre>
require_once 'Connection.php';
</pre>

Create a private variable for the ReportLog

<code>private $reportLog;</code>

Initialize the REPORTLOG variable with a new instance.

<pre>
function _construct() {
    $this->reportLog = new ReportLog();
}
</pre>

To save the log you must set in a try-catch

<pre>
try
    code block that can generate an error
} catch (Exception $e) {
    We capture the error
    $this-> ReportLog-> error ($E);
}
</pre>

## Types of error logs

You can use the following error logs, as needed.

<pre>
$this->reportLog->emergency ($exception);
$this->reportLog->alert ($exception);
$this->reportLog->critical ($exception);
$this->reportLog->error ($exception);
$this->reportLog->warning ($exception);
$this->reportLog->notice ($exception);
$this->reportLog->info ($exception);
$this->reportLog->debug ($exception);
</pre>

## Installation by NPM

To install as a package from NPM run the following command.

<code>npm I @jesusmatiz/reportlog</code>

## Requirements

* PHP >= 5.6
