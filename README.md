# PHPortal - A Simple Database Abstraction Library in PHP
<img src='https://github.com/parsabe/PHPortal/blob/main/logo.png'>
PHPortal is a lightweight PHP library that provides a simple and consistent interface for working with various database systems, including MySQL, SQL Server, and Oracle. With PHPortal, you can easily connect to different databases and perform common database operations such as SELECT, INSERT, UPDATE, and DELETE in a unified way.

## Features

- Supports multiple database types: MySQL, SQL Server, and Oracle.
- Provides a consistent API for connecting to and interacting with databases.
- Handles database connection errors gracefully.
- Supports common database operations: SELECT, INSERT, UPDATE, DELETE.

## Getting Started

To get started with PHPortal, follow these steps:

1. Clone the PHPortal repository to your local machine.

   ```bash
   git clone https://github.com/your-username/PHPortal.git
   ```


2. Include the `PHPortal.php` file in your PHP project.

   ```php
   require_once 'path/to/PHPortal.php';
   ```

3. Initialize a database connection using the `connectToDatabase` function.

   ```php
   // Example for connecting to a MySQL database
   $dbType = 'mysql';
   $host = 'localhost';
   $username = 'your_username';
   $password = 'your_password';
   $database = 'your_database';

   try {
       $pdo = connectToDatabase($dbType, $host, $username, $password, $database);
       // You now have a PDO object for database interactions.
   } catch (Exception $e) {
       die("Connection failed: " . $e->getMessage());
   }
   ```

4. Create an instance of the appropriate database class (e.g., `MySQLDatabase`, `SQLServerDatabase`, or `OracleDatabase`) using the PDO object.

   ```php
   // Example for creating a MySQLDatabase instance
   $database = new MySQLDatabase($pdo);
   ```

5. Start using PHPortal to perform database operations.

   ```php
   // Example: Select data from a table
   $result = $database->select('users', 'username, email', 'age > :age', [':age' => 18]);

   // Example: Insert data into a table
   $data = ['username' => 'new_user', 'email' => 'new_user@example.com'];
   $insertedId = $database->insert('users', $data);

   // Example: Update data in a table
   $data = ['email' => 'updated_email@example.com'];
   $affectedRows = $database->update('users', $data, 'username = :username', [':username' => 'new_user']);

   // Example: Delete data from a table
   $deletedRows = $database->delete('users', 'age < :age', [':age' => 18]);
   ```

6. Enjoy a consistent and easy-to-use database interface with PHPortal!

## Supported Database Types

PHPortal currently supports the following database types:

- MySQL
- SQL Server
- Oracle

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contributing

Contributions to PHPortal are welcome! Feel free to submit issues, feature requests, or pull requests to help improve this library.

## Acknowledgments

- Thanks to the PHP community for creating and maintaining the PDO extension, making it easier to work with different databases in PHP.

Feel free to customize this README to include more specific details about your project and any additional information that might be relevant to your users.


