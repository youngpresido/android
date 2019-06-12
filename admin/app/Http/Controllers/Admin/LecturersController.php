<?php

namespace App\Http\Controllers\Admin;

use App\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLecturersRequest;
use App\Http\Requests\Admin\UpdateLecturersRequest;

class LecturersController extends Controller
{
    /**
     * Display a listing of Lecturer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('lecturer_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('lecturer_delete')) {
                return abort(401);
            }
            $lecturers = Lecturer::onlyTrashed()->get();
        } else {
            $lecturers = Lecturer::all();
        }

        return view('admin.lecturers.index', compact('lecturers'));
    }

    /**
     * Show the form for creating new Lecturer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('lecturer_create')) {
            return abort(401);
        }
        return view('admin.lecturers.create');
    }

    /**
     * Store a newly created Lecturer in storage.
     *
     * @param  \App\Http\Requests\StoreLecturersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLecturersRequest $request)
    {
        if (! Gate::allows('lecturer_create')) {
            return abort(401);
        }
        $lecturer = Lecturer::create($request->all());



        return redirect()->route('admin.lecturers.index');
    }


    /**
     * Show the form for editing Lecturer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('lecturer_edit')) {
            return abort(401);
        }
        $lecturer = Lecturer::findOrFail($id);

        return view('admin.lecturers.edit', compact('lecturer'));
    }

    /**
     * Update Lecturer in storage.
     *
     * @param  \App\Http\Requests\UpdateLecturersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLecturersRequest $request, $id)
    {
        if (! Gate::allows('lecturer_edit')) {
            return abort(401);
        }
        $lecturer = Lecturer::findOrFail($id);
        $lecturer->update($request->all());



        return redirect()->route('admin.lecturers.index');
    }


    /**
     * Display Lecturer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('lecturer_view')) {
            return abort(401);
        }
        $payments = \App\Payment::where('lecturer_id', $id)->get();

        $lecturer = Lecturer::findOrFail($id);

        return view('admin.lecturers.show', compact('lecturer', 'payments'));
    }


    /**
     * Remove Lecturer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('lecturer_delete')) {
            return abort(401);
        }
        $lecturer = Lecturer::findOrFail($id);
        $lecturer->delete();

        return redirect()->route('admin.lecturers.index');
    }

    /**
     * Delete all selected Lecturer at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('lecturer_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Lecturer::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Lecturer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('lecturer_delete')) {
            return abort(401);
        }
        $lecturer = Lecturer::onlyTrashed()->findOrFail($id);
        $lecturer->restore();

        return redirect()->route('admin.lecturers.index');
    }

    /**
     * Permanently delete Lecturer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('lecturer_delete')) {
            return abort(401);
        }
        $lecturer = Lecturer::onlyTrashed()->findOrFail($id);
        $lecturer->forceDelete();

        return redirect()->route('admin.lecturers.index');
    }
}
