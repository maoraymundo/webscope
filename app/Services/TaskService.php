<?php

namespace App\Services;

use App\Task;
use DB;

class TaskService {

	public function getStats($userId)
	{
		return DB::table('tasks')
                 ->select('status', DB::raw('count(*) as total'))
                 ->where('user_id', $userId)
                 ->groupBy('status')
                 ->get();
	}

	public function getUserTasks($userId)
	{
		return Task::where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->get();
	}
}