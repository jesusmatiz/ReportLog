<?php
/**
 * Created by Jesús Matiz
 * 21/01/2019
 */

/**
 * Import the connection file to the database
 */
require_once 'Connection.php';

/**
 * Use example
 *
 *  try {
 *      throw new \Exception('Error message to show');
 *  } catch (\Exception $exception) {
 *      $report = new ReportLog();
 *      $report->error($exception);
 *  }
 */

class ReportLog
{

    /**
     * @var string
     */
    private static $type_error;
    /**
     * @var \Exception
     */
    private static $exception;
    /**
     * @var Connection
     */
    private static $connection;
    /**
     * @var Connection
     */
    private static $conn;

    function __construct() {
        self::$conn = new Connection();
        self::$connection = self::$conn->getConection();
    }

    function __destruct() {
        self::$conn->close();
    }

    /**
     * @param Exception $exception
     */
    public static function emergency(\Exception $exception) {
        self::$type_error = 'EMERGENCY';
        self::$exception = $exception;
        self::saveException();
    }

    /**
     * @param Exception $exception
     */
    public static function alert(\Exception $exception) {
        self::$type_error = 'ALERT';
        self::$exception = $exception;
        self::saveException();
    }

    /**
     * @param Exception $exception
     */
    public static function critical(\Exception $exception) {
        self::$type_error = 'CRITICAL';
        self::$exception = $exception;
        self::saveException();
    }

    /**
     * @param Exception $exception
     */
    public static function error(\Exception $exception) {
        self::$type_error = 'ERROR';
        self::$exception = $exception;
        self::saveException();
    }

    /**
     * @param Exception $exception
     */
    public static function warning(\Exception $exception) {
        self::$type_error = 'WARNING';
        self::$exception = $exception;
        self::saveException();
    }

    /**
     * @param Exception $exception
     */
    public static function notice(\Exception $exception) {
        self::$type_error = 'NOTICE';
        self::$exception = $exception;
        self::saveException();
    }

    /**
     * @param Exception $exception
     */
    public static function info(\Exception $exception) {
        self::$type_error = 'INFO';
        self::$exception = $exception;
        self::saveException();
    }

    /**
     * @param Exception $exception
     */
    public static function debug(\Exception $exception) {
        self::$type_error = 'DEBUG';
        self::$exception = $exception;
        self::saveException();
    }

    /**
     * Saves the exception to a file or database
     */
    private static function saveException() {
        if (Connection::useDB()) {
            self::saveInDB();
        } else {
            self::saveInFile();
        }
    }

    /**
     * The error data is saved in a plain text file
     */
    private static function saveInFile() {
        try {

            $path = './storage';
            $filename = $path . '/' .'logs_' . date('Y-m-d') . '.txt';

            if (!file_exists($path) && !mkdir($path, 755, true) && !is_dir($path)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
            }

            if ($f = fopen($filename, 'a')) {
                fwrite($f, '[' . self::$type_error . ']: ' . date('H:m:s') . ', ' . self::$exception . "\n");
                fclose($f);
            }

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

    }

    /**
     * The error data is saved in a database table
     */
    private static function saveInDB() {
        try {

            $query = 'INSERT INTO report_logs(type_error, message, file, trace, line) VALUES ("' . self::$type_error . '", "' . self::$exception->getMessage() . '","' . self::$exception->getFile() . '","' . self::$exception->getTraceAsString() . '","' . self::$exception->getLine() . '")';

            self::$conn->execSQL($query);

        } catch (\Exception $exception) {
            try {
                throw new \Exception($exception->getMessage());
            } catch (\Exception $e) {
                self::error($e);
            }
        }
    }

}