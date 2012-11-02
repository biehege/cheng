<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

switch ($target) {
    case '':
        list(
            $name,
            $no,
            $type,
            $sort1,
            $sort2) = _get(
                'name',
                'no',
                'type',
                'sort1',
                'sort2');

        $sort = $sort1 ? $sort1 . ' ' . $sort2 : '';

        $types = Product::types();

        $p = _get('p') ?: 1;
        $per_page = 50;
        $total = Product::count(array(
            'name' => $name,
            'no'   => $no,
            'type' => $type));
        $paging = new Paginate($per_page, $total);
        $paging->setCurPage($p);
        $products = Product::listProduct(array(
            'limit' => $per_page,
            'offset' => $paging->offset(),
            'name' => $name,
            'no'   => $no,
            'type' => $type,
            'sort' => $sort));
        break;
    case 'post':
        list(
            $name,
            $no,
            $type,
            $material,
            $weight,
            $rabbet_start,
            $rabbet_end,
            $small_stone,
            $remark,
            $image1,
            $image2,
            $image3
        ) = _post(
            'name',
            'no',
            'type',
            'material',
            'weight',
            'rabbet_start',
            'rabbet_end',
            'small_stone',
            'remark',
            'image1',
            'image2',
            'image3');
        $material = _post('material');
        if ($material) {
            $material = array_values($material);
        } else {
            $material = array();
        }
        $material = json_encode($material);

        if ($by_post) {
            $admin->postProduct(compact(
                'name',
                'no',
                'type',
                'material',
                'weight',
                'rabbet_start',
                'rabbet_end',
                'small_stone',
                'remark',
                'image1',
                'image2',
                'image3'));
            redirect('product');
        }

        break;
    case 'batch':
        break;
    
    default:
        throw new Exception("unkown: $target");
        break;
}

$matter = $view . ($target ? '.' . $target : '');
$view = 'board?master';
