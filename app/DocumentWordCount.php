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

        $document->getClientOriginalExtension() === 'doc' ?
            $this->readDoc($data)->words() :
            $this->readDocx($data)->words();

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

    function parseWord($userDoc)
    {

    }

    protected function readDoc($data)
    {
        if(($fh = fopen($data, 'r')) !== false )
        {
            $headers = fread($fh, 0xA00);
            // 1 = (ord(n)*1) ; Document has from 0 to 255 characters
            $n1 = ( ord($headers[0x21C]) - 1 );
            // 1 = ((ord(n)-8)*256) ; Document has from 256 to 63743 characters
            $n2 = ( ( ord($headers[0x21D]) - 8 ) * 256 );
            // 1 = ((ord(n)*256)*256) ; Document has from 63744 to 16775423 characters
            $n3 = ( ( ord($headers[0x21E]) * 256 ) * 256 );
            // 1 = (((ord(n)*256)*256)*256) ; Document has from 16775424 to 4294965504 characters
            $n4 = ( ( ( ord($headers[0x21F]) * 256 ) * 256 ) * 256 );
            // Total length of text in the document
            $textLength = ($n1 + $n2 + $n3 + $n4);
            $extracted_plaintext = fread($fh, $textLength);
            $extracted_plaintext = mb_convert_encoding($extracted_plaintext,'UTF-8');
            $extracted_plaintext = str_replace("HYPERLINK" ,"<a href=",$extracted_plaintext);
            $extracted_plaintext = str_replace("\o" ,">",$extracted_plaintext);
            // simple print character stream without new lines
            //echo $extracted_plaintext;
            // if you want to see your paragraphs in a new line, do this
            dd(nl2br($extracted_plaintext));
            return nl2br($extracted_plaintext);
            // need more spacing after each paragraph use another nl2br
        }
    }

    /**
     * @return int
     */
    protected function words() :int
    {
        dd($this->doc);
        preg_match_all('/[^\s\n]+/', $this->doc, $words);

        return (int)count($words[0]);
    }
}

