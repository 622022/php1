<?php
session_start(); 
require_once("loginservice.php");
$loginService = loginService::getInstance();
$username=$loginService->returnUsername();
$email=$loginService->returnEmail();
$currentDate=date("Y-m-d");
require_once ( 'fdpdf/qrcode/qrcode.class.php');
$qrcode = new QRcode ("Dance ticket for $username", 'H'); // error level: L, M, Q, H
//$imagenurl = "https://p.bigstockphoto.com/GeFvQkBbSLaMdpKXF1Zv_bigstock-Aerial-View-Of-Blue-Lakes-And--227291596.jpg";
ob_start();
//require('fdpdf/fpdf.php');
require('fdpdf/code39.php');
$pdf = new FPDF();
$pdf=new PDF_Code39();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(55, 5, 'Reference Code', 0, 0);
$pdf->Cell(58, 5, ': 026ETY', 0, 0);
$pdf->Cell(25, 5, 'Date', 0, 0);
$pdf->Cell(52, 5, ': 2018-12-24 11:47:10 AM', 0, 1);
$pdf->Cell(55, 5, 'Amount', 0, 0);
$pdf->Cell(58, 5, ":60.00 EUROS", 0, 0);
$pdf->Cell(25, 5, 'Channel', 0, 0);
$pdf->Cell(52, 5, ': WEB', 0, 1);
$pdf->Cell(55, 5, 'Status', 0, 0);
$pdf->Cell(58, 5, ': Complete', 0, 1);
$pdf->Line(10, 30, 200, 30);
$pdf->Ln(10);
$pdf->Cell(55, 5, 'Product Id', 0, 0);
$pdf->Cell(58, 5, ': 64351-84503', 0, 1);
$pdf->Cell(55, 5, 'Tax Amount', 0, 0);
$pdf->Cell(58, 5, ': 0', 0, 1);
$pdf->Cell(55, 5, 'Product Name', 0, 0);
$pdf->Cell(58, 5, ': BACK2BACK by NICKY ROMERO', 0, 1);
$pdf->Cell(55, 5, 'Product Delivery Charge', 0, 0);
$pdf->Cell(58, 5, ': 0', 0, 1);
$pdf->Line(10, 60, 200, 60);
$pdf->Ln(10);//Line break
$pdf->Cell(55, 5, 'Paid by', 0, 0);
$pdf->Cell(58, 5, ": $username", 0, 1);
$pdf->Cell(55, 5, 'Email id', 0, 0);
$pdf->Cell(58, 5, ": $email", 0, 1);
$pdf->Line(155, 75, 195, 75);
$pdf->Ln(5);//Line break
$pdf->Cell(140, 5, '', 0, 0);
$pdf->Cell(50, 5, ': Signature', 0, 1, 'C');

//barcode generation
$pdf->Code39(20,100,"$username 123",1,10);
//$pdf->Cell(0, 0, $pdf->Image($imagenurl, 1,1,20,10), 0, 0, 'C', false,'');
$qrcode->displayFPDF($pdf, 115, 100, 100);
$pdf->Output();
ob_end_flush(); 
?>

