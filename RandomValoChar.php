<?php
    $name = "";
    $icon_src = "";

function RandomChar(){
    $jsonData = file_get_contents('json/agents.json');
    $json = json_decode($jsonData,true);
    $NrAgents = count($json['agents']);
    $rand = rand(1,$NrAgents);
    foreach($json['agents'] as $agent){
        if($rand == $agent['nr']){
            $GLOBALS['name'] = $agent['name'];
            $GLOBALS['icon_src'] = $agent['icon_src'];
            return $agent;
        }
    }


}
if(isset($_GET['button'])){
   RandomChar();
}

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Mike Tool" />
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
    <div class="container">
        <div class="row">
            <h1 class="text-center"><img class="img-fluid " src="<?php echo $icon_src ?>" alt="..." /><?php if($name != null) echo $name?></h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 text-center">
                <form method="get">
                <button class="btn btn-primary" type="submit" name="button">Generate</button>
                </form>
            </div>
            <div class="col-3"></div>
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