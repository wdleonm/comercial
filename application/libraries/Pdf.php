<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Incluimos el archivo fpdf
// require_once APPPATH."/third_party/fpdf/mc_pdf.php";
require_once 'application/third_party/fpdf/mc_pdf.php';

/**
 *  Librería para usar FPDF desde los controladores.
 *
 * */
class pdf extends PDF_MC_Table  {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Encabezado de los documentos PDF
	 * */
	public function Header() {	    
	   $this->Image('assets/images/logo.png', 25, 6, 28, 28);
        $this->Image('assets/images/logosecretaria.png', 148, 15.5, 41, 12);
        $this->SetFont('Arial', '', 6);
        /* ------------- */
        $this->SetFont('Arial', 'B', 8);
        $this->SetXY(80, 10);
        $this->Cell(50, 4, "Republica Bolivariana de Venezuela", 0, 0, 'C');
        $this->SetXY(80, 14);
        $this->Cell(50, 4, "Gobierno Bolivariano del Estado Aragua", 0, 0, 'C');
        $this->SetXY(80, 18);
        $this->Cell(50, 4, "Secretaria Sectorial del Poder Popular para la Salud", 0, 0, 'C');
        $this->SetXY(80, 22);
        $this->Cell(50, 4, "Corporacion de Salud del Estado Aragua", 0, 0, 'C');
        $this->SetXY(80, 26);
        $this->Cell(50, 4, "Almacen Despachador", 0, 0, 'C');
        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(10, 45);
        $this->Cell(190, 10, " ", 0, 1, 'C');
	}
	
	
  

	// El pie del pdf
    public function Footer() {
         $this->SetY(-60);
//         $this->SetFont('Arial', 'I', 5);

//         $this->Cell(30, 5, 'JEFE DEL SERVICIO SOLICITANTE', '1', 0, 'C', 0);
//         $this->Cell(30, 5, 'DIRECTOR DE LA DEPENDENCIA', '1', 0, 'C', 0);
//         $this->Cell(30, 5, 'ADMINISTRADOR INTENDENTE', '1', 0, 'C', 0);
//         $this->Cell(25, 5, 'KARDISTA', '1', 0, 'C', 0);
//         $this->Cell(30, 5, 'DESPACHADOR', '1', 0, 'C', 0);
//         $this->Cell(30, 5, 'JEFE DE SERVICIO', '1', 0, 'C', 0);



//         $this->SetY(-55);
//         $this->SetFont('Arial', 'I', 5);

//         $this->Cell(30, 10, '', '1', 0, 'C', 0);
//         $this->Cell(30, 10, '', '1', 0, 'C', 0);
//         $this->Cell(30, 10, '', '1', 0, 'C', 0);
//         $this->Cell(25, 10, '', '1', 0, 'C', 0);
//         $this->Cell(30, 10, '', '1', 0, 'C', 0);
//         $this->Cell(30, 10, '', '1', 0, 'C', 0);

//         $this->SetY(-45);
//         $this->SetFont('Arial', 'I', 5);

//         $this->Cell(30, 10, '', '1', 0, 'C', 0);
//         $this->Cell(30, 10, '', '1', 0, 'C', 0);
//         $this->Cell(30, 10, '', '1', 0, 'C', 0);
//         $this->Cell(25, 10, '', '1', 0, 'C', 0);
//         $this->Cell(30, 10, '', '1', 0, 'C', 0);
//         $this->Cell(30, 10, '', '1', 0, 'C', 0);
        
//         $this->SetY(-35);
//         $this->SetFont('Arial', 'I', 5);

//         $this->Cell(30, 5, 'FIRMA Y NOMBRE', '1', 0, 'C', 0);
//         $this->Cell(30, 5, 'FIRMA Y NOMBRE', '1', 0, 'C', 0);
//         $this->Cell(30, 5, 'FIRMA Y NOMBRE', '1', 0, 'C', 0);
//         $this->Cell(25, 5, 'FIRMA Y NOMBRE', '1', 0, 'C', 0);
//         $this->Cell(30, 5, 'FIRMA Y NOMBRE', '1', 0, 'C', 0);
//         $this->Cell(30, 5, 'FIRMA Y NOMBRE', '1', 0, 'C', 0);

//         $this->SetY(-25);
//         $this->SetFont('Arial', 'I', 8);

//         $this->Cell(47, 5, 'REGISTRO: ____________________ ', 0, 0, 'C');
//         $this->Cell(65, 5, '',  0, 0, 'C');
// //        $this->Cell(30, 5, '', '1', 0, 'C', 0);
//         $this->Cell(85, 5, 'FOLIO: ____________________',0, 0, 'C');
// //        $this->Cell(60, 5, '', '1', 0, 'C', 0);
// //        $this->Cell(30, 5, '', '1', 0, 'C', 0);

        $this->Cell(0, 30, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

class Pdf2 extends FPDF {

    public function __construct() {
        parent::__construct();
    }

    // El encabezado del PDF
    public function Header() {


        $this->Image('assets/images/logo.png', 16, 6, 28, 28);
        $this->Image('assets/images/logosecretaria.png', 275, 15.5, 41, 12);
        $this->SetFont('Arial', '', 6);
        /* ------------- */
        $this->SetFont('Arial', 'B', 8);
        $this->SetXY(140, 10);
        $this->Cell(50, 4, "Republica Bolivariana de Venezuela", 0, 0, 'C');
        $this->SetXY(140, 14);
        $this->Cell(50, 4, "Gobierno Bolivariano del Estado Aragua", 0, 0, 'C');
        $this->SetXY(140, 18);
        $this->Cell(50, 4, "Secretaria Sectorial del Poder Popular para la Salud", 0, 0, 'C');
        $this->SetXY(140, 22);
        $this->Cell(50, 4, "Direccion de Recursos Humanos", 0, 0, 'C');
        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(10, 45);
        $this->Cell(190, 10, " ", 0, 1, 'C');
    }

    // El pie del pdf
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
