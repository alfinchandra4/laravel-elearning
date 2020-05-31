<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

use App\Lecturer;
use App\Lesson;
use App\Lessonfiles;
use App\Assignment;
use App\Quizzes;
use App\Question;
use App\Choices;

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
            'lecturer_id' => auth()->guard('lecturer')->user()->id
        ]);

        $get_latest_lesson_id = Lesson::where('lecturer_id', auth()->guard('lecturer')->user()->id)->latest()->first();
        $set_latest_lesson_id = $get_latest_lesson_id->id;

        foreach ($request->file as $file) {
            $file_ext = $file->extension();
            $file_name = $file->getClientOriginalName();
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
        toast('Materi berhasil update', 'success');
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
            $file_name = $file->getClientOriginalName();
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

                toast('Berhasil tambah file', 'success');
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

    public function assignment_detail($assignment_detail = null)
    {
        return view('lecturer.assignments.detail');
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
        $lecturer_id = auth()->guard('lecturer')->user()->id;
        Quizzes::create([
            'title' => $request->title,
            'description' => $request->description,
            'lecturer_id' => $lecturer_id
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
        $lecturer_id = auth()->guard('lecturer')->user()->id;
        $questions = Question::where('quiz_id', $quiz_id)->where('lecturer_id', $lecturer_id)->get();
        return view('lecturer.quiz.questions', [
            'questions' => $questions
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

        $lecturer_id = auth()->guard('lecturer')->user()->id;
        $lastQuiz = Quizzes::latest()->first();
        $quiz_id = $lastQuiz->id;
        Question::create([
            'question' => $request->question,
            'quiz_id' => $quiz_id,
            'lecturer_id' => $lecturer_id
        ]);
        $lastQuestion = Question::where('lecturer_id', $lecturer_id)->latest()->first();
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

    public function quiz_question_delete($question_id)
    {
        Question::find($question_id)->delete();
        return back();
    }

    public function quiz_students($quiz_id)
    {
        return view('lecturer.quiz.students');
    }
}
