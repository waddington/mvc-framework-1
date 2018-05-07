<?php
// My model to scrape data of a web page
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 25/04/17
 * Time: 13:28
 */
class ScrapeModel
{
    private $scrapeData;
    private $searchTerm;
    private $baseURL;

    public function __construct()
    {
        // Setting default values
        $this->searchTerm = clean_input("Goldsmiths");
        $this->baseURL = "https://www.google.co.uk/search?q=";
        // Calling a function to get the webpage ready for extracting data from
        $this->doWebScrape();
    }

    private function doWebScrape() {
        // I have a function in functions.php that uses curl to get a webpage
        $url = $this->baseURL.$this->searchTerm;
        $this->scrapeData = downloadPage($url);
    }

    // Extracting data from the webpage
    public function getScrapeDataTitles() {
        // Creating an XML document with the webpage in
        $xmlDom = new DOMDocument();
        @$xmlDom->loadHTML($this->scrapeData);

        // Getting all h3 tags
        $titlesUp = $xmlDom->getElementsByTagName('h3');

        // Looping through all of the h3 tags and adding their text content to an array
        $titles = array();
        foreach ($titlesUp as $title) {
            array_push($titles, $title->nodeValue);
        }

        //TODO: maybe get search links
        // Returning the array
        return $titles;
    }
}