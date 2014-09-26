<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @file
 * Digunakan untuk Membersihkan tag html yg salah. biasanya digunakan untuk membersihan html hasil inputan user
 * @param $dirty_html string html
 * $return string text / html yg sudah di bersihkan
 */
function purify($dirty_html)
{

     if (is_array($dirty_html))
    {
        foreach ($dirty_html as $key => $val)
        {
            $dirty_html[$key] = purify($val);
        }

        return $dirty_html;
    }

    if (trim($dirty_html) === '')
    {
        return $dirty_html;
    }

    require_once(APPPATH."helpers/htmlpurifier/HTMLPurifier.auto.php"); 
    require_once(APPPATH."helpers/htmlpurifier/HTMLPurifier.func.php");

    $config = HTMLPurifier_Config::createDefault();

    $config->set('HTML.Doctype', 'XHTML 1.0 Strict');

    return HTMLPurifier($dirty_html, $config);

}
?>