<?php 

    /**
     * Include Database_Settings class
     * Use database parameters
     */
    require_once(ROOT . 'config/database_settings.php');

    /**
     * Abstract class Model
     * class to interact with database 
     * using API PDO with mySQL as DBMS
     */
    abstract class Model
    {
        /**
         * private Member
         * connection
         */
        private $_connection = null;

        /** 
         * protected Member
         * table
        */
        protected $_table;

        /**
         * Function to openConnection to database
         */
        protected function openConnection()
        {
            try
            {
                $this->_connection = new PDO('mysql:host=' . Database_Settings::getServername() . ';dbname=' . Database_Settings::getDatabaseName() . ';charset=utf8', Database_Settings::getUsername(), Database_Settings::getPassword());

                $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch(PDOException $exception){
                echo $exception->getMessage();
            }

        }

        /**
         * Functions to form SQL requests
         */
        protected function insertData(string $table, array $columns, array $values)
        {
            $sql = 'INSERT INTO ' . $table . '(';
            $compteur = 1;
            foreach($columns as $column)
            {
                $sql .= $column;
                if($compteur < count($columns))
                {
                    $sql .= ', ';
                    $compteur ++;
                }
            }
            $sql .= ') VALUES(';
            $compteur = 1;
            foreach($values as $value)
            {
                $sql .= $value;
                if($compteur < count($values))
                {
                    $sql .= ', ';
                    $compteur ++;
                }
            }
            $sql .= ')';
            return $sql;
        }

        protected function updateData(string $table,$oldvalue ,$newValue)
        {
            $sql = 'UPDATE TABLE ' . $table .' SET ' . $oldvalue . '=' . $newValue;
            return $sql;
        }

        protected function deleteData(string $table)
        {
            $sql = 'DELETE FROM ' . $table;
            return $sql;
        }

        protected function selectData(string $table, array $columns = ['*'], bool $distinct = false)
        {
            $sql = 'SELECT ';
            $sql .= ($distinct == true) ? ' DISTINCT ' : '';
            $compteur = 1; 
            foreach($columns as $column)
            {
                $sql .= $column;
                if($compteur < count($columns)){
                    $sql .= ', ';
                    $compteur ++;
                }
            }
            $sql .= ' FROM ' . $table;
            return $sql;
        }

        protected function whereCondition(string $condition)
        {
            $sql = ' WHERE ' . $condition;
            return $sql;
        }

        protected function innerJoin(string $table1,string $table2, $common_column)
        {
            $sql = ' INNER JOIN ' . $table2 . ' ON ' . $table1 . '.' . $common_column . '=' . $table2 . '.' . $common_column;
            return $sql;
        }

        protected function leftJoin(string $table1,string $table2 , $common_column1, $common_column2)
        {
            $sql = ' LEFT JOIN ' . $table2 . ' ON ' . $table1 . '.' . $common_column1 . '=' . $table2 . '.' . $common_column2;
            return $sql;
        }

        protected function rightJoin(string $table1,string $table2 , $common_column1, $common_column2)
        {
            $sql = ' RIGHT JOIN ' . $table2 . ' ON ' . $table1 . '.' . $common_column1 . '=' . $table2 . '.' . $common_column2;
            return $sql;
        }
        
        protected function orderBy($columns, $order = 'DESC')
        {   
            $sql = ' ORDER BY ';
            $compteur = 1;
            foreach($columns as $column)
            {
                $sql .= $column;
                if($compteur < count($columns))
                {
                    $sql .= ', ';
                    $compteur ++;
                }
            }
            $sql .= ' ' . $order;
            return $sql;
        }

        protected function limitedOffset($limit, $offset)
        {
            $sql = 'LIMIT ' . $limit . ' OFFSET ' . $offset;
            return $sql;
        }

        /**
         * Function to execute query 
         */
        protected function executeQuery($sql, array $params = array())
        {
            try
            {
                $statement = $this->_connection->prepare($sql);
                if(!empty($params))
                {
                    $compteur = 1;
                    foreach($params as $param)
                    {
                        $statement->bindValue($compteur, $param);
                        $compteur ++;
                    }
                }
                $statement->execute();
                if(empty($params))
                {
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                }
            }catch(PDOException $exception)
            {
                echo $exception->getMessage();  
            }
        }

        /**
         * Function to close connection from database
         */
        protected function closeConnection()
        {
            $this->_connection = null;
        }
    }