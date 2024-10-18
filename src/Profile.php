<?php

namespace App;

class Profile
{
    private $title;  // Added title property
    private $paragraphs = [];  // Store paragraphs
    private $image;  // Property to store image data

    public function __construct($data = null)
    {
        // Map the data to the class properties
        if (isset($data['biography'])) {
            $bio = $data['biography'];
            $this->title = $bio['title']['t1'];  // Set title from the JSON
            $this->paragraphs = $bio['paragraphs'];  // Store paragraphs directly
        }

        // Map image data if it exists
        if (isset($data['image'])) {
            $this->image = $data['image'];
        }
    }

    public function getTitle()
    {
        return $this->title;  // Return the title
    }

    public function getParagraphs()
    {
        return $this->paragraphs;  // Return the paragraphs
    }

    public function getImage()
    {
        return $this->image;  // Return the image data
    }
}
