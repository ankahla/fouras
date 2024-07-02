<?php


namespace Model;


class Pagination
{
    private const DEFAULT_ITEMS_PER_PAGE = 10;
    private readonly int $totalPages;
    private readonly int $next;
    private readonly int $prev;

    public function __construct(private readonly int $page, private readonly int $total, private readonly int $itemsPerPage = self::DEFAULT_ITEMS_PER_PAGE)
    {
        $this->totalPages = (int)ceil($this->total / $this->itemsPerPage);
        $this->next = $this->page < $this->totalPages ? $this->page + 1 : $this->totalPages;
        $this->prev = $this->page > 1 ? $this->page - 1 : 1;
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
