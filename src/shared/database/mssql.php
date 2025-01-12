<?php

class DB
{
    public $con;

    public function __construct()
    {
        $serverName = $_ENV["DB_HOST"];

        $connectionOptions = [
            "Database" => $_ENV["DB_NAME"],
            "UID" => $_ENV["DB_USER"],
            "PWD" => $_ENV["DB_PASSWORD"],
        ];

        $this->con = sqlsrv_connect($serverName, $connectionOptions);

        if ($this->con === false) {
            exit(print_r(sqlsrv_errors(), true));
        }
    }

    /**
     * Executes a SQL query using a prepared statement with the given parameters.
     *
     * @param string $query The SQL query to be executed.
     * @param mixed ...$values The values for the query parameters for ? placeholders. **($arg1, $arg2, $arg3, ...)**
     *
     * @return mixed The result object if the query is successful, or false on failure.
     */
    public function query(string $query, ...$values)
    {
        $options = [
            "Scrollable" => SQLSRV_CURSOR_STATIC,
        ];

        $stmt = sqlsrv_prepare($this->con, $query, $values, $options);

        if ($stmt === false) {
            exit(print_r(sqlsrv_errors(), true));
        }

        if (!sqlsrv_execute($stmt)) {
            exit(print_r(sqlsrv_errors(), true));
        }

        return $stmt;
    }

    /**
     * Executes a stored procedure with the given name and parameters.
     *
     * @param string $name The name of the stored procedure to be executed.
     * @param mixed ...$values The values for the stored procedure parameters. **($arg1, $arg2, $arg3, ...)**
     *
     * @return mixed The result of the stored procedure.
     */
    public function procedure(string $name, ...$values)
    {
        $params = implode(',', array_fill(0, count($values), '?'));
        $query = "{CALL $name($params)}";

        $result = $this->query($query, ...$values);

        return $result;
    }

    /**
     * Fetches a single row from a SQL Server result set and applies an optional callback to the row.
     *
     * @param resource $result The result set returned from a SQL Server query.
     * @param callable|null $callback An optional callback function to apply to the row.
     *
     * @return mixed An associative array representing the row in the result set.
     */
    public function fetch($result, ?callable $callback = null)
    {
        $row = sqlsrv_fetch_object($result);

        if ($callback) {
            $row = $callback($row);
        }

        return $row;
    }

    /**
     * Fetches all rows from a SQL Server result set and applies an optional callback to each row.
     *
     * @param resource $result The result set returned from a SQL Server query.
     * @param callable|null $callback An optional callback function to apply to each row.
     *
     * @return array An array of associative arrays representing the rows in the result set.
     */
    public function fetchAll($result, ?callable $callback = null)
    {
        $data = [];

        if (!$result) {
            return $data;
        }

        while ($row = sqlsrv_fetch_object($result)) {
            if ($callback) {
                $row = $callback($row);
            }

            $data[] = $row;
        }

        return $data;
    }

    public function __destruct()
    {
        sqlsrv_close($this->con);
    }
}
