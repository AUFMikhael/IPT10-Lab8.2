<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class TextFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        // Tile name
        $output = $profile->getTitle() . PHP_EOL . PHP_EOL;

        // Retrieve and add paragraphs
        foreach ($profile->getParagraphs() as $paragraph) {
            $output .= $paragraph . PHP_EOL . PHP_EOL;
        }

        // Store the final response
        $this->response = $output;
    }

    public function render()
    {
        header('Content-Type: text/plain');
        return $this->response;
    }
}
