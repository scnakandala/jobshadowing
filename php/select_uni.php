<?php
include_once './config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['university'] != '-1' && $fbuser) {
        $url = $userInfo['id'];
        $name = $userInfo['name'];
        $org = $_POST['university'];
        if (updateStudentInfo($name, $org, $url)) {
            $_SESSION['LOGGED_IN'] = true;
            header('Location: ./');
            die();
        }
    }
} else {
    if ($fbuser && checkStudentExists($userInfo['id'])) {
        $_SESSION['LOGGED_IN'] = true;
        header('Location: ./');
        die();
    } else if (!$fbuser) {
        header('Location: ./');
        die();
    }
}
?>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        
    <link rel="stylesheet" type="text/css" href="./webroot/css/index.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <body class="home-page">
        <div id="select-uni">
            <h2>Please Select Your University</h2>
            <form id="select-uni" action="./select_uni.php" method="POST">
                <select name="university">
                    <option selected="true" value="-1">---Please Select University---</option>
                    <?php
                    $universities = getUniversities();
                    foreach ($universities as $university) {
                        print '<option value="' . $university->id . '">'
                                . $university->name
                                . '</option>';
                    }
                    ?>
                </select
                <br/>
                <input type='submit' value='Submit'>
            </form>
        </div>

        <!--js scripts------->
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script>
        <script type="text/javascript" src="./webroot/js/selectUni.js"></script>

    </body>
</html>
