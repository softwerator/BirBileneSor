<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestion;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Question_Tag;
use App\Models\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate()
    {
        $questions = Question::with(['user', 'description'])->orderBy('created_at','DESC')->paginate(20);

        return response()->json(['status' => true, 'data' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestion $request)
    {
        DB::beginTransaction();

        try {
            $user = User::getByToken($request->token);

            $question          = new Question();
            $question->title   = $request->title;
            $question->user_id = $user->id;
            $question_saved    = $question->save();

            if (!$question_saved)
                throw new \Exception("Soru kaydedilemedi");

            $answer              = new Answer();
            $answer->user_id     = $user->id;
            $answer->question_id = $question->id;
            $answer->answer      = $request->description;
            $answer_saved        = $answer->save();

            if (!$answer_saved)
                throw new \Exception("Cevep kaydedilemedi");

            $question->description_id = $answer->id;
            $question_saved           = $question->save();

            if (!$question_saved)
                throw new \Exception("Soru kaydedilemedi");

            /*$tags = explode(',', $request->tags);
            foreach ($tags as $tag) {

                $tag_instance = Tag::where('tag', $tag)->first();
                if ($tag_instance == null) {
                    $tag_instance      = new Tag();
                    $tag_instance->tag = (int) $tag;
                    $tag_saved = $tag_instance->save();

                    if (!$tag_saved)
                        throw new \Exception("Etiket kaydedilemedi");
                }

                $question_tag              = new Question_Tag();
                $question_tag->question_id = $question->id;
                $question_tag->tag_id      = $tag_instance->id;
                $question_tag->save();

                if (!$question_tag)
                    throw new \Exception("Etiket pivotu kaydedilemedi");
            }*/

            DB::commit();

            return response()->json(['status' => true, 'question_id' => $question->id]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['status' => false, 'message' => $e->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::with(['user', 'description', 'answer'])->find($id)->toArray();

        return response()->json(compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function answers($id)
    {
        $answers = Question::with(['description', 'answer'])->find($id)->answers->toArray();

        return response()->json(compact('answers'));
    }
}
