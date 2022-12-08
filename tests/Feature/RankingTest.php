<?php

use Database\Seeders\DatabaseSeeder;

test('Listar todos os meses, tamanho do grupo no mês, rank no mês', function () {

    $this->seed(DatabaseSeeder::class);

    ray()->showQueries();

    $groupId = 1;
    $userId  = 1;

    ray(
        DB::select("
select *
from (select *,
             dense_rank() over (partition by game_month order by points desc ) as `rank`
      from (select date_format(ds.created_at, '%Y-%m')                       as `game_month`,
                   sum(IF(date_format(ds.created_at, '%Y-%m') < date_format(g.created_at, '%Y-%m'), 0,
                          ds.points))                                        as `points`,
                   ds.user_id,
                   (select count(0)
                    from group_user gu
                    where gu.group_id = g.group_id
                      and date_format(gu.created_at, '%Y-%m') <= game_month) as `group_size`
            from `daily_scores` ds
                     inner join group_user g on ds.user_id = g.user_id
            where g.group_id = $groupId
            group by game_month
                   , ds.user_id
            order by game_month desc
                   , points desc) dg
      order by game_month desc
             , `rank`) `l`
where user_id = $userId")
    );

});
