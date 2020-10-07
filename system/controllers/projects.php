<?php
/*
|--------------------------------------------------------------------------
| Controller
|--------------------------------------------------------------------------
|
*/
_auth();

$ui->assign('_application_menu', 'projects');
$ui->assign('_title', $_L['Projects'] . '- ' . $config['CompanyName']);
$ui->assign('_st', $_L['Projects']);
$action = route(1, 'list');
$user = User::_info();
$ui->assign('user', $user);
$ui->assign('action', $action);

if (!has_access($user->roleid, 'projects', 'view')) {
    permissionDenied();
}

switch ($action) {
    case 'list':
        $projects = Project::orderBy('id', 'desc')
            ->limit(100)
            ->get();

        $staffs = User::all()
            ->keyBy('id')
            ->all();
        $contacts = Contact::all()
            ->keyBy('id')
            ->all();

        $project_ids = [];

        foreach ($projects as $project) {
            $project_ids[] = $project->id;
        }

        $tasks = Task::whereIn('pid', $project_ids)
            ->select('id', 'pid', 'status')
            ->get()
            ->groupBy('pid')
            ->all();

        $tasks_status = [];

        foreach ($projects as $project) {
            if (isset($tasks[$project->id])) {
                $tasks_count = 0;
                $task_completed = 0;
                foreach ($tasks[$project->id] as $task) {
                    $tasks_count++;
                    if (
                        $task->status == 'Completed' ||
                        $task->status == 'Archived'
                    ) {
                        $task_completed++;
                    }
                }

                $tasks_status[$project->id] = [
                    'total' => $tasks_count,
                    'completed' => $task_completed,
                ];
            }
        }

        \view('projects_list', [
            'projects' => $projects,
            'staffs' => $staffs,
            'contacts' => $contacts,
            'tasks_status' => $tasks_status,
        ]);

        break;

    case 'project':
        $project = false;

        $id = route(2, false);

        $members = [];

        if ($id) {
            $project = Project::find($id);

            if ($project && $project->members) {
                $members = json_decode($project->members, true);
            }
        }

        $contacts = Contact::all();
        $staffs = User::all();
        $currencies_all = Currency::getAllCurrencies();
        $currencies = Currency::all();

        \view('projects_project', [
            'project' => $project,
            'contacts' => $contacts,
            'staffs' => $staffs,
            'currencies' => $currencies,
            'currencies_all' => $currencies_all,
            'members' => $members,
        ]);

        break;

    case 'project-save':
        if (!has_access($user->roleid, 'transactions', 'create')) {
            permissionDenied();
        }
        $validator = new Validator();
        $data = $request->all();
        $validation = $validator->validate($data, [
            'name' => 'required',
        ]);

        if ($validation->fails()) {
            $message = '';
            foreach ($validation->errors()->all() as $key => $value) {
                $message .= $value . ' <br> ';
            }
            // validation failed
            responseWithError($message);
        } else {
            if (isset($data['id']) && $data['id'] != '') {
                $project = Project::find($data['id']);
            } else {
                $project = new Project();
            }

            $project->name = $data['name'];
            $project->contact_id = $data['contact_id'];
            $project->project_manager_id = $data['project_manager_id'];
            $project->start_date = $data['start_date'];
            $project->due_date = $data['due_date'];
            $project->description = $data['description'];
            $project->status = $data['status'];
            $project->billing_type = $data['billing_type'];

            $project->summary = _post('summary', null);

            if (isset($data['budget']) && $data['budget'] != '') {
                $project->budget = $data['budget'];
            }

            $members = [];

            if (isset($_POST['team_members'])) {
                $posted_team_members = $_POST['team_members'];
                foreach ($posted_team_members as $team_member) {
                    $team_member = (int) $team_member;

                    if ($team_member > 0) {
                        $members[] = $team_member;
                    }
                }
            }

            $project->members = json_encode($members);

            $project->currency = $data['currency'];

            $project->save();
        }

        break;

    case 'view':
        $id = route(2, false);

        if ($id) {
            $project = Project::find($id);

            if ($project) {
                $tasks = Task::where('pid', $project->id)
                    ->select('id', 'status')
                    ->get();

                $tasks_status = [];

                $tasks_count = 0;
                $task_completed = 0;
                $has_tasks = false;
                foreach ($tasks as $task) {
                    $has_tasks = true;
                    $tasks_count++;
                    if (
                        $task->status == 'Completed' ||
                        $task->status == 'Archived'
                    ) {
                        $task_completed++;
                    }
                }

                $tasks_status[$project->id] = [
                    'total' => $tasks_count,
                    'completed' => $task_completed,
                ];

                $staffs = User::all()
                    ->keyBy('id')
                    ->all();

                \view('projects_view', [
                    'project' => $project,
                    'has_tasks' => $has_tasks,
                    'tasks_status' => $tasks_status,
                    'staffs' => $staffs,
                ]);
            }
        }

        break;

    case 'delete':
        if (!has_access($user->roleid, 'transactions', 'delete')) {
            permissionDenied();
        }
        $id = route(2, false);

        if ($id) {
            $project = Project::find($id);
            if ($project) {
                $project->delete();
                r2(U . 'projects/');
            }
        }

        break;

    case 'tasks':
        $id = route(2, false);

        if ($id) {
            $project = Project::find($id);

            if ($project) {
                $mdate = date('Y-m-d');
                $ui->assign('mdate', $mdate);

                $contacts = Contact::select(['id', 'account'])
                    ->get()
                    ->groupBy('id')
                    ->all();
                $tickets = Ticket::select(['id', 'tid'])
                    ->get()
                    ->groupBy('id')
                    ->all();

                $lang_code = Ib_I18n::get_code($config['language']);

                $ui->assign(
                    'jsvar',
                    '
        _L[\'are_you_sure\'] = \'' .
                        $_L['are_you_sure'] .
                        '\';
 var ib_lang = \'' .
                        $lang_code .
                        '\';
var ib_rtl = false;
var ib_calendar_first_day = 0;
var ib_date_format_picker = \'' .
                        ib_js_date_format($config['df'], 'picker') .
                        '\';
var ib_date_format_moment = \'' .
                        ib_js_date_format($config['df']) .
                        '\';
 '
                );

                // $tasks = ORM::for_table('sys_tasks')->select('title')->select('aid')->select('status')->select('id')->find_array();
                $tasks_not_started = ORM::for_table('sys_tasks')
                    ->where('pid', $project->id)
                    ->select('title')
                    ->select('aid')
                    ->select('cid')
                    ->select('tid')
                    ->select('priority')
                    ->where('status', 'Not Started')
                    ->select('id')
                    ->select('created_at')
                    ->select('due_date')
                    ->select('created_by')
                    ->order_by_desc('id')
                    ->find_array();
                $ui->assign('tasks_not_started', $tasks_not_started);
                // ==================================================================

                $tasks_in_progress = ORM::for_table('sys_tasks')
                    ->where('pid', $project->id)
                    ->select('title')
                    ->select('aid')
                    ->select('cid')
                    ->select('tid')
                    ->select('priority')
                    ->where('status', 'In Progress')
                    ->select('id')
                    ->select('created_at')
                    ->select('due_date')
                    ->select('created_by')
                    ->order_by_desc('id')
                    ->find_array();
                $ui->assign('tasks_in_progress', $tasks_in_progress);
                // ==================================================================

                $tasks_completed = ORM::for_table('sys_tasks')
                    ->where('pid', $project->id)
                    ->select('title')
                    ->select('aid')
                    ->select('cid')
                    ->select('tid')
                    ->select('priority')
                    ->where('status', 'Completed')
                    ->select('id')
                    ->select('created_at')
                    ->select('due_date')
                    ->select('created_by')
                    ->order_by_desc('id')
                    ->find_array();
                $ui->assign('tasks_completed', $tasks_completed);
                // ==================================================================

                $tasks_deferred = ORM::for_table('sys_tasks')
                    ->where('pid', $project->id)
                    ->select('title')
                    ->select('aid')
                    ->select('cid')
                    ->select('tid')
                    ->select('priority')
                    ->where('status', 'Deferred')
                    ->select('id')
                    ->select('created_at')
                    ->select('due_date')
                    ->select('created_by')
                    ->order_by_desc('id')
                    ->find_array();

                $ui->assign('tasks_deferred', $tasks_deferred);
                // ==================================================================

                $tasks_waiting = ORM::for_table('sys_tasks')
                    ->where('pid', $project->id)
                    ->select('title')
                    ->select('aid')
                    ->select('cid')
                    ->select('tid')
                    ->select('priority')
                    ->where('status', 'Waiting')
                    ->select('id')
                    ->select('created_at')
                    ->select('due_date')
                    ->select('created_by')
                    ->order_by_desc('id')
                    ->find_array();
                $ui->assign('tasks_waiting', $tasks_waiting);

                \view('projects_tasks', [
                    'project' => $project,
                ]);
            }
        }

        break;

    case 'files':
        $id = route(2, false);

        if ($id) {
            $project = Project::find($id);

            if ($project) {
                $files = Document::getByType('project', $project->id);

                \view('projects_files', [
                    'project' => $project,
                    'files' => $files,
                ]);
            }
        }

        break;

    case 'financials':
        $id = route(2, false);

        if ($id) {
            $project = Project::find($id);

            if ($project) {
                $invoices = [];
                \view('projects_financials', [
                    'project' => $project,
                    'invoices' => $invoices,
                ]);
            }
        }

        break;

    case 'stream':
        $id = route(2, false);

        if ($id) {
            $project = Project::find($id);

            if ($project) {
                \view('projects_stream', [
                    'project' => $project,
                ]);
            }
        }

        break;

    case 'gantt-chart':
        $id = route(2, false);

        if ($id) {
            $project = Project::find($id);

            if ($project) {
                $tasks = Task::where('pid', $project->id)->get();

                \view('projects_gantt_chart', [
                    'project' => $project,
                    'tasks' => $tasks,
                ]);
            }
        }

        break;

    case 'timelog':
        $id = route(2, false);

        if ($id) {
            $project = Project::find($id);

            if ($project) {
                \view('projects_timelog', [
                    'project' => $project,
                    'mdate' => date('Y-m-d'),
                ]);
            }
        }

        break;

    case 'workload':
        $id = route(2, false);

        if ($id) {
            $project = Project::find($id);

            if ($project) {
                \view('projects_workload', [
                    'project' => $project,
                ]);
            }
        }

        break;

    case 'analytics':
        $id = route(2, false);

        if ($id) {
            $project = Project::find($id);

            if ($project) {
                $last_7_days = [];
                $task_counts = [];

                for ($i = 0; $i < 7; $i++) {
                    $time = strtotime('-' . $i . ' days');
                    $last_7_days[] = date('l', $time);

                    $task_counts[] = Task::where('pid', $project->id)
                        ->where('status', 'Completed')
                        ->where('date_finished', date('Y-m-d', $time))
                        ->count();
                }

                $last_7_days = array_reverse($last_7_days);
                $task_counts = array_reverse($task_counts);
                $task_status_counts = [
                    'not_started' => Task::where('status', 'Not Started')
                        ->where('pid', $project->id)
                        ->count(),
                    'completed' => Task::where('status', 'Completed')
                        ->where('pid', $project->id)
                        ->count(),
                    'in_progress' => Task::where('status', 'In Progress')
                        ->where('pid', $project->id)
                        ->count(),
                    'deferred' => Task::where('status', 'Deferred')
                        ->where('pid', $project->id)
                        ->count(),
                    'waiting' => Task::where('status', 'Waiting')
                        ->where('pid', $project->id)
                        ->count(),
                ];

                \view('projects_analytics', [
                    'project' => $project,
                    'last_7_days' => $last_7_days,
                    'task_counts' => $task_counts,
                    'task_status_counts' => $task_status_counts,
                ]);
            }
        }

        break;
}
