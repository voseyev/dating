<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//require the autoload file
require_once('vendor/autoload.php');

//create an instance of the base class
$f3 = Base::instance();

$f3->set('states', array('Washington', 'Oregon', 'Idaho'));

//define a default route
$f3->route('GET /', function() {
    $view = new View();
    echo $view->render('pages/home.html');
}
);

$f3->route('GET|POST /personal', function(){
    $template = new Template();
    echo $template->render('pages/personal.html');
});

$f3->route('GET|POST /profile', function($f3) {
    $template = new Template();
    if(isset($_POST['submit'])) {
        $first = $_SESSION['first_name'] = $_POST['first_name'];
        $last = $_SESSION['last_name'] = $_POST['last_name'];
        $age = $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $phone = $_SESSION['phone'] = $_POST['phone'];
        $f3->set('first_name', $_SESSION['first_name']);
        $f3->set('last_name', $_SESSION['last_name']);
        $f3->set('age', $_SESSION['age']);
        $f3->set('gender', $_SESSION['gender']);
        $f3->set('phone', $_SESSION['phone']);
        include('model/validation.php');
        $isValid = true;
        if (!validName($first)) {
            $f3->set('invalidFirst', "invalid");
            $isValid  = false;
        }
        if (!validName($last)) {
            $f3->set('invalidLast', "invalid");
            $isValid = false;
        }
        if (!validAge($age)) {
            $f3->set('invalidAge', "invalid");
            $isValid = false;
        }
        if (!validPhone($phone)) {
            $f3->set('invalidPhone', "invalid");
            $isValid = false;
        }
        if ($isValid) {
            echo $template->render('pages/profile.html');
        } else {
            echo $template->render('pages/personal.html');
        }
    } else {
        echo $template->render('pages/personal.html');
    }
});

$f3->route('GET|POST /interests', function($f3){
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['bio'] = $_POST['bio'];
    $_SESSION['seeking'] = $_POST['seeking'];
    $f3->set('email', $_SESSION['email']);
    $f3->set('seeking', $_SESSION['seeking']);
    $f3->set('state', $_SESSION['state']);
    $f3->set('bio', $_SESSION['bio']);
    $template = new Template();
    echo $template->render('pages/interests.html');
});

$f3->route('GET|POST /summary', function($f3){
    $template = new Template();
    if(isset($_POST['submit'])) {
        $_SESSION['indoors'] = $_POST['indoors'];
        $_SESSION['outdoors'] = $_POST['outdoors'];
        $f3->set('first_name', $_SESSION['first_name']);
        $f3->set('last_name', $_SESSION['last_name']);
        $f3->set('age', $_SESSION['age']);
        $f3->set('gender', $_SESSION['gender']);
        $f3->set('phone', $_SESSION['phone']);
        $f3->set('email', $_SESSION['email']);
        $f3->set('seeking', $_SESSION['seeking']);
        $f3->set('state', $_SESSION['state']);
        $f3->set('bio', $_SESSION['bio']);
        $f3->set('indoors', $_SESSION['indoors']);
        $f3->set('outdoors', $_SESSION['outdoors']);
        echo $template->render('pages/summary.html');
    }
});

$f3->run();

?>