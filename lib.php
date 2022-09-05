<?php
$GLOBALS['conn'] = mysqli_connect(
    'servername',
    'serveruser',
    'serverpassword',
    'db'
);
function gettablenum($sql, $paramtypes, $params)
{
    $stmt = $GLOBALS['conn']->prepare($sql);
    $stmt->bind_param($paramtypes, ...$params);
    if ($stmt->execute()) {
        $stmt->store_result();
        $int = $stmt->num_rows;
        $stmt->close();
        return $int;
    }
}
function sqlwrapper($sql, $paramtypes, $params, $results)
{
    //Input:
    //sql: plain sql stmt to be executed.
    //paramtypes: string with bind param datatypes.
    //params: params to execute.
    //results: names of variables to bind to the results to.
    //Output: set globals.
    $stmt = $GLOBALS['conn']->prepare($sql);
    //The splat op is not in the manual, the usage guide can be found here
    $stmt->bind_param($paramtypes, ...$params);
    $stmt->execute();
    $stmt->store_result();
    //splat results to bind param
    $stmt->bind_result(...$results);
    while ($stmt->fetch()) {
        if (!empty($results)) {
            foreach ($results as $result) {
                //hardlink (ref) as $result and set for each as global
                //Null Coalescing Operator set to empty for bug fix of key objects warning
                $result = $GLOBALS[$result] ?? '';
            }
        } else {
            return false;
        }
    }
    // Set global for profile template view to check if user is active
}