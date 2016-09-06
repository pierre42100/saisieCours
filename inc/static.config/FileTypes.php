<?php
/**
 * Liste de types de fichiers
 *
 * @author Pierre HUBERT
 */
$fileTypesList = array(
	//Génériques
	"application/pdf" => array("Fichier PDF", path_assets("img/files/pdf.png")),
	"application/zip" => array("Archive ZIP", path_assets("img/files/zip.png")),
	"application/x-dosexec" => array("Application Win32", path_assets("img/files/exe.png")),
	"text/rtf" => array("Fichier RTF", path_assets("img/files/documents.png")),
	"video/mp4" => array("Video MP4", path_assets("img/files/mp4.png")),
	"audio/mpeg" => array("Audio MP3", path_assets("img/files/mp3.png")),
	"image/png" => array("Image PNG", path_assets("img/files/png.png")),
	"image/gif" => array("Image GIF", path_assets("img/files/gif.png")),
	"image/jpeg" => array("Image JPEG", path_assets("img/files/jpg.png")),
	"image/x-ms-bmp" => array("Image BMP", path_assets("img/files/bmp.png")),
	"generic" => array("Fichier", path_assets("img/files/genericfile.png")),

	//Formats LibreOffice
	"application/vnd.oasis.opendocument.text" => array("Fichier ODT", path_assets("img/files/libreOffice/libreoffice-oasis-text.png")),
	"application/vnd.oasis.opendocument.spreadsheet" => array("Fichier ODS", path_assets("img/files/libreOffice/libreoffice-oasis-spreadsheet.png")),
	"application/vnd.oasis.opendocument.presentation" => array("Fichier ODP", path_assets("img/files/libreOffice/libreoffice-oasis-presentation.png")),
	"application/octet-stream" => array("Fichier ODB", path_assets("img/files/libreOffice/libreoffice-oasis-database.png")),
	"application/vnd.oasis.opendocument.graphics" => array("Fichier ODG", path_assets("img/files/libreOffice/libreoffice-oasis-drawing.png")),

	//Formats Microsoft Office
	"application/vnd.openxmlformats-officedocument.wordprocessingml.document" => array("Document WORD", path_assets("img/files/word.png")),

	//Formats éditables
	"text/html" => array("Document HTML", path_assets("img/files/documents.png"), "editor" => "HTMLeditor"),

	//Spécifiques aux archives
	"specArchives" => array(
		"docx" => array("Document WORD", path_assets("img/files/word.png")),
		"xlsx" => array("Document EXCEL", path_assets("img/files/xlsx.png")),
		"one" => array("Fichier OneNote", path_assets("img/files/one.png")),
		"pptx" => array("Fichier PowerPoint", path_assets("img/files/pptx.png")),
		"ggb" => array("Fichier GeoGebra", path_assets("img/files/ggb.png")),
	),

	//Spécifiques aux fichiers textes
	"specTextFiles" => array(
		"txt" => array("Texte Brut", path_assets("img/files/txt.png")),
		"html" => array("Document HTML", path_assets("img/files/documents.png"), "editor" => "HTMLeditor"),
	),
);