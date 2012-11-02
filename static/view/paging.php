<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
 
$min = $paging->viewMin();
$max = $paging->viewMax();
$cur_page = $paging->curPage();
?>
<?php if ($paging->maxPage() > 1): ?>
<div class="paging">
    <?php if ($paging->reachStart()): ?><span>...</span><?php endif; ?>
    <?php for ($i = $min; $i <= $max; $i++): ?>
        <span class="<?= $i == $cur_page? 'on' : '' ?>">
            <a href="?p=<?= $i ?>"><?= $i ?></a>
        </span>
    <?php endfor; ?>
    <?php if ($paging->reachEnd()): ?><span>...</span><?php endif; ?>
    <?php if ($paging->hasNext()): ?><a href="?p=<?= $cur_page+1 ?>" class="next-page btn">下一页</a><?php endif; ?>
</div>
<?php endif; ?>
