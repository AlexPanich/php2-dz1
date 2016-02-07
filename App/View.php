<?php


namespace App;


class View
    implements \Countable
{
    use Magic;

    public function render($template)
    {
        ob_start();
        foreach ( $this->data as $prop => $value ) {
            $$prop = $value;
        }
        include $template;
        return ob_get_clean();
    }

    public  function display($template)
    {
        echo $this->render($template);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        return count($this->data);
    }
}