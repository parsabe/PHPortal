<?php

function connectToDatabase($dbType, $host, $username, $password, $database = null, $port = null, $service_name = null) {
    try {
        switch ($dbType) {
            case 'mysql':
                $dsn = "mysql:host=$host;dbname=$database";
                break;
            case 'sqlsrv':
                $port = $port ? ",$port" : "";
                $dsn = "sqlsrv:Server=$host$port;Database=$database";
                break;
            case 'oracle':
                $tns = "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = $host)(PORT = $port))) (CONNECT_DATA = (SERVICE_NAME = $service_name)))";
                $dsn = "oci:dbname=$tns";
                break;
            default:
                throw new Exception("Unsupported database type: $dbType");
        }

        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}


class MySQLDatabase {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function select($table, $columns = '*', $condition = '', $params = []) {
        try {
            $query = "SELECT $columns FROM $table";
            if (!empty($condition)) {
                $query .= " WHERE $condition";
            }

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error during SELECT operation: " . $e->getMessage());
        }
    }

    public function insert($table, $data) {
        try {
            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));
            $query = "INSERT INTO $table ($columns) VALUES ($values)";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($data);

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error during INSERT operation: " . $e->getMessage());
        }
    }

    public function update($table, $data, $condition, $params = []) {
        try {
            $setValues = [];
            foreach ($data as $key => $value) {
                $setValues[] = "$key = :$key";
            }

            $setValues = implode(', ', $setValues);
            $query = "UPDATE $table SET $setValues WHERE $condition";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array_merge($data, $params));

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Error during UPDATE operation: " . $e->getMessage());
        }
    }

    public function delete($table, $condition, $params = []) {
        try {
            $query = "DELETE FROM $table WHERE $condition";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Error during DELETE operation: " . $e->getMessage());
        }
    }
}

class SQLServerDatabase {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function select($table, $columns = '*', $condition = '', $params = []) {
        try {
            $query = "SELECT $columns FROM $table";
            if (!empty($condition)) {
                $query .= " WHERE $condition";
            }

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error during SELECT operation: " . $e->getMessage());
        }
    }

    public function insert($table, $data) {
        try {
            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));
            $query = "INSERT INTO $table ($columns) VALUES ($values)";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($data);

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error during INSERT operation: " . $e->getMessage());
        }
    }

    public function update($table, $data, $condition, $params = []) {
        try {
            $setValues = [];
            foreach ($data as $key => $value) {
                $setValues[] = "$key = :$key";
            }

            $setValues = implode(', ', $setValues);
            $query = "UPDATE $table SET $setValues WHERE $condition";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array_merge($data, $params));

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Error during UPDATE operation: " . $e->getMessage());
        }
    }

    public function delete($table, $condition, $params = []) {
        try {
            $query = "DELETE FROM $table WHERE $condition";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Error during DELETE operation: " . $e->getMessage());
        }
    }
}

class OracleDatabase {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function select($table, $columns = '*', $condition = '', $params = []) {
        try {
            $query = "SELECT $columns FROM $table";
            if (!empty($condition)) {
                $query .= " WHERE $condition";
            }

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error during SELECT operation: " . $e->getMessage());
        }
    }

    public function insert($table, $data) {
        try {
            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));
            $query = "INSERT INTO $table ($columns) VALUES ($values)";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($data);

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error during INSERT operation: " . $e->getMessage());
        }
    }

    public function update($table, $data, $condition, $params = []) {
        try {
            $setValues = [];
            foreach ($data as $key => $value) {
                $setValues[] = "$key = :$key";
            }

            $setValues = implode(', ', $setValues);
            $query = "UPDATE $table SET $setValues WHERE $condition";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array_merge($data, $params));

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Error during UPDATE operation: " . $e->getMessage());
        }
    }

    public function delete($table, $condition, $params = []) {
        try {
            $query = "DELETE FROM $table WHERE $condition";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Error during DELETE operation: " . $e->getMessage());
        }
    }
}






?>