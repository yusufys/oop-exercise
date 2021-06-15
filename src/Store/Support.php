<?php


namespace Store;

/**
 * just a simple logger class
 * Class Support
 * @package Store
 */
class Support
{
    public static function capacityStatusMessage($message)
    {
        echo "<p style='color:#d24c4c;'>$message</p>";
    }

    public static function addItemMessage($message)
    {
        echo "<p style='color:#0141ff;'>$message</p>";
    }

    public static function fetchItemMessage($message)
    {
        echo "<p style='color:#4ca90e;'>$message</p>";
    }
}