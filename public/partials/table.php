<table class="wplibcalhours">'
    <thead>
    <tr>
        <th colspan="3"><?php __('Hours', 'wplibcalhours'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php for ($i = 0, $n = count( $days ); $i < $n; $i ++): ?>
        <?php $day = $days[ $i ]; ?>
        <?php if ( $i && ! ( $i % 7 ) ) { ?>
            </tbody>
            <tbody class="hidden">
        <?php } ?>
        <?php $date = $day['date']; ?>
        <tr<?php $day['is_today'] ? ' class="today"' : '' ?>>
            <td><?php echo $date->format( 'l' ) ?></td>
            <td><?php echo $date->format( 'M j' ) ?></td>
            <td><?php echo $day['text']['hours'] ?></td>
        </tr>
    <?php endfor ?>
    </tbody>
</table>