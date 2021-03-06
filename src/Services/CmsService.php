<?php
/**
* class CmsService
*
* @author Anouar Kahla <kahla.anouar@yahoo.fr>
* @version 1.0
* @package Gravatar
*/

namespace Services;

use Model\QueryBuilder\ArticleQueryBuilder;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Symfony\Component\HttpFoundation\RequestStack;

class CmsService
{
    const ARTICLE_URI = 'articles/article';
    const CATEGORY_URI = 'categories/categories';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var int
     */
    private $blogCatId;

    /**
     * @var int
     */
    private $newsCatId;

    /**
     * @var int
     */
    private $faqCatId;

    /**
     * @var int
     */
    private $galleryCatId;

    public function __construct(Client $client, $apiKey, RequestStack  $requestStack, $catIds)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->locale = $requestStack->getCurrentRequest()->getLocale();
        $this->blogCatId = isset($catIds['blog'][$this->locale]) ? $catIds['blog'][$this->locale] : reset($catIds['blog']);
        $this->newsCatId = isset($catIds['news'][$this->locale]) ? $catIds['news'][$this->locale] : reset($catIds['news']);
        $this->faqCatId = isset($catIds['faq'][$this->locale]) ? $catIds['faq'][$this->locale] : reset($catIds['faq']);
        $this->galleryCatId = isset($catIds['gallery'][$this->locale]) ? $catIds['gallery'][$this->locale] : reset($catIds['gallery']);
    }

    /**
     * Get articles from cms
     */
    public function getArticles(ArticleQueryBuilder $qb)
    {
        $results = [];

        $qb
            ->setApiKey($this->apiKey)
            ->setlocale($this->locale);

        try {
            $response = $this->client->get(self::ARTICLE_URI, [RequestOptions::QUERY => $qb->getQuery()]);
            $contents = json_decode($response->getBody()->getContents());
            if ($contents->data->success == true) {
                $results = $contents->data->data;
            }
        } catch (\Exception $e) {
            // @todo inject logger
            //$e->getMessage()
            return [];
        }

        return $results;
    }

    public function getCategories($parentId)
    {
        $results = [];
        try {
            $response = $this->client->get(self::CATEGORY_URI, [RequestOptions::QUERY =>
                [
                    'id' => $parentId,
                    'key' => $this->apiKey,
                    'lang' => $this->locale,
                ]
            ]);
            $contents = json_decode($response->getBody()->getContents());

            if (empty($contents->err_code)) {
                $results = $contents->data;
            } else {
                throw new \Exception(isset($contents->err_msg)? $contents->err_msg : 'error when getting categories');
            }
        } catch (\Exception $e) {
            // @todo inject logger
            //$e->getMessage()
            return [];
        }

        return $results;
    }

    public function getBlogCategories()
    {
        return $this->getCategories($this->blogCatId);
    }

    public function getFaqCategories()
    {
        return $this->getCategories($this->faqCatId);
    }

    public function getGalleryCategories()
    {
        return $this->getCategories($this->galleryCatId);
    }

    public function getDefaultNewsQueryBuilder()
    {
        $qb = new ArticleQueryBuilder();
        return $qb
            ->setCategoryIds([$this->newsCatId])
            ->setSort('modified')
            ->setFields(['id', 'alias', 'title', 'created', 'images']);
    }

    public function getDefaultBlogQueryBuilder()
    {
        $qb = new ArticleQueryBuilder();

        return $qb
            ->setCategoryIds([$this->blogCatId])
            ->setSort('modified');
    }

    public function getDefaultFaqQueryBuilder()
    {
        $qb = new ArticleQueryBuilder();

        return $qb
            ->setFields(['id', 'alias', 'title', 'introtext'])
            ->setCategoryIds([$this->faqCatId])
            ->setSort('created', 'asc');
    }
}
