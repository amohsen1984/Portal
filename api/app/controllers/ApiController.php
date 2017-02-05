<?php

define('DEFAULT_LIMIT', 300);
define('MAX_NO_RECORDS', 300);

class ApiController extends Controller {

    public function __construct() {

        try {

            //credential array
            $this->credential = array();

            //read i_customer
            if (isset($_SERVER['HTTP_CUSTOMER']) & !empty($_SERVER['HTTP_CUSTOMER']))
                $this->credential['i_customer'] = $_SERVER['HTTP_CUSTOMER'];

            //read login
            if (isset($_SERVER['HTTP_LOGIN']) && !empty($_SERVER['HTTP_LOGIN']))
                $this->credential['login'] = $_SERVER['HTTP_LOGIN'];

            //read password
            if (isset($_SERVER['HTTP_PASSWORD']) && !empty($_SERVER['HTTP_PASSWORD']))
                $this->credential['password'] = $_SERVER['HTTP_PASSWORD'];

            //if theere is a missing parameter returns 403
            if (count($this->credential) < 3) {
                header('HTTP/1.0 403 Forbidden');
                die('2Unauthorized Access.');
            }

            //Authenticate the user
            $data_object = DB::select("select * from api_users where login = ? AND password = ? and i_api_user in (select i_api_user from api_users_customers where i_customer = ?)", [$this->credential['login'], $this->credential['password'], $this->credential['i_customer']]);

            //if no matching user return 403 and exit
            if (!count($data_object)) {

                header('HTTP/1.0 403 Forbidden');
                die('1Unauthorized Access.');
            }
        } catch (Exception $e) {

            //return an error
            header('HTTP/1.0 500 Forbidden');
            die(json_encode(array('Error' => $e->getMessage())));
        }
    }

    public function GetObject($object, $id) {

        try {

            //validate the object name
            if ($this->ValidateObject($object) === false) {

                //the object is not supported, we need to rteurn 403
            }

            //the primary key field name
            $primary_key = "i_" . strtolower($object);

            // the table name
            $table = $this->get_table_name($object);

            //check left joints
            $sql = $this->get_sql($table, $primary_key);

            //and 
            $sql .= " where $table.$primary_key = ? AND $table.i_customer = ?";

            //run the query
            $data_object = DB::select($sql, [$id, $this->credential['i_customer']]);


            $output = $this->format_output($data_object, $primary_key);

            //return the data
            return $output;
        } catch (Exception $e) {

            //return an error
            header('HTTP/1.0 500 Forbidden');
            return array('Error' => $e->getMessage());
        }
    }

    public function AddObject($object) {

        try {

            //validate the object name
            if ($this->ValidateObject($object) === false) {

                //the object is not supported, we need to rteurn 403
            }


            // the table name
            $table = $this->get_table_name($object);

            //read the raw data
            $request_body = file_get_contents('php://input');

            //decode json data
            $data = json_decode($request_body, 1);

            //reading each field sent in the request
            $values = array('1');
            $fields = array('i_customer');
            $parameters = array("?");
            foreach ($data as $field => $value) {

                $fields[] = $field;
                $values[] = $value;
                $parameters[] = "?";
            }

            //we need to stringify the paramerters array to add it to the sql insert statement 
            $parameters_string = '(' . implode(',', $parameters) . ')';

            //we need to stringify the fields array to add it to the sql insert statement 
            $fields_string = '(' . implode(',', $fields) . ')';

            //run the sql insert statement
            $id = DB::insert("insert into $table $fields_string values $parameters_string", $values);


            //return the data
            return $id;
        } catch (Exception $e) {

            //return an error
            header('HTTP/1.0 500 Forbidden');
            return array('Error3' => $e->getMessage());
        }
    }

