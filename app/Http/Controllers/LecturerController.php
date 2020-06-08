<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

use App\Lecturer;
use App\Chatsroom;
use App\Userchat;
use App\Lesson;
use App\Lessonfiles;
use App\Assignment;
use App\Quizzes;
use App\Question;
use App\Choices;
use App\Student;
use App\Studentassignment;
use App\Studentassignmentfiles;
use App\Studentassignmenttext;
use App\Studentchoices;
use App\Studentquiz;

class LecturerController extends Controller
{

    // Lessons
    public function index()
    {
        return view('lecturer.lessons.index');
    }

    public function lesson_create()
    {
        return view('lecturer.lessons.create');
    }

    public function lesson_store(Request $request)
    {
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

        Lesson::create([
            'title' => $request->title,
            'description' => $request->description,
            'lecturer_id' => lecturer()->id
        ]);

        $get_latest_lesson_id = Lesson::where('lecturer_id', lecturer()->id)->latest()->first();
        $set_latest_lesson_id = $get_latest_lesson_id->id;

        foreach ($request->file as $file) {
            $file_ext = $file->extension();
            $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $file_ext;
            $url = '';
            if (in_array($file_ext, $docsformat)) {
                $format = 'doc';
                $url = 'public/lessons/docs';
            } elseif (in_array($file_ext, $audioformat)) {
                $format = 'audio';
                $url = 'public/lessons/audios';
            } elseif (in_array($file_ext, $videoformat)) {
                $format = 'video';
                $url = 'public/lessons/videos';
            }
            $file->storeAs($url, $file_name);
            Lessonfiles::create([
                'format' => $format,
                'filename' => $file_name,
                'lesson_id' => $set_latest_lesson_id
            ]);
        }
        toast('Berhasil tambah materi', 'success');
        return back();
    }

    public function lesson_edit($lesson_id)
    {
        $lesson = Lesson::find($lesson_id);
        $lesson_files = Lessonfiles::where('lesson_id', $lesson_id)->get();
        return view('lecturer.lessons.edit', [
            'lesson' => $lesson,
            'lesson_files' => $lesson_files
        ]);
    }

    public function lesson_update(Request $request)
    {
        Lesson::find($request->lesson_id)->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        toast('Updated', 'success');
        return back();
    }

    public function lesson_delete($lesson_id)
    {
        //1. remove file and list data on files
        $lesson_files = Lessonfiles::where('lesson_id', $lesson_id)->get();

        // Jika ada isinya
        if ($lesson_files !== null) {

            // Remove each files
            foreach ($lesson_files as $lesson_file) {
                $url =  'public/lessons/' . $lesson_file->format . 's/' . $lesson_file->filename;
                Storage::delete($url);
            }

            // Then, remove all files where selected lesson id
            Lessonfiles::where('lesson_id', $lesson_id)->delete();
        }

        //2. remove lesson
        Lesson::find($lesson_id)->delete();
        toast('Materi dihapus', 'success');
        return back();
    }

    public function lessonfile_delete($lessonfile_id)
    {
        $lesson_file = Lessonfiles::find($lessonfile_id);
        $url =  'public/lessons/' . $lesson_file->format . 's/' . $lesson_file->filename;
        Storage::delete($url);
        Lessonfiles::find($lessonfile_id)->delete();
        toast('Files removed', 'success');
        return back();
    }

    public function lessonfile_upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $docsformat = ['doc', 'docx', 'pdf'];
            $audioformat = ['mp3', 'wav', 'mpga'];
            $videoformat = ['mp4', 'mkv'];
            $arrAllFormatFile = array_merge($docsformat, $audioformat, $videoformat);
            $file = $request->file;
            $file_ext = $file->extension();
            $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $file_ext;
            // $file_name = time() . '.' . $file_ext;

