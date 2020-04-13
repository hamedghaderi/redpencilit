<?php

function customizePostBody($body)
{
    $body = preg_replace("/&lt;style&gt;(.+)&lt;\/style&gt;/", '', $body);
    $body = preg_replace("/&lt;/", '<', $body);
    
    return preg_replace("/&gt;/", '>', $body);
}
