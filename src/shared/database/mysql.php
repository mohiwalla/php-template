<?php

class DB
{
    private $con;
    /**
     * DB constructor.
     *
     * Initializes a new instance of the DB class, establishing a connection to the MySQL database
     * using the provided host, user, password, and database name. If the connection fails, the script exits
     * with an error message.
     *
     * @param string $host The hostname of the MySQL server.
     * @param string $user The username for the MySQL connection.
     * @param string $password The password for the MySQL connection.
     * @param string $database The name of the MySQL database to connect to.
     */
    public function __construct()
    {
        $this->con = new mysqli($_ENV["DB_HOST"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"], $_ENV["DB_NAME"]);

        if ($this->con->connect_error) {
            exit($this->con->connect_error);
        }

        # Set the character set to utf8mb4
        if (!$this->con->set_charset("utf8mb4")) {
            exit("Error loading character set utf8mb4: " . $this->con->error);
        }
    }

    /**
     * Executes a SQL query using a prepared statement with the given parameters.
     *
     * This function prepares and executes a SQL query using the MySQLi extension.
     * It handles binding the provided parameters to the query, executing it, and returning the result object.
     *
     * @param string $query The SQL query to be executed.
     * @param mixed ...$values The values for the query parameters for ? placeholders. **($arg1, $arg2, $arg3, ...)**
     *
     * @return mysqli_result|bool The result object if the query is successful, or false on failure.
     *
     * @throws RuntimeException If there is an error preparing or executing the statement, the function will output the error and terminate the script.
     */
    public function query(string $query, ...$values)
    {
        $stmt = $this->con->prepare($query);

        if (!$stmt) {
            exit($this->con->error);
        }

        if (!empty($values)) {
            $types = str_repeat("s", count($values));
            $stmt->bind_param($types, ...$values);
        }

        if (!$stmt->execute()) {
            exit($stmt->error);
        }

        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    /**
     * Executes a stored procedure with the given name and parameters.
     *
     * This function constructs a SQL query to call a stored procedure using placeholders for the parameters.
     * It then prepares and executes the query.
     *
     * @param string $name The name of the stored procedure to be executed.
     * @param mixed ...$values The values for the stored procedure parameters. **($arg1, $arg2, $arg3, ...)**
     *
     * @return mixed The result of the stored procedure.
     *
     * @throws RuntimeException If there is an error preparing or executing the stored procedure, it'd throw an error
     */
    public function procedure(string $name, ...$values)
    {
        $params = implode(',', array_fill(0, count($values), '?'));
        $query = "CALL $name($params)";

        $result = $this->query($query, ...$values);

        return $result;
    }

    /**
     * Fetches a single row from a MySQL result set.
     *
     * This method fetches a single row from a MySQL result set as an object.
     *
     * @param mysqli_result $result The result set returned from a MySQL query.
     *
     * @return array|null An object representing the row in the result set, or null if there are no more rows.
     */
    public function fetch($result, callable $callback = null)
    {
        $row = $result->fetch_object();

        if ($callback) {
            $row = $callback($row);
        }

        return $row;
    }

    /**
     * Fetches all rows from a MySQL result set and applies an optional callback to each row.
     *
     * This method iterates over the result set, fetches each row as an object, optionally applies
     * a user-defined callback to each row, and collects the rows in an array.
     *
     * @param mysqli_result $result The result set returned from a MySQL query.
     * @param callable|null $callback An optional callback function to apply to each row. The callback should
     *                                accept a single parameter, which is the row array, and return the modified row array.
     *
     * @return array An array of objects representing the rows in the result set. If the result set is empty
     *               or if the query failed, an empty array is returned.
     */
    public function fetchAll($result, callable $callback = null)
    {
        $data = [];

        if (!$result) {
            return $data;
        }

        while ($row = $result->fetch_object()) {
            if ($callback) {
                $row = $callback($row);
            }

            $data[] = $row;
        }

        $result->free_result();
        return $data;
    }

    public function __destruct()
    {
        $this->con->close();
    }
}
