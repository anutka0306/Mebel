<?php
exit();
function print_debug($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function translit($str) {
    //$str = preg_replace('![^\w\d\s]*!','',$str);
    $rus = array(
        'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
        'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
        ' ', '?', '!', '.', ',','_','--','<h1>','</h1>','<H1>','</H1>');
    $lat = array(
        'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya',
        'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya',
        '-', '', '', '', '', '_', '_','','','','');

    $translit = trim(str_replace($rus, $lat, $str));
    $translit = str_replace(array('(', ')'), '', $translit);
    return $translit;
}

/*$user = 'root';
$pass = '';
$db = 'mebel';*/

$user = 'anutkaay_mebel';
$pass = 'W*B4aXdp';
$db = 'anutkaay_mebel';

$connect = mysqli_connect('localhost', $user, $pass, $db) or die("Don't connect");

$category_name = 'Меблировка';
$query = mysqli_query($connect, "SELECT * FROM `category` WHERE `h1` = '{$category_name}'");
while($row = mysqli_fetch_assoc($query)){
    $category_path = $row['alias'];
    $category_id = $row['id'];
}

$sections_query  = mysqli_query($connect, "SELECT * FROM `category_section` WHERE `category_id_id` = ".$category_id);
$category_sections = array();
while($row = mysqli_fetch_assoc($sections_query)){
   $category_sections[$row['name']] = $row['id'];
}


$subsections = array(
    'Меблировка квартиры под ключ' => array('Для физ. лиц'),
    'ПМеблировка коттеджей под ключ' => array('Для физ. лиц'),
    'Меблировка студии под ключ'=> array('Для физ. лиц'),
    'Меблировка дома под ключ' => array('Для физ. лиц'),
    'Меблировка дачи под ключ' => array('Для физ. лиц'),
    'Меблировка комнаты под ключ'=> array('Для физ. лиц'),
    'Меблировка прихожей под ключ' => array('Для физ. лиц'),
    'Меблировка гостиной под ключ' => array('Для физ. лиц'),
    'Меблировка спальни под ключ'=> array('Для физ. лиц'),
    'Меблировка кухни под ключ' => array('Для физ. лиц'),
    'Меблировка ванной комнаты под ключ' => array('Для физ. лиц'),
    'Меблировка детской комнаты под ключ'=> array('Для физ. лиц'),

    'Меблировка баров под ключ' =>array('Для юр. лиц'),
    'Меблировка ресторанов под ключ' => array('Для юр. лиц'),
    'Меблировка кафе под ключ' => array('Для юр. лиц'),
    'Меблировка магазинов под ключ' =>array('Для юр. лиц'),
    'Меблировка бутика под ключ' => array('Для юр. лиц'),
    'Меблировка гостиниц под ключ' => array('Для юр. лиц'),
    'Меблировка офиса под ключ' =>array('Для юр. лиц'),
    'Меблировка помещения под ключ' => array('Для юр. лиц'),
    'Меблировка ресепшн под ключ' => array('Для юр. лиц'),
    'Меблировка переговорной под ключ' =>array('Для юр. лиц'),
    'Меблировка кабинета под ключ' => array('Для юр. лиц'),
    'Меблировка опенспейса под ключ' => array('Для юр. лиц'),
);

foreach ($subsections as $key => $subsection){
    $subsection_path = $category_path.translit($key).'/';
    $subsection_parent = $category_id;
    $subsection_section = $category_sections[$subsection[0]];
    //здесь должна быть вставка подраздела и получение его id
    mysqli_query($connect, "INSERT INTO `subcategory` (`parent_id`, `h1`, `title`, `description`, `seo_text`, `seo_text_hidden`, `seo_img`, `alias`, `category_section_id_id`) VALUES ({$subsection_parent}, '{$key}', NULL, NULL, NULL, NULL, NULL, '{$subsection_path}', {$subsection_section})") or die('ERROR!');
    $subsection_id = mysqli_insert_id($connect);

    if(isset($subsection[1])){
        foreach ($subsection[1] as $service){
            $service_path = $subsection_path.translit($service).'/';
            $service_parent_id = $subsection_id;
            mysqli_query($connect, "INSERT INTO `service` (`subcategory_id_id`, `h1`, `title`, `description`, `seo_img`, `alias`, `seo_text`, `seo_text_hidden`) VALUES ({$subsection_id}, '{$service}', NULL, NULL, NULL, '{$service_path}', NULL, NULL )") or die('ERROR1');
        }
    }

}


