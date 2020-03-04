<?php

namespace Naskruty\DevTestSix\Menu;

class ImportPagesMenu extends AbstractMenu
{

    public function isActive()
    {
        return $_SERVER['REQUEST_URI'] == '/import';
    }

    public function getHref()
    {
        return '/import';
    }

    public function getLabel()
    {
        return 'Sitemap pages import';
    }
}