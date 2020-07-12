<?php


namespace Model;


class Pagination
{
    private const DEFAULT_ITEMS_PER_PAGE = 10;

    private int $itemsPerPage;
    private int $page;
    private int $total;
    private int $totalPages;
    private int $next;
    private int $prev;

    public function __construct(int $page, int $total, int $itemsPerPage = self::DEFAULT_ITEMS_PER_PAGE)
    {
        $this->itemsPerPage = $itemsPerPage;
        $this->page = $page;
        $this->total = $total;
        $this->totalPages = (int)ceil($total / $itemsPerPage);
        $this->next = $page < $this->totalPages ? $page + 1 : $this->totalPages;
        $this->prev = $page > 1 ? $page - 1 : 1;
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    /**
     * @return int
     */
    public function getNext(): int
    {
        return $this->next;
    }

    /**
     * @return bool
     */
    public function hasNext(): bool
    {
        return $this->page < $this->totalPages;
    }

    /**
     * @return int
     */
    public function getPrev(): int
    {
        return $this->prev;
    }

    /**
     * @return bool
     */
    public function hasPrev(): bool
    {
        return $this->page > 1;
    }
}