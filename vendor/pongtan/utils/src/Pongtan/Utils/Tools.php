<?php

namespace Pongtan\Utils;

 

class Tools
{

    /**
     * 根据流量值自动转换单位输出
     * @param int
     * @return string
     */
    static function flowAutoShow($value = 0)
    {
        $kb = 1024;
        $mb = 1048576;
        $gb = 1073741824;
        if ($value > $gb) {
            return round($value / $gb, 2) . "GB";
        }
        if ($value > $mb) {
            return round($value / $mb, 2) . "MB";
        }
        if ($value > $kb) {
            return round($value / $kb, 2) . "KB";
        } else {
            return round($value, 2);
        }
    }


    /**
     * 获取随机字符串
     * @param int $length
     * @return string
     */
    public static function genRandomChar($length = 8)
    {
        // 密码字符集，可任意添加你需要的字符
        //$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $char = '';
        for ($i = 0; $i < $length; $i++) {
            $char .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $char;
    }

    public static function genCode($length = 32)
    {
        return self::genRandomChar($length);
    }

    // Unix time to Date Time
    /***
     * @param $time
     * @return bool|string
     */
    static function toDateTime($time)
    {
        return date('Y-m-d H:i:s', $time);
    }

    // check html
    static function checkHtml($html)
    {
        $html = stripslashes($html);
        preg_match_all("/<([^<]+)>/is", $html, $ms);
        $searchs[] = '<';
        $replaces[] = '<';
        $searchs[] = '>';
        $replaces[] = '>';
        if ($ms[1]) {
            $allowtags = 'img|a|font|div|table|tbody|caption|tr|td|th|br
						|p|b|strong|i|u|em|span|ol|ul|li|blockquote
						|object|param|embed';//允许的标签
            $ms[1] = array_unique($ms[1]);
            foreach ($ms[1] as $value) {
                $searchs[] = "<" . $value . ">";
                $value = shtmlspecialchars($value);
                $value = str_replace(array('/', '/*'), array('.', '/.'), $value);
                $skipkeys = array(
                    'onabort', 'onactivate', 'onafterprint', 'onafterupdate',
                    'onbeforeactivate', 'onbeforecopy', 'onbeforecut',
                    'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste',
                    'onbeforeprint', 'onbeforeunload', 'onbeforeupdate',
                    'onblur', 'onbounce', 'oncellchange', 'onchange',
                    'onclick', 'oncontextmenu', 'oncontrolselect',
                    'oncopy', 'oncut', 'ondataavailable',
                    'ondatasetchanged', 'ondatasetcomplete', 'ondblclick',
                    'ondeactivate', 'ondrag', 'ondragend',
                    'ondragenter', 'ondragleave', 'ondragover',
                    'ondragstart', 'ondrop', 'onerror', 'onerrorupdate',
                    'onfilterchange', 'onfinish', 'onfocus', 'onfocusin',
                    'onfocusout', 'onhelp', 'onkeydown', 'onkeypress',
                    'onkeyup', 'onlayoutcomplete', 'onload',
                    'onlosecapture', 'onmousedown', 'onmouseenter',
                    'onmouseleave', 'onmousemove', 'onmouseout',
                    'onmouseover', 'onmouseup', 'onmousewheel',
                    'onmove', 'onmoveend', 'onmovestart', 'onpaste',
                    'onpropertychange', 'onreadystatechange', 'onreset',
                    'onresize', 'onresizeend', 'onresizestart',
                    'onrowenter', 'onrowexit', 'onrowsdelete',
                    'onrowsinserted', 'onscroll', 'onselect',
                    'onselectionchange', 'onselectstart', 'onstart',
                    'onstop', 'onsubmit', 'onunload', 'javascript',
                    'script', 'eval', 'behaviour', 'expression',
                    'style', 'class'
                );
                $skipstr = implode('|', $skipkeys);
                $value = preg_replace(array("/($skipstr)/i"), '.', $value);
                if (!preg_match("/^[/|s]?($allowtags)(s+|$)/is", $value)) {
                    $value = '';
                }
                $replaces[] = empty($value) ? '' : "<" . str_replace('"', '"', $value) . ">";
            }
        }
        $html = str_replace($searchs, $replaces, $html);
        $html = addslashes($html);
        return $html;
    } 

    public static function newTradeNum()
    {
        $tradeNum = sprintf('%d%d', time(), mt_rand(1000, 9999));
        return $tradeNum;
    }
}