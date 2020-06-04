<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\Assignment;
use App\Lessonfiles;
use App\Studentsenrolled;
use App\Studentassignment;
use App\Studentassignmenttext;
use App\Studentassignmentfiles;
use Illuminate\Support\Facades\Storage;


class StudentController extends Controller
{
    // PUBLIC
    // Lessons
    public function public_lessons()
    {
        return view('student.public.lessons.index');
    }

    public function public_lessons_enroll($lesson_id)
    {
        $checkIfEnrolled = Studentsenrolled::where('student_id', student()->id)->where('lesson_id', $lesson_id)->first();
        if ($checkIfEnrolled !== null) {
            toast('Error! Materi sudah terdaftar', 'error');
            return back();
        }
        Studentsenrolled::create([
            'student_id' => student()->id,
            'lesson_id'  => $lesson_id
        ]);
        toast('Materi didaftarkan', 'success');
        return redirect()->route('student.self.lesson.enrolled');
    }

    // Assignments
    public function public_assignments()
    {
        return view('student.public.assignments.index');
    }

    public function public_assignment_detail($assignment_id)
    {
        $assignment = Assignment::find($assignment_id);
        return view('student.public.assignments.detail', [
            'assignment' => $assignment
        ]);
    }

    public function public_assignment_store(Request $request)
    {
        $assignment_id = $request->assignment_id;
        $model = $request->model;
        $assignment = Assignment::find($assignment_id);
        $deadline = $assignment->deadline;
        $currentDatetime = date('Y-m-d H:i:s');
        $format = '';
        if ($currentDatetime <= $deadline) {
            switch ($model) {
                case 1:
                    $format = 'text';
                    Studentassignment::create([
                        'assignment_id' => $assignment_id,
                        'student_id'    => student()->id,
                        'format'        => $format
                    ]);
                    $lastStudentAssignment = Studentassignment::where('assignment_id', $assignment_id)
                        ->where('student_id', student()->id)
                        ->latest()
                        ->first();
                    $student_assignment_id = $lastStudentAssignment->id;
                    Studentassignmenttext::create([
                        'assignment_id'         => $assignment_id,
                        'student_assignment_id' =>  $student_assignment_id,
                        'student_id'            => student()->id,
                        'text'                  => $request->answer_text
                    ]);
                    break;
                    
                case 2:
                    $format = 'files';
                    $docsformat = ['doc', 'docx', 'pdf'];
                    $audioformat = ['mp3', 'wav', 'mpga'];
                    $videoformat = ['mp4', 'mkv'];
                    $arrAllFormatFile = array_merge($docsformat, $audioformat, $videoformat);
                    $forbidFile = '';
                    foreach ($request->file as $file) {
                        $file_ext = $file->extension();
                        // IF format no in Array
                        if (!in_array($file_ext, $arrAllFormatFile)) {
                            $forbidFile = TRUE;
                        }
                    }
                    if ($forbidFile) {
                        toast('Format file not allowed', 'error');
                        return back();
                    }
                    Studentassignment::create([
                        'assignment_id' => $assignment_id,
                        'student_id'    => student()->id,
                        'format'        => $format
                    ]);
                    $lastStudentAssignment =
                        Studentassignment::where('assignment_id', $assignment_id)
                        ->where('student_id', student()->id)
                        ->where('format', 'files')
                        ->latest()
                        ->first();
                    $student_assignment_id = $lastStudentAssignment->id;
                    foreach ($request->file as $file) {
                        $file_ext = $file->extension();
                        $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $file_ext;
                        $url = '';
                        if (in_array($file_ext, $docsformat)) {
                            $format = 'doc';
                            $url = 'public/assignments/docs';
                        } elseif (in_array($file_ext, $audioformat)) {
                            $format = 'audio';
                            $url = 'public/assignments/audios';
                        } elseif (in_array($file_ext, $videoformat)) {
                            $format = 'video';
                            $url = 'public/assignments/videos';
                        }
                        $file->storeAs($url, $file_name);
                        Studentassignmentfiles::create([
                            'assignment_id' => $assignment_id,
                            'student_assignment_id' => $student_assignment_id,
                            'student_id' => student()->id,
                            'format' => $format,
                            'filename' => $file_name
                        ]);
                    }
                    break;
            }
            toast(
                'Assignment sent',
                'success'
            );
            return redirect()->action(
                'StudentController@self_assignment_detail',
                ['assignment_id' => $assignment_id]
            );
        } else {
            toast('Batas waktu input berakhir', 'error');
            return back();
        }
    }
    // Problem: Return with after created, page no need to set insert data. only view data {preview}