    public function UpdateObject($object, $id) {

        try {

            //validate the object name
            if ($this->ValidateObject($object) === false) {

                //the object is not supported, we need to rteurn 403
            }

            // the table name
            $table = $this->get_table_name($object);

            $pk = "i_" . strtolower($object);

            //read the raw data
            $request_body = file_get_contents('php://input');

            //decode json data
            $data = json_decode($request_body, 1);

            //reading each field sent in the request
            $values = array();
            $fields = array();
            $parameters = array();
            foreach ($data as $field => $value) {

                $fields[] = $field . "='?'";
                $values[] = $value;
            }

            //Add i_cutomer
            $values[] = $this->credential['i_customer'];

            //Add object id
            $values[] = $id;

            //we need to stringify the paramerters array to add it to the sql insert statement 
            $parameters_string = implode(',', $fields);

            //run the sql insert statement
            $data_object = DB::update("update $table SET  $parameters_string where i_customer='?' AND $pk='?'", $values);

            //return the data
            return array();
        } catch (Exception $e) {
            //return an error
            header('HTTP/1.0 500 Forbidden');
            return array('Error' => $e->getMessage());
        }
    }

    public function DelObject($object, $id) {

        //validate the object name
        if ($this->ValidateObject($object) === false) {

            //the object is not supported, we need to rteurn 403
        }

        //the primary key field name
        $primary_key = "i_" . strtolower($object);

        // the table name
        $table = $this->get_table_name($object);

        //run the query
        $data_object = DB::delete("DELETE from $table where $primary_key = ? AND i_customer = ?", [$id, $this->credential['i_customer']]);

        //return the data
        return $data_object;
    }

    public function GetListCount($object) {
        try {

            //the primary key field name
            $primary_key = "i_" . strtolower($object);

            //table name
            $table = $this->get_table_name($object);

//validate the object name
            if ($this->ValidateObject($object) === false) {

                //the object is not supported, we need to rteurn 404
            }

            //Get query string
            $condition = '';
            $values = array();
            $offset = 0;
            $limit = DEFAULT_LIMIT;
            $and = '';
            foreach ($_GET as $key => $val) {
                if (!preg_match('/\./', $key))
                    $key = "$table.$key";
                $condition .= $and . $this->GetCondition($key, $val);
                $and = ' AND ';
            }


            //add i_customer condition
            $condition .= $and . " $table.i_customer = '" . $this->credential['i_customer'] . "'";

            //get sql
            $sql = $this->get_sql($table, $primary_key);

            //add condition
            $sql .= " where $condition ";

            //run the query
            $output = DB::select($sql, $values);

            //return the data
            return $output;
        } catch (Exception $e) {

            //return an error
            header('HTTP/1.0 500 Forbidden');
            return array('Error2' => $e->getMessage());
        }
    }

    public function GetList($object) {
        try {
            //the primary key field name
            $primary_key = "i_" . strtolower($object);

            //table name
            $table = $this->get_table_name($object);

//validate the object name
            if ($this->ValidateObject($object) === false) {

                //the object is not supported, we need to rteurn 404
            }

            //Get query string
            $condition = '';
            $values = array();
            $offset = 0;
            $limit = DEFAULT_LIMIT;
            $and = '';
            foreach ($_GET as $key => $val) {

                if ($key == 'offset') {
                    $offset = $val;
                } elseif ($key == 'limit') {
                    $limit = $val;
                } else {
                    if (!preg_match('/\./', $key))
                        $key = "$table.$key";
    
                    $condition .= $and . $this->GetCondition($key, $val);
                    $and = ' AND ';
                }
            }
 
            //if number of records is > max, we nee to return an error
            if ($limit > MAX_NO_RECORDS) {
                
            }

            //add i_customer condition
            $condition .= $and . " $table.i_customer = '" . $this->credential['i_customer'] . "'";

            // build pagination part
            $pagination = "Limit $limit Offset $offset";

            $sql = $this->get_sql($table, $primary_key);

            //add condition
            $sql .= " where $condition $pagination";
            


            //run the query
            $data_object = DB::select($sql, $values);

            //format data
            $output = array();
            if(count($data_object))
                $output = $this->format_output($data_object, $primary_key);

            //return the data
            return $output;
        } catch (Exception $e) {

            //return an error
            header('HTTP/1.0 500 Forbidden');
            return array('Error2' => $e->getMessage());
        }
    }

