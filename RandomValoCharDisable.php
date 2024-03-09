<?php
$name = "";
$icon_src = "";
$disabledNumbers = $_GET['number'] ?? [];

function RandomChar(){
    global $disabledNumbers; // Declare $disabledNumbers as global
    $jsonData = file_get_contents('json/agents.json');
    $json = json_decode($jsonData, true);

    $NrAgents = count($json['agents']);
    $rand = rand(1,$NrAgents);

    $enabledAgents = array_diff(range(1, $NrAgents), $disabledNumbers);

    if (empty($enabledAgents)) {
        // Handle the case where all agents are disabled
        return null; // Or you can return false, throw an exception, etc.
    }
    while(in_array($rand, $GLOBALS['disabledNumbers'])){
        $rand = rand(1,$NrAgents);
    }
    foreach($json['agents'] as $agent){
        if($rand == $agent['nr']){
            $GLOBALS['name'] = $agent['name'];
            $GLOBALS['icon_src'] = $agent['icon_src'];
            return $agent;
        }
    }
}

if(isset($_GET['generate'])){
    RandomChar();
 }

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="MikeTool" />
    <title>Random Character generator</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>

<h1 class="text-center"><?php echo $name; ?><img class="img-fluid" src="<?php echo $icon_src; ?>" alt="Character Icon" /></h1>
    <div class="row">
        <div class="col-12">
            <h3>Disable agents:</h3>
            <form method="get">
            <?php
                $jsonData = file_get_contents('json/agents.json');
                $agents = json_decode($jsonData, true)['agents'];
                foreach ($agents as $agent) {
                    if(in_array($agent['nr'], $GLOBALS['disabledNumbers'])) {
                    echo '<label><img class="img-fluid" src="' . $agent['icon_src'] . '" alt="Character Icon" /><input type="checkbox" name="number[]" value="' . $agent['nr'] . '" checked></label>';
                    }else{
                        echo '<label><img class="img-fluid" src="' . $agent['icon_src'] . '" alt="Character Icon" /><input type="checkbox" name="number[]" value="' . $agent['nr'] . '"></label>';
                    }
                }               
                
                ?>
                <!-- Submit -->
                <button class="btn btn-primary" type="submit" name="generate">Generate</button>
            </form>
        </div>
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>
