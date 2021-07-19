<?php 

    /**
     * Abstract Class
     * use to get and set database connection parameters
     * server name , database name , username , password
     */
    abstract class Database_settings
    {

        /**
         * private Member
         * server_name
         */
        private static string $_server_name = 'localhost';
        
        /**
         * private Member
         * db_name
         */
        private static string $_db_name = 'my_app_01';

        /**
         * private Member
         * user_name
         */
        private static string $_user_name = 'root';

        /**
         * private Member
         * password
         */
        private static string $_password = '';

        /**
         * Getters
         */

        public static function getServername()
        {
            return self::$_server_name;
        }

        public static function getDatabaseName()
        {
            return self::$_db_name;
        }

        public static function getUsername()
        {
            return self::$_user_name;
        }

        public static function getPassword()
        {
            return self::$_password;
        }

        /**
         * Setters
         */
        public static function setServername($servername){
            self::$_server_name = $servername;
        }

        public static function setDatabaseName($dbname)
        {
            self::$_db_name = $dbname;
        }

        public static function setUsername($username)
        {
            self::$_user_name = $username;
        }

        public static function setPassword($password)
        {
            self::$_password = $password;
        }
    }