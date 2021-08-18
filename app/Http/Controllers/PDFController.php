<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Usuarios\Persona;
use App\Models\Ventas\Venta;
use App\Models\Ventas\Detalle;
use App\Models\Productos\Producto;
use App\Models\Ventas\Cliente;

class PDFVentas extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $title = 'Comprobante de compra';
        $image = public_path("img/logos/rockolaG.png");
        // Logo
        $this->Image($image, 10, 8, 33);
        // Fuente para la empresa
        $this->setFont('Arial', 'B', 18);
        $n = $this->GetStringWidth("Rockolas Panchos") + 6;
        // Color de fondo y texto
        $this->SetFillColor(253, 116, 140);
        $this->SetTextColor(254, 2222, 214);
        // Nombre de la empresa
        $this->SetX((140 - $n) / 2);
        $this->Cell(($n + 80), 9, " ", 0, 1, 'C', true);
        $this->SetX((140 - $n) / 2);
        $this->Cell(($n + 80), 9, utf8_decode("Rockolas Panchos"), 0, 1, 'C', true);
        $this->SetX((140 - $n) / 2);
        $this->Cell(($n + 80), 9, " ", 0, 1, 'C', true);
        //Salto de línea
        $this->Ln(10);

        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Calculamos ancho y posición del título.
        $w = $this->GetStringWidth($title) + 6;
        $this->SetX((210 - $w) / 2);
        // Colores de los bordes, fondo y texto
        #$this->SetDrawColor(255,255,255);
        #$this->SetFillColor(255,255,255);
        $this->SetTextColor(0, 0, 0);
        // Ancho del borde (1 mm)
        $this->SetLineWidth(1);
        // Título
        $this->Cell($w, 9, utf8_decode($title), 0, 1, 'C');
        // Salto de línea
        $this->Ln(4);
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1,5 cm del final
        $this->SetY(-15);
        // Arial itálica 8
        $this->SetFont('Arial', 'I', 8);
        // Color del texto en gris
        $this->SetTextColor(128);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }
    function DatosPago($fecha, $anticipo, $total, $cantidad, $idCliente)
    {
        //Fuente para identificador
        $this->setFont('Courier', '', 10);
        // Seprar la fecha y hora
        $fecha = explode(' ', $fecha);
        // Separa en año, mes y dia
        $fecha = explode('-', $fecha[0]);

        $identificador = $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] . "/" . $cantidad . "/" . $idCliente;
        
        // $mVenta = new Venta();
        // $mVenta = Venta::where('cliente_id', '=', $idCliente);
        $mVentas = Venta::all();
        foreach($mVentas as $rowVenta){
            if($rowVenta->cliente_id == $idCliente){
                $rowVenta->identificador = $identificador;
                $rowVenta->save();
            }
        }

        // Texto del identifiador
        $this->Cell(0, 6, utf8_decode("Identificador: " . $identificador), 0, 1, 'R');

        // Arial 12
        $this->SetFont('Arial', 'B', 12);
        // Color del borde
        $this->SetFillColor(225, 225, 225);
        // Título
        $this->Cell(0, 6, utf8_decode("Datos de Pago"), 0, 1, 'L', true);
        // Arial 11
        $this->SetFont('Arial', '', 11);
        // Título
        $this->Multicell(0, 6, utf8_decode("Realizar el pago a tráves de un déposito o transferencia a la cuneta de BBVA"), 0, 1, 'L', true);
        $this->Cell(0, 6, utf8_decode("Número de cuenta para deposito: 4000001234567899"), 0, 1, 'L', true);
        $this->Cell(0, 6, utf8_decode("A nombre de EMILIO PANCHO"), 0, 1, 'L', true);
        $this->Cell(0, 6, utf8_decode("Concepto: Compra material"), 0, 1, 'L', true);
        $this->Cell(0, 6, utf8_decode("Fecha de Impresión: " . $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0]), 0, 1, 'L', true);

        $this->Cell(0, 6, utf8_decode("Fecha de limite para anticipo: " . $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0]), 0, 1, 'L', true);
        $this->Cell(0, 6, utf8_decode("Monto del anticipo: " . $anticipo), 0, 1, 'L', true);
        $fecha[2] = $fecha[2] + 5;
        if (intval($fecha[2]) > 30) {
            $fecha[1] = $fecha[1] + 1;
            $fecha[2] = $fecha[2] - 30;
        } elseif ($fecha[2] > 28 and $fecha[2] == 2) {
            $fecha[2] = $fecha[2] + 1;
        }
        if ($fecha[1] > 12) {
            $fecha[0] = $fecha[0] + 1;
        }
        $this->Cell(0, 6, utf8_decode("Fecha de limite para pago total: " . $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0]), 0, 1, 'L', true);
        $this->Cell(0, 6, utf8_decode("Monto del pago total (sin anticipo): " . $total), 0, 1, 'L', true);
        // Salto de línea
        $this->Ln(6);
    }

    function DatoPersona($nombre, $calle, $colonia, $celular, $fecha)
    {
        // Arial 12
        $this->SetFont('Arial', 'B', 12);
        // Color del borde
        $this->SetFillColor(225, 225, 225);
        // Título
        $this->Cell(0, 6, utf8_decode("Datos del cliente"), 0, 1, 'L', true);
        // Arial 12
        $this->SetFont('Arial', '', 12);
        // Color del borde
        $this->SetFillColor(225, 225, 225);
        // Título
        $this->Cell(0, 6, utf8_decode("Nombre: $nombre"), 0, 1, 'L', true);
        $this->Cell(0, 6, utf8_decode("Domicilio: $calle," . " " . "$colonia"), 0, 1, 'L', true);
        $this->Cell(0, 6, utf8_decode("Celular: $celular"), 0, 1, 'L', true);

        // Salto de línea
        $this->Ln(4);
    }

    function DatosVenta($prodcuto, $cantidad, $anticipo, $total, $fecha)
    {
        $header = array('Producto', 'Cantidad', 'Anticipo', 'Total', 'Fecha');
        $fecha = explode(' ', $fecha);
        // Separa en año, mes y dia
        $fecha = explode('-', $fecha[0]);
        $data = array($prodcuto, $cantidad, $anticipo, $total, $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0]);

        // Fuente para el titulo
        $this->setFont('Arial', 'B', 12);
        // Titulo
        $this->Cell(0, 6, "Datos de la compra", 0, 1, 'L');

        // Fuente para la Cabecera
        $this->SetFont('Arial', '', 11);
        // Cabecera
        foreach ($header as $col) {
            $this->CellFitSpace(38, 7, utf8_decode($col), 1);
        }
        $this->Ln();
        // Times 12
        $this->SetFont('Times', '', 12);
        // Datos
        foreach ($data as $row) {
            $this->CellFitSpace(38, 6, utf8_decode($row), 1);
        }
        $this->Ln();
    }

    function tituloTabla()
    {
        // Fuente para el titulo
        $this->setFont('Arial', 'B', 12);
        // Titulo
        $this->Cell(0, 6, "Datos de la compra", 0, 1, 'L');
    }

    function titulosTabla()
    {
        $header = array('Producto', 'Cantidad', 'Precio', 'Fecha');
        // Fuente para la Cabecera
        $this->SetFont('Arial', '', 11);
        // Cabecera
        foreach ($header as $col) {
            $this->CellFitSpace(38, 8, utf8_decode($col), 1);
        }
        $this->Ln();
    }

    function DatosVentaCompra($prodcuto, $cantidad, $precio, $fecha)
    {

        $fecha = explode(' ', $fecha);
        // Separa en año, mes y dia
        $fecha = explode('-', $fecha[0]);
        $data = array($prodcuto, $cantidad, $precio, $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0]);

        // Times 12
        $this->SetFont('Times', '', 12);
        // Datos
        foreach ($data as $row) {
            $this->CellFitSpace(38, 7, utf8_decode($row), 1);
        }
        $this->Ln();
    }

    function ImprimirDatos($nombre, $calle, $colonia, $celular, $producto, $cantidad, $anticipo, $total, $fecha, $idCliente)
    {
        $this->AddPage();
        $this->DatosPago($fecha, $anticipo, $total, $cantidad, $idCliente);
        $this->DatoPersona($nombre, $calle, $colonia, $celular, $fecha);
        $this->DatosVenta($producto, $cantidad, $anticipo, $total, $fecha);
    }

    function ImprimirDatosCompra($nombre, $calle, $colonia, $celular, $idCliente)
    {
        $mVentas = Venta::all();
        $mDetalles = Detalle::all();
        $mProductos = Producto::all();

        foreach ($mVentas as $rowVenta) {
            foreach ($mDetalles as $rowDetalle) {
                foreach ($mProductos as $rowProducto) {
                    if ($rowVenta->cliente_id == $idCliente) {
                        if ($rowDetalle->venta_id == $rowVenta->id) {
                            if ($rowProducto->id == $rowDetalle->producto_id) {
                                $fecha = $rowVenta->fechaRegistro;
                                $anticipo = $rowVenta->anticipoPagado;
                                $total = $rowVenta->total;
                                $cantidad = $rowDetalle->cantidad;
                            }
                        }
                    }
                }
            }
        }

        $this->AddPage();
        $this->DatosPago($fecha, $anticipo, $total, $cantidad, $idCliente);
        $this->DatoPersona($nombre, $calle, $colonia, $celular, $fecha, $cantidad, $idCliente);
        $this->tituloTabla();
        $this->titulosTabla();
        foreach ($mVentas as $rowVenta) {
            foreach ($mDetalles as $rowDetalle) {
                foreach ($mProductos as $rowProducto) {
                    if ($rowVenta->cliente_id == $idCliente) {
                        if ($rowDetalle->venta_id == $rowVenta->id) {
                            if ($rowProducto->id == $rowDetalle->producto_id) {
                                $this->DatosVentaCompra($rowProducto->nombre, $rowDetalle->cantidad, $rowDetalle->precioUnitario,  $rowVenta->fechaRegistro);
                            }
                        }
                    }
                }
            }
        }
    }

    //***** Aquí comienza código para ajustar texto *************
    //***********************************************************
    function CellFit($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '', $scale = false, $force = true)
    {
        //Get string width
        $str_width = $this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $ratio = ($w - $this->cMargin * 2) / $str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit) {
            if ($scale) {
                //Calculate horizontal scaling
                $horiz_scale = $ratio * 100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET', $horiz_scale));
            } else {
                //Calculate character spacing in points
                $char_space = ($w - $this->cMargin * 2 - $str_width) / max($this->MBGetStringLength($txt) - 1, 1) * $this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET', $char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align = '';
        }

        //Pass on to Cell method
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT ' . ($scale ? '100 Tz' : '0 Tc') . ' ET');
    }

    function CellFitSpace($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, false, false);
    }

    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if ($this->CurrentFont['type'] == 'Type0') {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++) {
                if (ord($s[$i]) < 128)
                    $len++;
                else {
                    $len++;
                    $i++;
                }
            }
            return $len;
        } else
            return strlen($s);
    }
}

