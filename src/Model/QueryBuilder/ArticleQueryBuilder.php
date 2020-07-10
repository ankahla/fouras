<?php
namespace Model\QueryBuilder;

class ArticleQueryBuilder
{
    private const DEFAULT_FIELDS = [
        'id',
        'title',
        'alias',
        'introtext',
        'catid',
        'category_title',
        'images',
        'created',
    ];

    /**
     * @var array
     */
    private $fields;

    /**
     * @var string
     */
    private $articleId;

    /**
     * @var array
     */
    private $categoryIds;

    /**
     * @var string
     */
    private $featured;

    /**
     * @var string
     */
    private $tag;

    /**
     * @var string
     */
    private $search;

    /**
     * @var string
     */
    private $createdBy;

    /**
     * @var string
     */
    private $limit;

    /**
     * @var string
     */
    private $start;

    /**
     * @var string
     */
    private $page;

    /**
     * @var string
     */
    private $sort;

    /**
     * @var string
     */
    private $sortDirection;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * ArticleQueryBuilder constructor.
     */
    public function __construct()
    {
        $this->fields = self::DEFAULT_FIELDS;
        $this->start = '0';
    }

    /**
     * @param string $articleId
     *
     * @return self
     */
    public function setArticleId(string $articleId): self
    {
        $this->articleId = $articleId;

        return $this;
    }

    /**
     * @param array $categoryIds
     *18:18
     * @return self
     */
    public function setCategoryIds(array $categoryIds): self
    {
        $this->categoryIds = $categoryIds;

        return $this;
    }

    /**
     * @param string $featured
     *
     * @return self
     */
    public function setFeatured(string $featured): self
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * @param string $tag
     * @return self
     */
    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @param string $search
     *
     * @return self
     */
    public function setSearch(string $search): self
    {
        $this->search = $search;

        return $this;
    }

    /**
     * @param string $createdBy
     *
     * @return self
     */
    public function setCreatedBy(string $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @param string $limit
     *
     * @return self
     */
    public function setLimit(string $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @param string $start
     *
     * @return self
     */
    public function setStart(string $start): self
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @param string $page
     *
     * @return self
     */
    public function setPage(string $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @param string $sortDirection
     *
     * @return self
     */
    public function setSortDirection(string $sortDirection): self
    {
        $this->sortDirection = $sortDirection;

        return $this;
    }

    /**
     * @param string $locale
     *
     * @return self
     */
    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @param string $apiKey
     *
     * @return self
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @param string $sortField
     * @param string $direction
     *
     * @return self
     */
    public function setSort($sortField, $direction = 'desc'): self
    {
        $this->sort = $sortField;
        $this->sortDirection = ($direction === 'asc' ? 'asc' : 'desc');

        return $this;
    }

    /**
     * @param string $field
     *
     * @return self
     */
    public function addField($field): self
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * @param array $fields
     *
     * @return self
     */
    public function setFields($fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @return array
     */
    public function getQuery(): array
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
            $query['created_by'] = $this->createdBy;
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
