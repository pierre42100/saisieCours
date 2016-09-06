<?php
/**
 *	Fonctions de gestion de la génération de PDF
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

/**
 *	Fonction de gestion automatique de TCPDF
 *	Est nécessaire pour utiliser le service
 */
function includeTCPDF(){
	//Liste des emplacements possibles de tcPDF
	$tcpdf_include_dirs = array(
		realpath('../tcpdf.php'), 
		'/usr/share/php/tcpdf/tcpdf.php', 
		'/usr/share/tcpdf/tcpdf.php', 
		'/usr/share/php-tcpdf/tcpdf.php', 
		'/var/www/tcpdf/tcpdf.php', 
		'/var/www/html/tcpdf/tcpdf.php', 
		'/usr/local/apache2/htdocs/tcpdf/tcpdf.php',
		path_3rdparty_relative("tcpdf/tcpdf.php")
	);

	//Recherche d'un emplacement positif
	foreach ($tcpdf_include_dirs as $tcpdf_include_path) {
		if (@file_exists($tcpdf_include_path)) {
			require_once($tcpdf_include_path);
			return;
		}
	}
}

/**
 *	Fonction de génération d'un PDF à partir de code HTML
 *
 *	@param 	String 	The HTML source code
 *	@param 	String 	The name of the PDF
 */
function generatePDFfromHTML($html, $PDFname){
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// Définition des informations sur le document
	$pdf->SetCreator(getSiteName());
	$pdf->SetAuthor('Pierre HUBERT');
	$pdf->SetTitle($PDFname);


	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(10);

	// Suppression de l'en-tête et du pied de page
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, 5);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// ---------------------------------------------------------

	// set font
	$pdf->SetFont('helvetica', '', 10);

	// add a page
	$pdf->AddPage();

	// output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');

	// ---------------------------------------------------------

	//Récupération du contenu du PDF
	$pdf->Output($PDFname, 'I');
}