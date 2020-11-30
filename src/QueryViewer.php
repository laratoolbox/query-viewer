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
            $binding = str_replace(
                ["'", "\\"],
                ["\'", "\\\\"],
                $binding
            );

            if (is_bool($binding)) {
                $binding = (int) $binding;
            }

            if (!is_numeric($binding)) {
                $binding = "'$binding'";
            }

            $sql = preg_replace('/\?/', $binding, $sql, 1);
        }

        return $sql;
    }
}
