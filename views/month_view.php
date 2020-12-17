<div class="month">
    <div class="month_header"><?php echo("$monthName  $year")?></div>
    <table>
        <thead>
            <tr>
                <th>d</th>
                <th>l</th>
                <th>m</th>
                <th>m</th>
                <th>j</th>
                <th>v</th>
                <th>s</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i=0; $i < 42 ; $i++) {?>
                
                <?php if ($i % 7 == 0): //Si es el primer dia de la semana?>
                    <tr>
                <?php endif; ?>

                <?php if ($i == $first):
                    $first++;
                    $cursor++;
                endif; ?>

                <td>
                    <?php
                    if($cursor <= $max  && $cursor != 0):
                        echo($cursor);
                    endif;
                    ?>
                </td>
                
                <?php if ($i != 0 && $i / 7 == 0): //Si es el ultimo dia de la semana?>
                    </tr>
                <?php endif; ?>

            <?php }?>
        </tbody>
    </table>
</div>
