<?php

namespace LaraToolbox\QueryViewer;

class QueryBuilderMixin
{
    /**
     * Returns sql query with binding replaced!
     *
     * @param ?\Closure $callable
     * @return
     */
    public function getSql()
    {
        return function ($callable = null) {
            $sql = QueryViewer::replaceBindings(
                $this->toSql(),
                $this->getBindings()
            );

            if (is_null($callable)) {
                return $sql;
            }

            return $callable($sql);
        };
    }

    /**
     * Dump sql
     *
     * @return
     */
    public function dumpSql()
    {
        return function () {
            dump($this->getSql());

            return $this;
        };
    }

    /**
     * Log sql
     *
     * @param null|string $prefix
     * @return
     */
    public function logSql()
    {
        return function ($prefix = null) {
            logger()->{config('query-viewer.log_type')}($prefix.' : '.$this->getSql());

            return $this;
        };
    }
}
