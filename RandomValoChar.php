<?php
    $name = "";

function RandomChar(){
    $jsonData = file_get_contents('json/agents.json');
    $json = json_decode($jsonData,true);
    $NrAgents = count($json['agents']);
    $rand = rand(1,$NrAgents);


    foreach($json['agents'] as $agent){
        if($rand == $agent['nr']){
            return $agent['name'];
        }
    }

}
if(isset($_GET['button'])){
    $name = RandomChar();
}

?>

<!doctype html>
<html lang="<?php echo $html_lang ?>">
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

<h1 class="text-center"><?php if($name != null) echo $name?></h1>

<form method="get">
    <button class="btn btn-primary" type="submit" name="button">Generate</button>
</form>
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