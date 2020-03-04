<?php

namespace Naskruty\DevTestSix\Controller;

use Snowdog\DevTest\Model\User;
use Snowdog\DevTest\Model\UserManager;
use Snowdog\DevTest\Model\WebsiteManager;

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

    public function __construct(UserManager $userManager, WebsiteManager $websiteManager)
    {
        $this->userManager = $userManager;
        $this->websiteManager = $websiteManager;
    }

    public function execute()
    {
        $url = $_POST['sitemap_url'];

        if (!empty($url)) {
            if (isset($_SESSION['login'])) {

            }
        } else {
            $_SESSION['flash'] = 'Sitemap URL cannot be empty!';
        }

        header('Location: /import');
    }
}