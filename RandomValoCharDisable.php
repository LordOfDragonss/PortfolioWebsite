<?php
$name = "";
$icon_src = "";
$disabledNumbers = $_GET['number'] ?? [];.

function cycleImagesOnGenerate() {
    // Select all agent icon images
    var agentImages = document.querySelectorAll('.agent-icon img');

    // Array of image sources you want to cycle through for each agent
    // (You can add more sources as needed for each agent)
    const imageSources = [
        "path/to/first-image.jpg",
        "path/to/second-image.jpg",
        "path/to/third-image.jpg"
        // Add more image paths for cycling...
    ];

    // Cycle through each agent image
    agentImages.forEach(function(image) {
        // Get the current image index, cycle to the next one (with wrap around)
        let currentIndex = imageSources.indexOf(image.src);
        let nextIndex = (currentIndex + 1) % imageSources.length; // Wrap around using modulus

        // Change the image source to the next one
        image.src = imageSources[nextIndex];

        // Optional: Add a fade-out/in effect when changing the image
        image.style.opacity = 0;
        setTimeout(function() {
            image.style.opacity = 1; // Fade-in after changing
        }, 500); // Wait for the fade-out to complete before fade-in
    });
}

function RandomChar(){

    cycleImagesOnGenerate();
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
    <script>
        function setAgentsDisabled() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        }
        function setAgentsEnabled() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
        function setAgentsDisabledByRole(className) {
            // Get all checkboxes
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            // Loop through checkboxes
            checkboxes.forEach(function(checkbox) {
                // Get the value of the checkbox
                var checkboxValue = parseInt(checkbox.value);

                // Get the Role of the agent associated with the checkbox
                var checkboxRole = checkbox.dataset.role;

                // Check if the Role matches the desired className
                if (checkboxRole === className) {
                    // If it does, check the checkbox
                    checkbox.checked = true;
                }
            });
            if(className == 'Sentinel'){
                document.getElementById('SentinelButton').textContent = 'Enable Sentinels';
                document.getElementById('SentinelButton').setAttribute('onclick', "setAgentsEnabledByRole('Sentinel')");
            }
            if(className == 'Controller'){
                document.getElementById('ControllerButton').textContent = 'Enable Controllers';
                document.getElementById('ControllerButton').setAttribute('onclick', "setAgentsEnabledByRole('Controller')");
            }
            if(className == 'Duelist'){
                document.getElementById('DuelistButton').textContent = 'Enable Duelists';
                document.getElementById('DuelistButton').setAttribute('onclick', "setAgentsEnabledByRole('Duelist')");
            }
            if(className == 'Initiator'){
                document.getElementById('InitiatorButton').textContent = 'Enable Initiators';
                document.getElementById('InitiatorButton').setAttribute('onclick', "setAgentsEnabledByRole('Initiator')");
            }
        }
        function setAgentsEnabledByRole(className) {
            // Get all checkboxes
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');

            // Loop through checkboxes
            checkboxes.forEach(function(checkbox) {
                // Get the value of the checkbox
                var checkboxValue = parseInt(checkbox.value);

                // Get the Role of the agent associated with the checkbox
                var checkboxRole = checkbox.dataset.role;

                // Check if the Role matches the desired className
                if (checkboxRole === className) {
                    // If it does, check the checkbox
                    checkbox.checked = false;
                }
            });
            if(className == 'Sentinel'){
                document.getElementById('SentinelButton').textContent = 'Disable Sentinels';
                document.getElementById('SentinelButton').setAttribute('onclick', "setAgentsDisabledByRole('Sentinel')");
            }
            if(className == 'Controller'){
                document.getElementById('ControllerButton').textContent = 'Disable Controllers';
                document.getElementById('ControllerButton').setAttribute('onclick', "setAgentsDisabledByRole('Controller')");
            }
            if(className == 'Duelist'){
                document.getElementById('DuelistButton').textContent = 'Disable Duelists';
                document.getElementById('DuelistButton').setAttribute('onclick', "setAgentsDisabledByRole('Duelist')");
            }
            if(className == 'Initiator'){
                document.getElementById('InitiatorButton').textContent = 'Disable Initiators';
                document.getElementById('InitiatorButton').setAttribute('onclick', "setAgentsDisabledByRole('Initiator')");
            }
        }
    </script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/agentselectstyle.css" rel="stylesheet" />
</head>
<body>
<div class="container">
<form method="get">
<h1 class="text-center py-4"><?php echo $name; ?><img class="img-fluid selected-agent" src="<?php echo $icon_src; ?>" alt="Character Icon" /></h1>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 text-center">
            <button class="btn btn-primary" type="submit" name="generate">Generate</button>
        </div>
        <div class="col-3"></div>
    </div>
    <div class="character-list">
    <div class="row py-3">
        <div class="col-3">
        <h2>Disable agents:</h2>
        </div>
        <div class="col-9 text-right">
        <button class="btn btn-primary" onclick="setAgentsDisabled()">Check all</button>
        <button class="btn btn-primary" onclick="setAgentsEnabled()">UnCheck all</button>
        </div>
    </div>
    <div class="row character-list">
        <div class="col-12">
        <?php
                $jsonData = file_get_contents('json/agents.json');
                $agents = json_decode($jsonData, true)['agents'];
                foreach ($agents as $agent) {
                    if (in_array($agent['nr'], $GLOBALS['disabledNumbers'])) {
                        echo '<input type="checkbox" id="' . $agent['nr'] . '" name="' . $agent['name'] . '" value="' . $agent['nr'] . '" data-role="' . $agent['role'] . '" checked>';
                        echo '<label for="' . $agent['nr'] . '" class="agent-icon">
                                <img class="img-fluid" src="' . $agent['icon_src'] . '" alt="Character Icon" />
                            </label>';
                    } else {
                        echo '<input type="checkbox" id="' . $agent['nr'] . '" name="' . $agent['name'] . '" value="' . $agent['nr'] . '" data-role="' . $agent['role'] . '">';
                        echo '<label for="' . $agent['nr'] . '" class="agent-icon">
                                <img class="img-fluid" src="' . $agent['icon_src'] . '" alt="Character Icon" />
                            </label>';
                    }
                }
        ?>

                <!-- Submit -->
        </div>
        </form>
    </div>
            </div>
    <div class="row py-5">
        <div class="col-12">
        <h2> Special Filters</h2>
            <button class="btn btn-primary" id="SentinelButton" onclick="setAgentsDisabledByRole('Sentinel')">Disable Sentinels</button>
            <button class="btn btn-primary" id="ControllerButton" onclick="setAgentsDisabledByRole('Controller')">Disable Controllers</button>
            <button class="btn btn-primary" id="DuelistButton" onclick="setAgentsDisabledByRole('Duelist')">Disable Duelists</button>
            <button class="btn btn-primary" id="InitiatorButton" onclick="setAgentsDisabledByRole('Initiator')">Disable Initiators</button>
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
