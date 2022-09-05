# PHP-SQL-Functions
Configure lib.php 

Edit: 

`
$GLOBALS['conn'] = mysqli_connect(
    'servername',
    'serveruser',
    'serverpassword',
    'db'
);
`

`sqlwrapper($sql, $paramtypes, $params, $results)`

Convert SQL result variables to PHP global variables 

        sqlwrapper(
            "SELECT `variable` FROM `table` WHERE `var` = ?",
            "s",
            array(&$variable),     //params array
            array(&$output)        //objects in the array
        );

Usage: 

`gettablenum($sql, $paramtypes, $params)`

Gets the number of rows from a table

ex: 

   ` if (
        gettablenum(
            "SELECT * FROM table WHERE var = ?",
            "s",
            array(&$_SESSION['var'])
        ) == 1
    ) {
    `
