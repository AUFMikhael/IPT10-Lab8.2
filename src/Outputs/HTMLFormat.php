<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class HTMLFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        // Use absolute paths for CSS, JS, and images
        $cssPath = '/assets/css/main.css';
        $jsPath = '/assets/js/main.js';
        $imagePath = '/assets/images/AUFfounder.jpg';

        // Start building the HTML output with the correct paths
        $output = "<!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' href='$cssPath'>
            <title>Profile of " . $profile->getTitle() . "</title>
        </head>
        <body>";

        // Founder section with image and background
        $output .= "<section style='background-color: lightgray; padding: 20px;'>
            <div style='max-width: 1200px; margin: 0 auto; text-align: center;'>
                <img src='$imagePath' alt='Founder' style='max-width: 100%; height: auto;'>
            </div>
        </section>";

        // Title section with background
        $output .= "<section style='background-color: lightgray; padding: 30px;'>
            <div style='text-align: center;'>
                <h1 style='color: black;'>" . $profile->getTitle() . "</h1>
            </div>
        </section>";

        // Profile content section
        $output .= "<section style='padding: 20px;'>
            <div style='max-width: 800px; margin: 0 auto;'>";
        foreach ($profile->getParagraphs() as $paragraph) {
            $output .= "<p style='line-height: 1.6;'>" . $paragraph . "</p>";
        }
        $output .= "</div></section>";

        // Close the HTML structure
        $output .= "<script src='$jsPath'></script>
        </body>
        </html>";

        $this->response = $output;
    }

    public function render()
    {
        return $this->response;
    }
}