    // SELF
    // Lessons
    public function self_lessons_enrolled()
    {
        return view('student.self.lessons.index');
    }

    public function self_lesson_detail($lesson_id)
    {
        $lesson = Lesson::find($lesson_id);
        $lesson_files = Lessonfiles::where('lesson_id', $lesson_id)->get();
        return view('student.self.lessons.detail', [
            'lesson' => $lesson,
            'lesson_files' => $lesson_files
        ]);
    }

    // Assignments
    public function self_assignments()
    {
        return view('student.self.assignments.index');
    }

    public function self_assignment_detail($assignment_id)
    {
        $assignment = Assignment::find($assignment_id);
        $student_assignment = Studentassignment::where('assignment_id', $assignment_id)->where('student_id', student()->id)->first();
        $student_assignment_text = Studentassignmenttext::where('assignment_id', $assignment_id)
            ->where('student_assignment_id', $student_assignment->id)
            ->where('student_id', student()->id)->first();
        $student_assignment_files = Studentassignmentfiles::where('assignment_id', $assignment_id)
            ->where('student_assignment_id', $student_assignment->id)
            ->where('student_id', student()->id)->get();
            
        return view('student.self.assignments.detail', [
            'assignment' => $assignment,
            'student_assignment_text' => $student_assignment_text !== null ? $student_assignment_text : NULL,
            'student_assignment_files' => $student_assignment_files !== null ? $student_assignment_files : NULL,
            'student_assignment_id' => $student_assignment->id,
            'assignment_id' => $assignment_id
        ]);
    }

    public function self_assignment_update_text(Request $request)
    {
        Studentassignmenttext::where('assignment_id', $request->assignment_id)
            ->where('student_id', student()->id)
            ->where('student_assignment_id', $request->student_assignment_id)
            ->update(['text' => $request->text]);
        toast('Updated', 'success');
        return back();
    }

    public function self_assignment_delete_file($student_assignment_id)
    {
        $student_assignment_files = Studentassignmentfiles::find($student_assignment_id);
        $url =  'public/assignments/' . $student_assignment_files->format . 's/' . $student_assignment_files->filename;
        Storage::delete($url);
        Studentassignmentfiles::find($student_assignment_id)->delete();
        toast('File removed', 'success');
        return back();
    }

    public function self_assignment_update_files(Request $request)
    {
        if ($request->hasFile('file')) {
            $docsformat  = ['doc', 'docx', 'pdf'];
            $audioformat = ['mp3', 'wav', 'mpga'];
            $videoformat = ['mp4', 'mkv'];
            $arrAllFormatFile = array_merge($docsformat, $audioformat, $videoformat);
            $file = $request->file;
            $file_ext = $file->extension();
            $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $file_ext;
            if (in_array($file_ext, $arrAllFormatFile)) {
                if (in_array($file_ext, $docsformat)) {
                    $format = 'doc';
                    $url = 'public/assignments/docs';
                } elseif (in_array($file_ext, $audioformat)) {
                    $format = 'audio';
                    $url = 'public/assignments/audios';
                } elseif (in_array($file_ext, $videoformat)) {
                    $format = 'video';
                    $url = 'public/assignments/videos';
                }
                $file->storeAs($url, $file_name);
                Studentassignmentfiles::create([
                    'assignment_id' => $request->assignment_id,
                    'student_assignment_id' => $request->student_assignment_id,
                    'student_id' => student()->id,
                    'format' => $format,
                    'filename' => $file_name,
                ]);

                toast('File added', 'success');
            } else {
                toast('Format not allowed', 'error');
            }
        }
        return back();
    }
}