class PDFController extends Controller
{
    private $fpdf;

    public function __construct()
    {
    }

    /**
     * parametros:
     * $idPersona
     * $idVenta
     */
    public function createPDFVentas($idCliente, $idPersona, $idVenta, $idDetalle, $idProducto)
    {
        $mCliente = Cliente::find($idCliente);
        $mPersona = Persona::find($idPersona);
        $mVenta = Venta::find($idVenta);
        $mDetalle = Detalle::find($idDetalle);
        $mProducto = Producto::find($idProducto);

        // Creación del objeto de la clase heredada
        $this->fpdf = new PDFVentas();
        $title = 'Comprobante de compra';
        $this->fpdf->SetTitle($title);
        $this->fpdf->ImprimirDatos(
            $mPersona->nombre,
            $mPersona->calle,
            $mPersona->colonia,
            $mPersona->celular,
            $mProducto->nombre,
            $mDetalle->cantidad,
            $mVenta->anticipoPagado,
            $mVenta->total,
            $mVenta->fechaRegistro,
            $mCliente->id
        );

        $this->fpdf->Output();
        exit;
    }

    public function createPDFVentasCompra($idCliente, $idPersona)
    {
        $mCliente = Cliente::find($idCliente);
        $mPersona = Persona::find($idPersona);

        // Creación del objeto de la clase heredada
        $this->fpdf = new PDFVentas();
        $title = 'Comprobante de compra';
        $this->fpdf->SetTitle($title);
        $this->fpdf->ImprimirDatosCompra($mPersona->nombre, $mPersona->calle, $mPersona->colonia, $mPersona->celular, $mCliente->id);

        session()->forget('carrito');
        session()->forget('nuevoCarrito');

        $this->fpdf->Output();
        exit;
    }
}
