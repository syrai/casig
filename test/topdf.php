<?php

require('../fpdf17/fpdf.php');
class PDF extends FPDF
{
// En-tête
function Header()
{
    // Logo
    $this->Image('logo.png',10,6,30);
    // Police Arial gras 15
    $this->SetFont('Arial','B',15);
    // Décalage à droite
    $this->Cell(80);
    // Titre
    $this->Cell(100,10,'Fiche utilisateur',1,0,'C');
    // Saut de ligne
    $this->Ln(20);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    $this->Cell(0,10,'Chambre é Agriculture de Meurthe-et-Moselle',0,0,'C');
}
}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 12);

//Police et couleurs
$pdf->SetFont('Arial','B',16);
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
$pdf->SetLineWidth(.3);

//En-tête de la table
$pdf->Cell(100,10,'Nom',1,0,'L',1);
$pdf->Cell(10,10,'id',1,1,'L',1);
//Connexion et requête
$str_conexao='host=88.191.124.79 dbname=SIA port=5432 user=postgres password=postgres';
$conexao=pg_connect($str_conexao) or die('A conexão ao banco de dados falhou!');
$consulta=pg_exec($conexao,'select raison_social,idtypeabonnement from tcartonet');
$numregs=pg_numrows($consulta);
//Table
$fill=false;
$i=0;
while($i<$numregs)
{
    $siape=pg_result($consulta,$i,'raison_social');
    $nome=pg_result($consulta,$i,'idtypeabonnement');
    $pdf->Cell(50,10,$siape,1,0,'R',$fill);
    $pdf->Cell(20,10,$nome,1,1,'L',$fill);
    $fill=!$fill;
    $i++;
}
//Ajout d'un rectangle, d'une ligne, d'un logo et de texte
$pdf->Rect(5,5,170,80);
$pdf->Line(5,90,90,90);
$pdf->SetFillColor(224,235);
$pdf->SetFont('Arial','B',8);
$pdf->SetXY(5,95);
$pdf->Output();
?>