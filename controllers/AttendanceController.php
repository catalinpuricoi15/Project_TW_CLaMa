<?php

namespace controllers;

use core\Application;
use core\Controller;
use core\Request;
use core\Response;
use models\Assignment;
use models\Attendance;

class AttendanceController extends Controller
{
    public function confirmAttendance(Request $request, Response $response){
        $body = $request->getBody();
        $assignment = Assignment::findOne(['id' => $body['idAssignment']]);
        $attendance = new Attendance();
        if($assignment->code_attendance == $body['codAttendance']){
            $attendance->idAssignment = $assignment->id;
            $attendance->idUser = Application::$app->user->id;
            $attendance->save();
            $response->redirect("/class/assignment/$assignment->id");
            return;
        }
        return $this->render('classes/assignment');
    }
}