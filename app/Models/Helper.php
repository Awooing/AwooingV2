<?php


namespace Awoo\Misc;


class Helper
{

    /**
     * @param $content
     * @return string
     */
    public function awooIt($content): string
    {
        $string = str_replace(":awooo:", "<img alt='Awooo' class='awoo' src='https://cdn.discordapp.com/emojis/322522663304036352.png?v=1'>", $content);
        $string = str_replace(":Awooleft:", "<img alt='Awoo Left' class='awoo' src='https://cdn.discordapp.com/emojis/678290859422384135.png?v=1'>", $string);
        $string = str_replace(":Awooright:", "<img alt='Awoo Right' class='awoo' src='https://cdn.discordapp.com/emojis/678290876165914665.png?v=1'>", $string);
        $string = str_replace(":AwoooXMAS:", "<img alt='Christmas Awoo' class='awoo' src='https://cdn.discordapp.com/emojis/659215388936241172.png?v=1'>", $string);
        $string = str_replace(":DestroyerAwoo:", "<img alt='Destroyer Awoo' class='awoo' src='https://cdn.discordapp.com/emojis/694634291052806290.png?v=1'>", $string);
        return $string;
    }
}