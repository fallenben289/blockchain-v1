<?php declare(strict_types=1);

namespace Luno\Request;

class ListWithdrawals extends AbstractRequest
{
  /**
   * Filter to withdrawals requested on or before the withdrawal with this ID.
   * Can be used for pagination.
   */
  protected $before_id;

  /**
   * Limit to this many withdrawals
   */
  protected $limit;
  
  /**
   * @return int
   */
  public function getBeforeId(): int
  {
    if (!isset($this->before_id)) {
      return 0;
    }
    return $this->before_id;
  }

  /**
   * @param int $beforeId
   */
  public function setBeforeId(int $beforeId)
  {
    $this->before_id = $beforeId;
  }

  /**
   * @return int
   */
  public function getLimit(): int
  {
    if (!isset($this->limit)) {
      return 0;
    }
    return $this->limit;
  }

  /**
   * @param int $limit
   */
  public function setLimit(int $limit)
  {
    $this->limit = $limit;
  }
}

// vi: ft=php
