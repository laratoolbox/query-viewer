<?php

namespace LaraToolbox\QueryViewer;

class QueryViewer
{
    /**
     * Replaces question marks with bindings in given sql.
     *
     * Originally Taken from: https://gist.github.com/JesseObrien/7418983
     *
     * @param string $sql
     * @param array $bindings
     * @return string
     */
    public static function replaceBindings(string $sql, array $bindings)
    {
        foreach ($bindings as $binding) {
            $value = is_numeric($binding) ? $binding : "'".$binding."'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }

        return $sql;
    }
}
