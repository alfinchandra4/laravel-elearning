<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Lecturer;
use App\Lesson;
use App\Lessonfiles;
use Illuminate\Support\Facades\Storage;

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
        $lesson = Lesson::create([
            'title' => $request->title,
            'description' => $request->description,
            'lecturer_id' => auth()->guard('lecturer')->user()->id
        ]);

        $get_latest_lesson_id = Lesson::where('lecturer_id', auth()->guard('lecturer')->user()->id)->latest()->first();
        $set_latest_lesson_id = $get_latest_lesson_id->id;
        $docsformat = ['doc', 'docx', 'pdf'];
        $audioformat = ['mp3', 'wav', 'mpga'];
        $videoformat = ['mp4', 'mkv'];
        foreach ($request->file as $file) {
            $file_ext = $file->extension();
            $new_file_name = time() . '.' . $file_ext;
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
            $file->storeAs($url, $new_file_name);
            Lessonfiles::create([
                'format' => $format,
                'filename' => $new_file_name,
                'lesson_id' => $set_latest_lesson_id
            ]);
        }
        toast('Berhasil tambah materi', 'success');
        return back();
    }
}
