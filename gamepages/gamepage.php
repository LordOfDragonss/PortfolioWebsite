<?php
	if(isset($_GET['lang']))
		$lang = $_GET['lang'];
	else
		$lang = 'en';
		
	switch ($lang) {
		case 'fr':
			$html_lang = "fr";
			
			// Domaines : catégories et promos
			$categories_text = "Netim propose près de 1 000 extensions géographiques (ccTLDs) et génériques (gTLDs).";
			$categories_text_btn = "Trouvez le nom<br />de domaine idéal";
			$categories_url = "https://www.netim.com/fr/nom-domaine/liste-des-extensions";

			// Promotions
			$promos_text = "Netim propose régulièrement des promotions sur les noms de domaine. Certaines extensions sont à 1€ HT<br />la première année.";
			$promos_text_btn = "Découvrir l'ensemble<br />de nos promotions";
			$promos_url = "https://www.netim.com/fr/nom-domaine/promotions";
			
			// Découverte des offres d'hébergement
			$hosting_text = "Site personnel, institutionnel ou marchand, choisissez l’offre correspondant à vos projets.";
			$hosting_text_btn = "Découvrir nos offres d'hébergement";
			$hosting_url = "https://www.netim.com/fr/hebergement/web";
			
			// Signaler un abus
			$report_txt = "Signaler un abus";
			$report_url = "https://www.netim.com/fr/reporter-abus";
			
			// Menu footer
			$li1 = "Netim.com";
			$li2 = "Enregistrer un nom de domaine";
			$li3 = "Transférer un nom de domaine";
			$li4 = "Hébergement web";
			$li5 = "Certificats SSL / HTTPS";
			$li6 = "E-mails";
			$li7 = "Blog";
			$li8 = "Support";
			$li9 = "Espace client";
			
			$li1_url = "https://www.netim.com/fr/";
			$li2_url = "https://www.netim.com/fr/nom-domaine/enregistrement";
			$li3_url = "https://www.netim.com/fr/nom-domaine/transfert";
			$li4_url = "https://www.netim.com/fr/hebergement/web";
			$li5_url = "https://www.netim.com/fr/certificats-ssl";
			$li6_url = "https://www.netim.com/fr/hebergement/email";
			$li7_url = "https://blog.netim.com/fr/";
			$li8_url = "https://support.netim.com/fr/";
			$li9_url = "https://www.netim.fr/direct/";
			
			$titre = 'Ce site est hébergé par Netim';
			
			break;
				
		default:
			$html_lang = "en";
			
			// Domaines : catégories et promos
			$categories_text = "Netim offers nearly 1,000 geographical (ccTLDs) and generic (gTLDs) extensions.";
			$categories_text_btn = "Find the perfect<br />domain name";
			$categories_url = "https://www.netim.com/en/domain-name/extensions-list";
			
			// Promotions
			$promos_text = "Netim regularly offer discounts on domain names. Some extension start at $1.50 excl.tax for the first year.";
			$promos_text_btn = "Discover all of<br />our special offers";
			$promos_url = "https://www.netim.com/en/domain-name/special-offers";
			
			// Découverte des offres d'hébergement
			$hosting_text = "Whether your website is personal, professional or an online store, you will find the perfect offer for your projects!";
			$hosting_text_btn = "Discover our web<br />hosting plans";
			$hosting_url = "https://www.netim.com/en/hosting/web";
			
			// Signaler un abus
			$report_txt = "Report abuse";
			$report_url = "https://www.netim.com/en/report-abuse";
			
			// Menu footer
			$li1 = "Netim.com";
			$li2 = "Register a domain";
			$li3 = "Transfer a domain";
			$li4 = "Web Hosting";
			$li5 = "SSL/HTTPS certificates";
			$li6 = "Emails";
			$li7 = "Blog";
			$li8 = "Support";
			$li9 = "Customer center";
			
			$li1_url = "https://www.netim.com/en/";
			$li2_url = "https://www.netim.com/en/domain-name/registration";
			$li3_url = "https://www.netim.com/en/domain-name/transfer";
			$li4_url = "https://www.netim.com/en/hosting/web";
			$li5_url = "https://www.netim.com/en/ssl-certificates";
			$li6_url = "https://www.netim.com/en/hosting/email";
			$li7_url = "https://blog.netim.com/en/";
			$li8_url = "https://support.netim.com/en/";
			$li9_url = "https://www.netim.com/direct/";
			
			$titre = 'This website is hosted by Netim';
			
			break;
	}


?>

<?php
include("../header.php");
?>
<?php
include("../header.php");

$pagenull = false;

function formatTitle($title) {
    // Replace underscores with spaces
    $title = str_replace('_', ' ', $title);
    // Capitalize the first letter of each word
    $title = ucwords($title);
    // Optionally, if you want the first letter to be lowercase, you can use lcfirst()
    return $title;
}

$nextPage = $_GET['nextPage'] ?? null;
$nextPagePath = $_SERVER['DOCUMENT_ROOT'] . "/gamepages/$nextPage.php"; // Absolute path based on document root

if ($nextPage && file_exists($nextPagePath)) {
    // If nextPage exists, redirect to the page
    $title = formatTitle($nextPage);
    header("Location: /gamepages/$nextPage.php");
} else {
    // If nextPage doesn't exist, set a flag for "under construction" message
    if ($nextPage) {
        $title = formatTitle($nextPage);
    }
    $pagenull = false;
}

?>

<body id="page-top" class = "bg-dark">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="/index.php">Home</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>
    <div class="container">
        <h1><?= $title ?></h1>
</div>
<div class="row py-3 gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-white mb-4"><?= $title ?></h2>
                    <?php if ($pagenull): ?>
                    <p class="text-white-50">
                        The info for this game is currently under development.
                    </p>
                    
                </div>
            </div>
            <?php endif; ?>
            
</body>