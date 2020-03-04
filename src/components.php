<?php

use Snowdog\DevTest\Component\CommandRepository;
use Snowdog\DevTest\Component\Menu;
use Snowdog\DevTest\Component\RouteRepository;

use Naskruty\DevTestSix\Menu\ImportPagesMenu;
use Naskruty\DevTestSix\Controller\SitemapPagesAction;
use Naskruty\DevTestSix\Controller\ImportSitemapPagesAction;
use Naskruty\DevTestSix\Command\ImportCommand;

Menu::register(ImportPagesMenu::class, 20);

RouteRepository::registerRoute('GET', '/import', SitemapPagesAction::class, 'execute');
RouteRepository::registerRoute('POST', '/import', ImportSitemapPagesAction::class, 'execute');

CommandRepository::registerCommand('import [url] [user]', ImportCommand::class);