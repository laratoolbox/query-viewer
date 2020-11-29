<?php

namespace LaraToolbox\QueryViewer;

class QueryBuilderMixin
{
    /**
     * Returns sql query with binding replaced!
     *
     * Originally Taken from: https://gist.github.com/JesseObrien/7418983
     *
     * @return string
     */
    public function getSql()
    {
        return function () {
            $sql = $this->toSql();

            foreach ($this->getBindings() as $binding) {
                $value = is_numeric($binding) ? $binding : "'".$binding."'";
                $sql = preg_replace('/\?/', $value, $sql, 1);
            }

            return $sql;
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
    public function logSql($prefix = null)
    {
        return function ($prefix) {
            logger()->{config('query-viewer.log_type')}($prefix. ' : '.$this->getSql());

            return $this;
        };
    }

    /**
     * This method takes closure and gives sql as its parameter.
     * Can be used for custom logging.
     *
     * Example:
     * Model::select(a, b, c)->getSqlFunc(function($sql){ logger()->error($sql); })->get();
     *
     * @param null|\Closure $func
     * @return
     */
    public function getSqlFunc($func = null)
    {
        return function ($func) {
            $func($this->getSql());

            return $this;
        };
    }
}
