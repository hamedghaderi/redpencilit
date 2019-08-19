<?php

namespace App;

use DOMDocument;
use ZipArchive;

class DocumentWordCount
{

    protected $doc;
    protected $data;
    protected $files;
    protected $words = 0;

    /**
     * DocumentWordCount constructor.
     *
     * @param $files
     */
    public function __construct($files)
    {
        $this->files = $files;
    }

    /**
     * Get an array of files and return new instance of itself.
     *
     * @param $files
     *
     * @return DocumentWordCount
     */
    public static function files($files)
    {
        return new static($files);
    }

    /**
     * Get a file, transform to array and return a new instance of itself.
     *
     * @param $file
     *
     * @return DocumentWordCount
     */
    public static function file($file)
    {
        return new static([$file]);
    }

    /**
     * Count the words for array of files.
     *
     * @return int
     */
    public function countWords(): int
    {
        foreach ($this->files as $file) {
            $data = $file->getPathName();

            $this->words += $this->readDocx($data)->words();
        }

        return $this->words;
    }

    /**
     * Read a docx document.
     *
     * @param $data
     *
     * @return DocumentWordCount
     */
    protected function readDocx($data)
    {
        $this->data = $data;
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
                $xml->loadXML($data,
                    LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR
                    | LIBXML_NOWARNING);
                $this->doc = strip_tags($xml->saveXML());

                return $this;
            }
            $zip->close();
        }

        return $this;
    }

    /**
     * Count the words of a file.
     *
     * @return int
     */
    protected function words(): int
    {
        // [^\s\n,\.\-_:%\(\)\^\!\?\*]+
        preg_match_all('/[^\w\s_\.\(\)\:]+/', $this->doc, $words);

        return (int) count($words[0]);
    }
}

