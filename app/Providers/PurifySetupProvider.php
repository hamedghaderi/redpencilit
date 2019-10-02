<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stevebauman\Purify\Facades\Purify;

class PurifySetupProvider extends ServiceProvider
{
    const DEFINITION_ID = 'trix-editor';
    const DEFINITION_REV = 1;
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /** @var \HTMLPurifier $purifier */
        $purifier = Purify::getPurifier();
    
        /** @var \HTMLPurifier_Config $config */
        $config = $purifier->config;
    
        $config->set('HTML.DefinitionID', static::DEFINITION_ID);
        $config->set('HTML.DefinitionRev', static::DEFINITION_REV);
    
        if ($def = $config->maybeGetRawHTMLDefinition()) {
            $this->setupDefinitions($def);
        }
    
        $purifier->config = $config;
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    protected function setupDefinitions(\HTMLPurifier_HTMLDefinition $def)
    {
        $def->addElement('figure', 'Inline', 'Inline', 'Common');
        $def->addAttribute('figure', 'class', 'Text');
    
        $def->addElement('figcaption', 'Inline', 'Inline', 'Common');
        $def->addAttribute('figcaption', 'class', 'Text');
        $def->addAttribute('figcaption', 'data-trix-placeholder', 'Text');
    
        $def->addAttribute('a', 'rel', 'Text');
        $def->addAttribute('a', 'tabindex', 'Text');
        $def->addAttribute('a', 'contenteditable', 'Enum#true,false');
        $def->addAttribute('a', 'data-trix-attachment', 'Text');
        $def->addAttribute('a', 'data-trix-content-type', 'Text');
        $def->addAttribute('a', 'data-trix-id', 'Number');
    
        $def->addElement('span', 'Block', 'Flow', 'Common');
        $def->addAttribute('span', 'data-trix-cursor-target', 'Enum#right,left');
        $def->addAttribute('span', 'data-trix-serialize', 'Enum#true,false');
    
        $def->addAttribute('img', 'data-trix-mutable', 'Enum#true,false');
        $def->addAttribute('img', 'data-trix-store-key', 'Text');
    }
}
