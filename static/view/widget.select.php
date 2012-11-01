<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
if (!isset($field_name))
    $field_name = 'type';
if (!isset($default_value))
    $default_value = '';
if (!isset($data)) {
    $data = ${$field_name . 's'};
}
?>
<select name="<?= $field_name ?>">
    <option value="<?= $default_value ?>" <?= $$field_name == 'all' ? 'selected' : '' ?> >全部</option>
    <?php foreach ($data as $key => $value): ?>
        <option value="<?= $key ?>" <?= $$field_name == $key ? 'selected' : '' ?> ><?= $value ?></option>
    <?php endforeach ?>
</select>
