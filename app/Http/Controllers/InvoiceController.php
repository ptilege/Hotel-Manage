<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use TCPDF;
use App\Services\Tcpdf\TcpdfService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    // public $booking;

    // public function __construct($booking = null)
    // {
    //     $this->booking = $booking;
    // }

    public function generateInvoice()
    // ($id)
    {
        
        $hotelId = 1; 
        $hotelData = Booking::with('property')->findOrFail($hotelId);
        // dd($hotelData->property->image);


        // $booking = Booking::findOrFail($id);
        // Create new PDF instance
        $pdf = new TcpdfService();


          // Set the hotelData property in the TcpdfService class
          $pdf->hotelData = $hotelData;

              // Generate the invoice PDF
        // $pdf->generateInvoice();




        // Add a page
        $pdf->AddPage();

        // Set font for the header
        $pdf->SetFont('helvetica', '', 14);

      //header and footer
      $pdf->setPrintHeader(true);
      $pdf->setPrintFooter(true);

      

        // Set font back to default for the rest of the invoice content
        $pdf->SetFont('helvetica', '', 12);

        // Here, you can continue adding the rest of the invoice content         

        // Output the PDF as a response
        $pdf->Output('invoice.pdf', 'I');
    }

}

