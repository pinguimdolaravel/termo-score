<?php

namespace App\Reports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MonthlyScore
{
    private $group;

    private $user;

    public function setGroup($groupId): static
    {
        $this->group = $groupId;

        return $this;
    }

    public function setUser($userId): static
    {
        $this->user = $userId;

        return $this;
    }

    public function run()
    {
        $this->validate();

        return \Cache::remember("group::$this->group::user::$this->user", '5000', fn () => $this->query());
    }

    private function validate()
    {
        Validator::make(
            ['group' => $this->group, 'user' => $this->user],
            ['group' => 'required', 'user' => 'required']
        )
            ->validate();
    }

    private function query()
    {
        return DB::select("select *
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
            where g.group_id = $this->group
            group by game_month
                   , ds.user_id
            order by game_month desc
                   , points desc) dg
      order by game_month desc
             , `rank`) `l`
where user_id = $this->user");
    }

}
