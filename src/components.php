<?php

use Naskruty\DevTestSix\Menu\ImportPagesMenu;
use Naskruty\DevTestSix\Controller\SitemapPagesAction;
use Naskruty\DevTestSix\Controller\ImportSitemapPagesAction;

Menu::register(ImportPagesMenu::class, 20);

RouteRepository::registerRoute('GET', '/import', SitemapPagesAction::class, 'execute');
RouteRepository::registerRoute('POST', '/import', ImportSitemapPagesAction::class, 'execute');