    private function GetCondition($field_name, $value) {

        $match = array();

        //check whether it looks like contain(some value)
        if (preg_match('/^contain\((.*)\)$/i', $value, $match)) {

            $pattern = trim($match[1]);
            return "$field_name like '%$pattern%'";
        }

        //check whether it looks like between($min, $max)
        elseif (preg_match('/^between\((.*),(.*)\)$/i', $value, $match)) {

            $min = trim($match[1]);
            $max = trim($match[2]);

            return "$field_name >= $min AND $field_name <= $max ";
        }

        //check whether it looks like between($min, $max)
        elseif (preg_match('/^period\((.*),(.*)\)$/i', $value, $match)) {

            $min = trim($match[1]);
            $max = trim($match[2]);

            return "$field_name between $min AND  $max ";
        }

        //check whether it looks like greater_than($min)
        elseif (preg_match('/^greater_than\((.*)\)$/i', $value, $match)) {

            $min = trim($match[1]);
            return "$field_name > $min";
        }

        //check whether it looks like less_than($min)
        elseif (preg_match('/^less_than\((.*)\)$/i', $value, $match)) {

            $max = trim($match[1]);
            return "$field_name < $max";
        } else {

            return "$field_name = '$value'";
        }
    }

    private function ValidateObject($object) {

        return true;
    }

    private function get_table_name($object) {


        if (preg_match('/y$/i', $object))
            $string = preg_replace('/y$/', 'ies', $object);
        else {
            $string = $object . "s";
        }

        return ucfirst($string);
    }

    private function get_sql($table, $primary_key, $mode = 'list') {

        $joints = array(
            'Properties' => array(
                'direct' => array(
                    array('table' => 'Sellers', 'pk' => 'i_seller'),
                ),
                'indirect' => array(
                    array('table' => 'Users', 'pk' => 'i_user', 'joint_table' => 'AgentProperties')
                )
            ),
        );


        $main_sql = "Select $table.* ";
        $joints_part = "";

        //left joints
        if (isset($joints[$table]) && count($joints[$table]['direct'])) {

            foreach ($joints[$table]['direct'] as $joint) {

                $sec_table = $joint['table'];
                $pk = $joint['pk'];
                $main_sql .= ", '#$sec_table#', $sec_table.*";
                $joints_part .= " LEFT JOIN $sec_table ON $table.$pk=$sec_table.$pk ";
            }
        }

        //left joints
        if (isset($joints[$table]) && count($joints[$table]['indirect'])) {

            foreach ($joints[$table]['indirect'] as $joint) {

                $sec_table = $joint['table'];
                $joint_table = $joint['joint_table'];
                $pk = $joint['pk'];

                $main_sql .= ", '#$sec_table#', $sec_table.*";

                $joints_part .= " LEFT JOIN $joint_table ON $table.$primary_key = $joint_table.$primary_key ";
                $joints_part .= " LEFT JOIN $sec_table ON  $joint_table.$pk= $sec_table.$pk ";
            }
        }

        if ($mode == 'count')
            $main_sql = "Select count(*)";

        return $main_sql . " FROM $table " . $joints_part;
    }

    private function format_output($data_object, $primary_key) {

        foreach ($data_object as $item) {
            $main = true;
            $item = (array) $item;
            $index = $item[$primary_key];
            $composite_key = '';
            $composite_index = 0;

            if (!isset($output[$index]))
                $output[$index] = array();

            foreach ($item as $field => $value) {

                if (preg_match('/#/', $field)) {
                    $composite_key = preg_replace('/#/', '', $field);
                    $composite_index = isset($output[$index][$composite_key]) ? count($output[$index][$composite_key]) : 0;
                    $main = false;
                    continue;
                }

                if ($main)
                    $output[$index][$field] = $value;
                elseif (isset($value))
                    $output[$index][$composite_key][$composite_index][$field] = $value;
            }
        }
        return $output;
    }

}