            if (in_array($file_ext, $arrAllFormatFile)) {

                if (in_array($file_ext, $docsformat)) {
                    $format = 'doc';
                    $url = 'public/lessons/docs';
                } elseif (in_array($file_ext, $audioformat)) {
                    $format = 'audio';
                    $url = 'public/lessons/audios';
                } elseif (in_array($file_ext, $videoformat)) {
                    $format = 'video';
                    $url = 'public/lessons/videos';
                }
                $file->storeAs($url, $file_name);
                Lessonfiles::create([
                    'format' => $format,
                    'filename' => $file_name,
                    'lesson_id' => $request->lesson_id
                ]);

                toast('File added', 'success');
                return back();
            }
            toast('Format file not allowed', 'error');
            return back();
        } else {
            toast('File empty', 'error');
            return back();
        }
    }

    // Assignment
    public function assignment()
    {
        return view('lecturer.assignments.index');
    }

    public function assignment_create()
    {
        return view('lecturer.assignments.create');
    }

    public function assignment_edit($assignment_id)
    {
        $assignment = Assignment::find($assignment_id);
        if ($assignment !== null) {
            return view('lecturer.assignments.edit', [
                'assignment' => $assignment
            ]);
        } else {
            toast('Assignment not found', 'error');
            return back();
        }
    }

    public function assignment_update(Request $request)
    {
        Assignment::find($request->assignment_id)->update([
            'title' => $request->title,
            'deadline' => $request->deadline,
            'description' => $request->description
        ]);
        toast('Assignment updated', 'success');
        return back();
    }

    public function assignment_store(Request $request)
    {
        // dd($request->all());
        if ($request->description == null) {
            toast('Deskripsi harus diisi', 'error');
        } else {
            Assignment::create($request->all());
            toast('Assignment created', 'success');
        }
        return back();
    }

    public function assignment_detail($assignment_id = null)
    {
        $assignment = Assignment::find($assignment_id);
        $students_assignment = Studentassignment::where('assignment_id', $assignment_id)->orderByDesc('created_at')->get();
        return view('lecturer.assignments.detail', [
            'assignment' => $assignment,
            'students_assignment' => $students_assignment
        ]);
    }

    public function assignment_student_get($student_assignment_id)
    {
        $student_asignment = Studentassignment::find($student_assignment_id);
        $assignment_id     = $student_asignment->assignment->id;
        $student_id = $student_asignment->student->id;

        session()->put('assignment_id', $assignment_id);
        session()->put('student_id', $student_id);

        $student_assignment_mode = $student_asignment->format;
        if ($student_assignment_mode == 'text') {
            $student_assignment_mode_text =
                Studentassignmenttext::where('assignment_id', $assignment_id)
                ->where('student_id', $student_id)
                ->where('student_assignment_id', $student_assignment_id)
                ->first();
            session()->forget('answer_files');
            session()->put('answer_text', $student_assignment_mode_text->text);
        } elseif ($student_assignment_mode == 'files') {
            $student_assignment_mode_files =
                Studentassignmentfiles::where('assignment_id', $assignment_id)
                ->where('student_id', $student_id)
                ->where('student_assignment_id', $student_assignment_id)
                ->get();
            session()->forget('answer_text');
            session()->put('answer_files', $student_assignment_mode_files);
        }

        return redirect()->route('lecturer.assignment.detail', $assignment_id);
    }

    // Quiz
    public function quiz()
    {
        return view('lecturer.quiz.index');
    }

    public function quiz_create()
    {
        return view('lecturer.quiz.create');
    }

    public function quiz_store(Request $request)
    {
        $lecturer_id = lecturer()->id;
        Quizzes::create([
            'title' => $request->title,
            'description' => $request->description,
            'lecturer_id' => $lecturer_id,
            'is_active'   => 0
        ]);
        toast('Quiz created', 'success');
        return back();
    }

    public function quiz_update(Request $request)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description
        ];
        Quizzes::find($request->quiz_id)->update($data);
        toast('Quiz updated', 'success');
        return back();
    }

    public function quiz_delete($quiz_id)
    {
        Quizzes::find($quiz_id)->delete();
        toast('Quiz deleted', 'success');
        return back();
    }

    public function quiz_detail($quiz_id)
    {
        session()->put('quiz_id', $quiz_id);
        $quiz = Quizzes::find($quiz_id);
        return view('lecturer.quiz.general', [
            'quiz' => $quiz,
        ]);
    }

    public function quiz_question_index($quiz_id)
    {
        $lecturer_id = lecturer()->id;
        $questions = Question::where('quiz_id', $quiz_id)->get();
        $quiz = Quizzes::find($quiz_id);
        return view('lecturer.quiz.questions', [
            'questions' => $questions,
            'quiz'   => $quiz
        ]);
    }

    public function quiz_question_store(Request $request)
    {
        $arrAnswersLength = count(array_filter($request->answers));
        $numberChoice = $request->choices[0];
        if ($numberChoice >= $arrAnswersLength) {
            toast('Error! invalid input', 'error');
            return back();
        }

        $lecturer_id = lecturer()->id;
        $lastQuiz = Quizzes::latest()->first();
        $quiz_id = $lastQuiz->id;
        Question::create([
            'question' => $request->question,
            'quiz_id' => $quiz_id,
        ]);
        $lastQuestion = Question::where('quiz_id', $quiz_id)->latest()->first();
        $question_id = $lastQuestion->id;
        for ($i = 0; $i < $arrAnswersLength; $i++) {
            $ch = new Choices;
            $ch->choice = $request->answers[$i];
            $ch->question_id = $question_id;
            if ($i == $numberChoice) {
                $ch->correct = 1;
            } else {
                $ch->correct = 0;
            }
            $ch->save();
        }
        toast('Question created', 'success');
        return back();
    }

    public function quiz_published(Request $request)
    {
        Quizzes::find($request->quiz_id)->increment('is_active');
        toast('Quiz activated', 'success');
        return back();
    }

    public function quiz_question_delete($question_id)
    {
        Question::find($question_id)->delete();
        return back();
    }

    public function quiz_students($quiz_id)
    {
        return view('lecturer.quiz.students', [
            'quiz_id' => $quiz_id
        ]);
    }

    public function quiz_student_selected($quiz_id, $student_id)
    {
        $student_choices = Studentchoices::where('quiz_id', $quiz_id)->where('student_id', $student_id)->get();
        $student = Student::find($student_id);
        $student_quiz = Studentquiz::where('quiz_id', $quiz_id)->where('student_id', $student_id)->first();
        session()->put('student_choices', $student_choices);
        $student = [
            'id'    => $student->id,
            'name'  => $student->name,
            'score' => $student_quiz->score
        ];
        session()->put('student', $student);
        return back();
    }

    // CHATS
    public function chats()
    {
        return view('lecturer.livechat.index');
    }

    public function selected_chat($student_id)
    {
        $chatroom = Chatsroom::where('student_id', $student_id)
            ->where('lecturer_id', lecturer()->id)->first();
        if (!empty($chatroom)) {
            $chatroomid = $chatroom->id;
            $user_chats = Userchat::where('chatroom_id', $chatroomid)->get();
            session()->put('user_chats', $user_chats);
            session()->put('studentid', $student_id);
            session()->put('chatroomid', $chatroom->id);
            return back();
        }
        return back();
    }

    public function sendmsg(Request $request)
    {
        Userchat::create([
            'level' => 'lecturer',
            'userid' => lecturer()->id,
            'name' => lecturer()->name,
            'message' => $request->message,
            'chatroom_id' => $request->chatroomid
        ]);
        // dd($request->studentid);
        return redirect()->action(
            'LecturerController@selected_chat',
            ['student_id' => $request->studentid]
        );
    }
}
