 <?php
 
    // database connection

    // development architecture

    $config['localhost']['host'] = "localhost";
    $config['localhost']['user'] = "root";
    $config['localhost']['passwd'] = "";
    $config['localhost']['db_name'] = "noleggioveicoli_tdw";
    
    // deployment architecture 

    $config['sql.example.com']['host'] = "localhost";
    $config['sql.example.com']['user'] = "root";
    $config['sql.example.com']['passwd'] = "";
    $config['sql.example.com']['db_name'] = "noleggioveicoli_tdw";

    $conn = new mysqli(
        $config[$_SERVER["SERVER_NAME"]]['host'],
        $config[$_SERVER["SERVER_NAME"]]['user'],
        $config[$_SERVER["SERVER_NAME"]]['passwd'],
        $config[$_SERVER["SERVER_NAME"]]['db_name']
    );

    if (!$conn) {
        die('conection error');
    }

?>