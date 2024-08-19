<?php

namespace App\Services\Tcpdf;

use Intervention\Image\Facades\Image;

use TCPDF;

class TcpdfService extends TCPDF
{
    // Property to hold the hotel data
    public $hotelData;

    #------------------------------------header function---------------------------------
    public function Header()
    {

        if ($this->hotelData) {

            //logo image
            $logoPath = public_path('/images/logo-dark.png');
            $this->Image($logoPath, 10, 4, 50);



            $this->SetFont('helvetica', 'B', 9);
            $this->SetXY(12, 18);
            $this->Cell(30, 6, "Roomista (Pvt) Ltd ,", 0, 1, 'L');
            $this->SetXY(12, 23);
            $this->Cell(30, 6, "No 207/23, Dharmapala Mawatha,", 0, 1, 'L');
            $this->SetXY(12, 28);
            $this->Cell(30, 6, "Colombo 07,Sri Lanka.", 0, 1, 'L');

            $this->SetFont('helvetica', '', 9);
            $this->SetXY(12, 33);
            $this->Cell(30, 6, "Tel Phone : +94 112 102 042", 0, 1, 'L');
            $this->SetXY(12, 38);
            $this->Cell(30, 6, "Hot Line : +94 112 102 042", 0, 1, 'L');

            $w = '15';
            $h = '5';
            // flags column one
            $this->ImageSVG($file = '/frontend/flags/4x3/lk.svg', $x = '68', $y = '10', $w, $h, $align = '', $palign = '', $border = 0, $fitonpage = false);
            $this->SetFont('helvetica', 'B', 9);
            $this->SetXY(82, 9);
            $this->Cell(28, 6, "SL 011 2 10 20 42", 0, 1, 'L');

            $this->ImageSVG($file = '/frontend/flags/4x3/au.svg', $x = '68', $y = '18', $w, $h, $align = '', $palign = '', $border = 0, $fitonpage = false);
            $this->SetFont('helvetica', 'B', 9);
            $this->SetXY(82, 17);
            $this->Cell(28, 6, "AUS 61 (03) 9999 7450", 0, 1, 'L');

            $this->ImageSVG($file = '/frontend/flags/4x3/nl.svg', $x = '68', $y = '26', $w, $h, $align = '', $palign = '', $border = 0, $fitonpage = false);
            $this->SetFont('helvetica', 'B', 9);
            $this->SetXY(82, 25);
            $this->Cell(28, 6, "LUX 352 20 331 999", 0, 1, 'L');

            // $this->ImageSVG($file='/frontend/flags/4x3/se.svg', $x='68', $y='34', $w, $h, $align='', $palign='', $border=0, $fitonpage=false);
            // $this->SetFont('helvetica', '', 9);
            // $this->SetXY(82,33);
            // $this->Cell(28, 6, "+46 844 686 450", 0, 1, 'L');

            // flags column two
            $this->ImageSVG($file = '/frontend/flags/4x3/gb.svg', $x = '122', $y = '10', $w, $h, $align = '', $palign = '', $border = 0, $fitonpage = false);
            $this->SetFont('helvetica', 'B', 9);
            $this->SetXY(136, 9);
            $this->Cell(28, 6, "UK 44 752 06 44 688", 0, 1, 'L');

            $this->ImageSVG($file = '/frontend/flags/4x3/ca.svg', $x = '122', $y = '18', $w, $h, $align = '', $palign = '', $border = 0, $fitonpage = false);
            $this->SetFont('helvetica', 'B', 9);
            $this->SetXY(136, 17);
            $this->Cell(28, 6, "CA 1 (403) 8000111", 0, 1, 'L');

            $this->ImageSVG($file = '/frontend/flags/4x3/sg.svg', $x = '122', $y = '26', $w, $h, $align = '', $palign = '', $border = 0, $fitonpage = false);
            $this->SetFont('helvetica', 'B', 9);
            $this->SetXY(136, 25);
            $this->Cell(28, 6, "SGP 65 (3) 1594440", 0, 1, 'L');

            // $this->ImageSVG($file='/frontend/flags/4x3/jp.svg', $x='122', $y='34', $w, $h, $align='', $palign='', $border=0, $fitonpage=false);
            // $this->SetFont('helvetica', '', 9);
            // $this->SetXY(136,33);
            // $this->Cell(28, 6, "+81 345 900 530", 0, 1, 'L');

            // headings, date, time, invoice number details
            $this->SetFont('helvetica', 'B', 18);
            $this->SetY(8);
            $this->cell(190, 10, "INVOICE", 0, 1, 'R');

            $this->setfont('Helvetica', 'I', 10);
            $this->SetXY(174, 18);
            $this->cell(30, 5, "{$this->hotelData->created_at}", 0, 1, 'L');
            $this->Ln();

            $this->SetXY(174, 24);
            $this->cell(30, 5, "Inv No: {$this->hotelData->id}", 0, 1, 'L');
            $this->Ln();

            $this->Line(10, $this->GetY() + 10, 200, $this->GetY() + 10);

            $this->SetFont('Helvetica', 'B', 14);
            $this->SetXY(65, 55);
            $this->Cell(190, 10, "{$this->hotelData->property->name}", 0, 1, 'L');
            $this->SetFont('Helvetica', '', 10);
            $this->SetXY(65, 63);
            $this->MultiCell(65, 12, "{$this->hotelData->property->name}", 0, 'L', 0, 0, '', '', true, 1, false, true, 12);

            // $image = @file_get_contents('http://laradevsbd.com/public/images/20210908182925_big_1200x814_9.webp');

            // if ($image != '') {
            //     $filename = time().'.jpg';
            //     file_put_contents(public_path('tmp\\'.$filename), $image);

            //     // Resize the image to the desired width and height
            //     $resizedImage = Image::make(public_path('tmp/' . $filename))->resize(300, 200);

            //     // Save the resized image
            //     $resizedImage->save(public_path('tmp/' . $filename));

            // } else {
            //     $filename = ''; 
            // }

            //hotel image
            // $logoPath = public_path('tmp\\'.$filename);
            // $this->Image($logoPath, 10, 65, 50);

            $this->SetFont('Helvetica', 'B', 10);
            $this->SetY(78);
            $this->Cell(190, 10, "INVOICED TO:", 0, 1, 'L');

            $this->SetFont('Helvetica', '', 10);
            $this->SetY(85);
            $this->MultiCell(35, 12, "{$this->hotelData->address}", 0, 'L', 0, 0, '', '', true, 1, false, true, 12);

            $this->SetY(92);
            $this->Cell(190, 10, "Telephone: {$this->hotelData->mobile}", 0, 1, 'L');

            $this->SetY(97);
            $this->Cell(190, 10, "E-mail: {$this->hotelData->email}", 0, 1, 'L');

            $this->SetDrawColor(4, 58, 99);
            $borderThickness = 0.6;
            $this->SetLineWidth($borderThickness);
            $this->SetFont('Helvetica', 'B', 14);
            $this->SetY(110);
            $borderRadius = 3;
            $this->RoundedRect(10, $this->GetY(), 190, 14, $borderRadius, '1111', 'D');
            $this->Cell(190, 14, "Customer Invoice for Recent Hotel Booking", 0, 1, 'C');

            $this->setfont('Helvetica', '', 10);
            $this->SetXY(140, 77);
            $this->cell(30, 5, "Check In: {$this->hotelData->checkin_date}", 0);
            $this->Ln();

            $this->SetXY(140, 82);
            $this->cell(30, 5, "Check Out: {$this->hotelData->checkout_date}", 0);
            $this->Ln();
            // dd($this->hotelData->qty);

            $this->SetXY(140, 87);
            $this->cell(30, 5, "Payment Method: " . ucwords(str_replace('-', ' ', $this->hotelData->transaction->payment_option_id)), 0);
            $this->Ln();

            //payment status
            $this->SetXY(140, 92);
            $status = strtoupper($this->hotelData->status);
            $this->Cell(30, 5, "Payment Status:", 0);
            $this->SetFont('helvetica', 'B', 10);

            if ($status === 'SUCCESS') {
                $this->SetTextColor(0, 128, 0); // Green
            } elseif ($status === 'PENDING') {
                $this->SetTextColor(255, 165, 0); // Orange
            } elseif ($status === 'CANCEL') {
                $this->SetTextColor(255, 0, 0); // Red
            } elseif ($status === 'PARTIAL PAY') {
                $this->SetTextColor(255, 165, 0); // Orange 
            }

            $this->Cell(0, 5, $status, 0, 1);
            $this->SetFont('helvetica', '', 10);
            $this->SetTextColor(0);

            //booking status 
            $this->SetXY(140, 97);
            $bkStatus = strtoupper($this->hotelData->status);
            $this->Cell(30, 5, "Booking Status: ", 0);
            $this->SetFont('helvetica', 'B', 10);

            if ($bkStatus === 'PENDING') {
                $this->SetTextColor(255, 165, 0); // Orange
            } elseif ($bkStatus === 'RESERVED') {
                $this->SetTextColor(0, 128, 0); // Green
            } elseif ($bkStatus === 'CANCEL') {
                $this->SetTextColor(255, 0, 0); // Red
            }

            $this->Cell(0, 5, $bkStatus, 0, 1);
            $this->SetFont('helvetica', '', 10);
            $this->SetTextColor(0);
            $this->Ln();

            #------------------------------------Table Headings---------------------------------
            $this->SetFillColor(4, 58, 99);
            $this->setfont('Helvetica', '', 10);
            $this->SetTextColor(255, 255, 255);

            $this->SetXY(10, 130);
            $this->setCellPaddings($left = '4', $top = '', $right = '', $bottom = '');
            $this->Cell(60, 10, "Booking Details", 0, 0, 'L', 1);

            $this->SetXY(70, 130);
            $this->Cell(90, 10, "Room Rates x Number Of Room = Amount", 0, 0, 'C', 1);

            $this->SetXY(160, 130);
            $this->setCellPaddings($left = '', $top = '', $right = '4', $bottom = '');
            $this->Cell(40, 10, "Amount", 0, 0, 'R', 1, '', 5, 8);

            #------------------------------------Table data---------------------------------
            $this->SetFont('Helvetica', '', 10);
            $y = 140.2;
            $rowHeight = 10;
            foreach ($this->hotelData->items as $rec) {
                $this->setfont('Helvetica', '', 10);
                $this->SetTextColor(10, 1, 0);
                $this->SetDrawColor(201, 201, 201);
                $borderThickness = 0.001;
                $this->SetLineWidth($borderThickness);

                $this->SetFillColor(255, 255, 255);
                $this->SetXY(10, $y);
                $this->setCellPaddings($left = '', $top = '2', $right = '', $bottom = '');
                $this->MultiCell(60, 18, $rec->room->name . '  ' . $rec->bedType->name . '[' . $rec->bedType->name . '  ' . '/' . '  '  . $rec->mealType->name . ']' . "\nExtra Beds:" . ' ' . $rec->extra_beds, 1, 'L', 1);
                // dd($rec);

                #------------------------------------Sub-Cell---------------------------------
                $this->SetDrawColor(201, 201, 201);
                $borderThickness = 0.1;
                $this->SetLineWidth($borderThickness);
                $this->SetFont('Helvetica', '', 10);
                $this->SetTextColor(0, 0, 0);

                // Main cell
                $this->SetXY(70, $y);
                $this->SetFillColor(240, 237, 237);
                $this->Cell(90, 18, '', 1, 0, 'C', false);

                // Set the Y position to be inside the main cell (add a small offset for better positioning)
                $subCellY = $y + 2;
                $borderThickness = 0.001;
                $this->SetLineWidth($borderThickness);

                $this->setCellPaddings($left = '1', $top = '', $right = '', $bottom = '');
                $this->SetFont('Helvetica', '', 9);
                $this->SetXY(76, $subCellY);
                $this->SetFillColor(255, 255, 255);
                $this->MultiCell(48, 12, "Adult Rates: RS." . $this->hotelData->total_amount . " X " . $rec->qty . "\n" . $this->hotelData->checkin_date, 1, 'L', false);

                $this->SetXY(120, $subCellY);
                $this->setCellPaddings($left = '3', $top = '', $right = '', $bottom = '');
                $this->MultiCell(10, 12, $rec->qty, 1, 0, 'C', false);

                $this->SetXY(129, $subCellY);
                $this->setCellPaddings($left = '1', $top = '', $right = '', $bottom = '');
                $this->MultiCell(25, 12, "RS." . $this->hotelData->total_amount, 1, 0, 'C', false);

                #------------------------------------End of Sub-Cell---------------------------------
                $this->SetXY(160, $y);
                $this->SetFillColor(255, 255, 255);
                $this->SetFont('Helvetica', '', 10);
                $this->MultiCell(40, 18, "RS." . $this->hotelData->total_amount, 1, 'R', 1);

                $y += $rowHeight;
            }

            #------------------------------------Sub total section---------------------------------
            $this->SetDrawColor(201, 201, 201);
            $borderThickness = 0.001;
            $this->SetLineWidth($borderThickness);

            $this->SetXY(10, $y + 8);
            $this->SetFont('helvetica', '', 10);
            $this->cell(150, 10, "Total:", 1, 0, 'R', false);
            $this->SetFont('helvetica', '', 10);
            $this->cell(40, 10, "RS." . $this->hotelData->total_amount, 1, 0, 'R', false);
            // dd($this->hotelData->items->qty);

            $this->SetXY(10, $y + 18);
            $this->SetFont('helvetica', '', 10);
            $this->cell(150, 10, "Total Paid:", 1, 0, 'R', false);
            $this->SetFont('helvetica', '', 10);
            $this->cell(40, 10, "RS." . $this->hotelData->patial_amount, 1, 0, 'R', false);

            $totalDue = ($this->hotelData->total_amount) - ($this->hotelData->patial_amount);

            $this->SetFillColor(207, 204, 204);
            $this->SetXY(10, $y + 28);
            $this->SetFont('helvetica', 'B', 12);
            $this->cell(150, 10, "Total Due:", 1, 0, 'R', 1);
            $this->SetFont('helvetica', 'B', 12);
            $this->cell(40, 10, "RS." . $totalDue, 1, 0, 'R', true);
        }
    }

    #------------------------------------footer function---------------------------------
    public function Footer()
    {
        $this->SetFont('Helvetica', 'I', 8);
        $this->SetY(-10);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, 0, 'C');
    }
}
