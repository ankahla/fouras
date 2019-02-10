<?php 
namespace AppBundle\Entity\QueryBuilder;

class ArticleQueryBuilder
{
    const DEFAULT_FIELDS = [
        'id',
        'title',
        'alias',
        'introtext',
        'catid',
        'category_title',
        'images',
        'created',
    ];

    private $fields;
    private $articleId;
    private $categoryIds;
    private $featured;
    private $tag;
    private $search;
    private $createdBy;
    private $limit;
    private $start;
    private $page;
    private $sort;
    private $sortDirection;
    private $locale;
    private $apiKey;

    function __construct()
    {
        $this->fields = self::DEFAULT_FIELDS;
        $this->start = 0;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setArticleId($id)
    {
        $this->articleId = $id;

        return $this;
    }

    /**
     * @param int $id
     */
    public function setCategoryIds($ids)
    {
        $this->categoryIds = $ids;

        return $this;
    }

    /**
     * @param bool $isFeatured
     *
     * @return self
     */
    public function setFeatured($isFeatured)
    {
        $this->featured = $isFeatured;

        return $this;
    }

    /**
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @param string $search
     *
     * @return self
     */
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * @param int $createdBy
     *
     * @return self
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @param int $limit
     *
     * @return self
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @param int $start
     *
     * @return self
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @param int $page
     *
     * @return self
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @param string $sort
     *
     * @return self
     */
    public function setSort($sortField, $direction = 'desc')
    {
        $this->sort = $sortField;
        $this->sortDirection = ($direction == 'asc' ? 'asc' : 'desc');

        return $this;
    }

    /**
     * @param string $locale
     *
     * @return self
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @param string $apiKey
     *
     * @return self
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @param string $field
     * 
     * @return self
     */
    public function addField($field)
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * @param array $fields
     * 
     * @return self
     */
    public function setFields($fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function getQuery()
    {
        $query = [];

        if ($this->apiKey) {
            $query['key'] = $this->apiKey;
        }

        if ($this->articleId) {
            $query['id'] = $this->articleId;
        }

        if ($this->categoryIds) {
            $query['category_id'] = $this->categoryIds;
        }

        if ($this->fields) {
            $query['fields'] = implode(',', $this->fields);
        }

        if ($this->featured !== null) {
            $query['featured'] = $this->featured ? '1' : '0';
        }

        if ($this->tag) {
            $query['tag'] = $this->tag;
        }

        if ($this->search) {
            $query['search'] = $this->search;
        }

        if ($this->createdBy) {
            $query['created_by'] = $this->created_by;
        }

        if ($this->limit) {
            $query['limit'] = $this->limit;
        }

        if ($this->start) {
            $query['start'] = $this->start;
        }

        if ($this->page) {
            $query['p'] = $this->page;
        }

        if ($this->sort) {
            $query['sort'] = $this->sort;
            $query['listOrder'] = $this->sortDirection;
        }

        if ($this->locale) {
            $query['lang'] = $this->locale;
        }

        return $query;
    }
}
 