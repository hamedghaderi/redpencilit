<?php

namespace App;

use DOMDocument;
use ZipArchive;

class DocumentWordCount
{
    protected $doc;

    /**
     * @param $document
     * @return int
     */
    public function countWords($document):int
    {
        $data = $document->getPathName();

        return $this->readDocx($data)->words();
    }

    /**
     * @param $data
     * @return DocumentWordCount
     */
    protected function readDocx($data)
    {
        $zip = new ZipArchive();

        if ($zip->open($data) === true) {
            // Search for the data file in the archive
            if (($index = $zip->locateName("word/document.xml")) !== false) {
                // If found readIt to the string
                $data = $zip->getFromIndex($index);
                $zip->close();

                // Load XML from a string
                // Skip Errors and warnings
                $xml = new DOMDocument('1.0', 'utf-8');
                $xml->formatOutput = true;
                $xml->loadXML($data, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                $this->doc = strip_tags($xml->saveXML());
                return $this;
            }
            $zip->close();
        }

        return $this;
    }

    /**
     * @return int
     */
    protected function words() :int
    {
        preg_match_all('/[^\s\n]+/', $this->doc, $words);

        return (int)count($words[0]);
    }
}

