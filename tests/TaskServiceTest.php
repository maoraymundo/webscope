<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Services\TaskService;
use App\Task;
use App\User;
use App\Http\Controllers\TaskController;

class TaskServiceTest extends TestCase
{
    public function testSaveUserWithEmptyRequest()
    {
    	$open = new \stdClass();
    	$open->status = 1;
    	$open->total = 1;

    	$closed = new \stdClass();
    	$closed->status = 2;
    	$closed->total = 0;

    	$task = new \stdClass();
    	$task->id = 1;
    	$task->body = 'test';
    	$task->user_id = 1;
    	$task->status = 1;

    	$stats = [
    		$open,
    		$closed
    	];

    	$tasks = [];
        $taskServiceMock = $this->createMock(TaskService::class);

        $taskServiceMock->expects($this->any())
        	->method('getStats')
        	->willReturn($stats);

        $taskServiceMock->expects($this->any())
        	->method('getUserTasks')
        	->willReturn([$task]);

        $user = new User(array('id' => 1));
		$this->be($user); 

        $taskController = new TaskController($taskServiceMock);
        $response = $taskController->index();

        $expected = [
        	'tasks' => [$task],
        	'stats' => $stats
        ];

        $actual = $response->getData();

        $this->assertEquals($expected, $actual);
    }
}
