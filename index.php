
<?php
// Include configuration file
$config = include('config.php');

// Get requested page from URL query parameter, default to 'home'
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

if ($page == 'reglog') {
    include('pages/reglog.php');
    
    exit;
}




// Check if the requested page exists in the configuration
if (array_key_exists($page, $config)) {
    include('partials/header.php');
    // Include the requested page
    include($config[$page]);

    // Include the footer
include('partials/footer.php');


} else {
    // Page not found, redirect to 404 or display an error message
    // For example:
    header("HTTP/1.0 404 Not Found");
    echo "Page not found!";
}


?>
