<?php

namespace App\Http\Controllers;

use App\Http\Resources\NeedResource;
use App\Mail\HelpOffered;
use App\Need;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NeedController extends Controller
{
    public function index()
    {
        return view('needs.index');
    }

    public function list()
    {
        $needs = auth()->user()->needs;
        return view('needs.list', compact('needs'));
    }

    public function create()
    {
        return view('needs.create');
    }

    public function store()
    {
        $data = \request()->validate([
            'title' => 'required',
            'preview' => 'required',
            'description' => 'required',
        ]);

        auth()->user()->needs()->create($data);
        return redirect(route('need.list'));
    }

    public function show(Need $need)
    {
        return view('needs.show', compact('need'));
    }

    public function edit(Need $need)
    {
        return view('needs.edit', compact('need'));
    }

    public function update(Need $need)
    {
        if ($need->user->id === auth()->user()->id) {
            $data = \request()->validate([
                'title' => 'required',
                'preview' => 'required',
                'description' => 'required',
            ]);

            $need->update($data);
        }
        return redirect(route('need.list'));
    }

    public function toggle(Need $need)
    {
        if ($need->user->id === auth()->user()->id) {
            $need->toggle();
        }
        return redirect(route('need.list'));
    }

    public function contact(Need $need)
    {
        $helper = \request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);
        $need->toggle();
        Mail::to($need->user)->send(new HelpOffered($need, $helper));

        return redirect(route('need.show', compact('need')))->with('status', 'E-Mail erfolgreich versendet.');
    }

    public function destroy(Need $need)
    {
        if ($need->user->id === auth()->user()->id) {
            $need->delete();
        }
        return redirect(route('need.list'));
    }

    public function rawIndex()
    {
        return NeedResource::collection(Need::where(['active'=>true])->with('user')->get());
    }
}
