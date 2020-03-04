<?php

namespace Naskruty\DevTestSix\Component;

use Snowdog\DevTest\Model\PageManager;
use Snowdog\DevTest\Model\UserManager;
use Snowdog\DevTest\Model\WebsiteManager;

/**
 * Class Import
 * @package Naskruty\DevTestSix\Component
 */
class Import
{
    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * @var WebsiteManager
     */
    private $websiteManager;

    /**
     * @var PageManager
     */
    private $pageManager;

    /**
     * Import constructor.
     * @param UserManager $userManager
     * @param WebsiteManager $websiteManager
     * @param PageManager $pageManager
     */
    public function __construct(UserManager $userManager, WebsiteManager $websiteManager, PageManager $pageManager)
    {
        $this->userManager = $userManager;
        $this->websiteManager = $websiteManager;
        $this->pageManager = $pageManager;
    }

    /**
     * @param $url
     * @param $userLogin
     * @return bool
     */
    public function importPages($url, $userLogin){

        if (empty($url) or empty($userLogin)){
            return false;
        }
        $urls = json_decode(json_encode(simplexml_load_file($url) ), TRUE);
        if (empty($urls['url'])){
            return false;
        }
        $pagesArray = $this->preparePagesArray($urls['url']);
        if (empty($pagesArray)){
            return false;
        }
        $result = ['message' => ''];
        try {
            $user = $this->userManager->getByLogin($userLogin);
            foreach ($pagesArray as $host => $pages) {
                $websiteId = $this->websiteManager->create($user, $host, $host);
                if (empty($websiteId)) {
                    continue;
                }
                $i = 0;
                $website = $this->websiteManager->getById($websiteId);
                foreach ($pages as $page) {
                    $i++;
                    $this->pageManager->create($website, $page);
                }
                $result['message'] .= 'Added '.$host.' website with '.$i.' pages. ';
            }
            $result['status'] = 'OK';
            return $result;
        }catch(\Exception $e){
            return false;
        }
        return true;
    }

    /**
     * @param $urls
     * @return array|null
     */
    public function preparePagesArray($urls)
    {
        if (empty($urls)){
            return null;
        }
        $pages = [];
        foreach($urls as $url){
            if (empty($url['loc'])) {
                continue;
            }
            $urlParams = parse_url($url['loc']);

            $pageString = '';
            $pageString .= isset($urlParams['path']) ? ltrim($urlParams['path'], '/') : '';
            $pageString .= isset($urlParams['query']) ? '?' . $urlParams['query'] : '';

            if (empty($urlParams['host']) or empty($pageString)){
                continue;
            }
            $pages[$urlParams['host']][] = $pageString;
        }
        return $pages;
    }
}