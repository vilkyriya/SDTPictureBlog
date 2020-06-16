<?php

namespace App\Http\Controllers\Blog;

use App\Models\Images;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth as Auth;

class ImagesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Images::latest()->paginate(6);
        return view('blog.mainboard', compact('data'))
            ->with('i', (request()->input('page',1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    =>  'required',
            'image'   =>  'required|image|max:2048'
        ]);

        $image = $request->file('image');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('blog_images'), $new_name);
        $form_data = array(
            'name'       =>   $request->name,
            'image'      =>   $new_name
        );

        Images::create($form_data);
        return redirect('admin/index')->with('success', 'Изображение добавлено.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Images::findOrFail($id);
        return view('blog.image', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Images::findOrFail($id);
        return view('blog.admin.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($image != '')
        {
            $request->validate([
                'name'    =>  'required',
                'image'   =>  'required|image|max:2048'
            ]);
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('blog_images'), $image_name);
        } else {
            $request->validate([
                'name'    =>  'required',
            ]);
        }

        $form_data = array(
            'name'       =>   $request->name,
            'image'      =>   $image_name
        );

        Images::whereId($id)->update($form_data);
        return redirect('admin/index')->with('success', 'Изображение изменено.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('images_user')->where('images_id', '=', $id)->delete();

        $data = Images::findOrFail($id);
        $data->delete();
        return redirect('admin/index')->with('success', 'Изображение удалено.');
    }

    /**
     * Change votes
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function vote($id)
    {
        $data = Images::findOrFail($id);
        $data->votes += 1;
        $data->save();

        $user_id = Auth::user()->whichUser();

        \DB::table('images_user')->insert([
            'images_id' => $id,
            'user_id' => $user_id,
        ]);

        return redirect('show/' . $id);
    }
}
