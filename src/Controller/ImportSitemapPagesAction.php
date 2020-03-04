<?php

namespace Naskruty\DevTestSix\Controller;

use Snowdog\DevTest\Model\User;
use Snowdog\DevTest\Model\UserManager;
use Snowdog\DevTest\Model\WebsiteManager;
use Naskruty\DevTestSix\Component\Import;

class SitemapPagesAction
{
    /**
     * @var UserManager
     */
    private $userManager;
    /**
     * @var WebsiteManager
     */
    private $websiteManager;

    private $import;

    public function __construct(UserManager $userManager, WebsiteManager $websiteManager, Import $import)
    {
        $this->userManager = $userManager;
        $this->websiteManager = $websiteManager;
        $this->import = $import;
    }

    public function execute()
    {
        if (!isset($_SESSION['login'])) {
            header('Location: /login');
            return;
        }

        $url = $_POST['sitemap_url'];
        if (empty($url)) {
            $_SESSION['flash'] = 'Sitemap URL cannot be empty!';
            header('Location: /import');
            return;
        }

        $res = $this->import->importPages($url);


        header('Location: /import');
    }
}