<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;
use Fpdf\Fpdf;

class PDFFormat implements ProfileFormatter
{
    private $pdf;

    public function setData($profile)
    {
        $this->pdf = new Fpdf();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);

        // Get page width to center the image
        $pageWidth = $this->pdf->GetPageWidth();
        
        // Set the width of the image (e.g., 50 units)
        $imageWidth = 50;

        // Calculate the X position to center the image
        $xPos = ($pageWidth - $imageWidth) / 2;

        // If there is an image, render it centered
        $imageData = $profile->getImage();
        if ($imageData) {
            // Center the image horizontally
            $this->pdf->Image($imageData['filename'], $xPos, 20, $imageWidth); // 20 = Y position, adjust as needed

            // Add space after the image (e.g., 70 units down from the top)
            $this->pdf->SetY(90);  // Adjust Y position so that it leaves enough space after the image
        }

        // Render the title
        $this->pdf->Cell(0, 10, $profile->getTitle(), 0, 1, 'C'); // Center the title below the image

        // Render paragraphs
        $this->pdf->SetFont('Arial', '', 12);
        foreach ($profile->getParagraphs() as $paragraph) {
            $this->pdf->MultiCell(0, 10, $paragraph); // Use MultiCell to handle text wrapping
            $this->pdf->Ln(); // Add an extra line for spacing
        }
    }

    public function render()
    {
        // Output PDF to the browser or save to file
        $this->pdf->Output('D', 'profile.pdf'); // 'D' for download; change to 'I' for inline display
    }
}
