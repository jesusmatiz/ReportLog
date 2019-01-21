<?php
/**
 * Created by Jesús Matiz
 * 21/01/2019
 */

class Connection
{

    /**
     * Database connection variables
     */
    private static $HOST = 'localhost';
    private static $PORT = 3306;
    private static $DB = 'sga'; // Database name
    private static $USER = 'root'; // Database username
    private static $PASS = ''; // Database password
    private static $conn;
    private static $useDB = true; // Switch to True if you are using the database


    /**
     * Establishes the connection to the database
     * @return bool|mysqli
     */
    public static function getConection() {
        try {
            if (self::useDB()) {
                self::$conn = new \mysqli(self::$HOST, self::$USER, self::$PASS, self::$DB, self::$PORT);
                return self::$conn;
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Closes the connection to the database
     */
    public function close() {
        try {
            if (self::useDB()) {
                \mysqli_close(self::$conn);
            }
        } catch (\Exception $exception) {
            echo $exception->getTraceAsString();
        }
    }

    /**
     * Run the query to save the data to the database
     * @param string $query
     * @return bool
     */
    public function execSQL(string $query) {
        try {
            if (self::useDB()) {
                return self::$conn->query($query) === true;
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Returns TRUE or FALSE for database usage
     * @return bool
     */
    public static function useDB() {
        return self::$useDB;
    }

}