<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePaymentsRequest;
use App\Http\Requests\Admin\UpdatePaymentsRequest;

class PaymentsController extends Controller
{
    /**
     * Display a listing of Payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('payment_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('payment_delete')) {
                return abort(401);
            }
            $payments = Payment::onlyTrashed()->get();
        } else {
            $payments = Payment::all();
        }

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating new Payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('payment_create')) {
            return abort(401);
        }
        
        $lecturers = \App\Lecturer::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.payments.create', compact('lecturers'));
    }

    /**
     * Store a newly created Payment in storage.
     *
     * @param  \App\Http\Requests\StorePaymentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentsRequest $request)
    {
        if (! Gate::allows('payment_create')) {
            return abort(401);
        }
        $payment = Payment::create($request->all());



        return redirect()->route('admin.payments.index');
    }


    /**
     * Show the form for editing Payment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('payment_edit')) {
            return abort(401);
        }
        
        $lecturers = \App\Lecturer::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $payment = Payment::findOrFail($id);

        return view('admin.payments.edit', compact('payment', 'lecturers'));
    }

    /**
     * Update Payment in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentsRequest $request, $id)
    {
        if (! Gate::allows('payment_edit')) {
            return abort(401);
        }
        $payment = Payment::findOrFail($id);
        $payment->update($request->all());



        return redirect()->route('admin.payments.index');
    }


    /**
     * Display Payment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('payment_view')) {
            return abort(401);
        }
        $payment = Payment::findOrFail($id);

        return view('admin.payments.show', compact('payment'));
    }


    /**
     * Remove Payment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('payment_delete')) {
            return abort(401);
        }
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('admin.payments.index');
    }

    /**
     * Delete all selected Payment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('payment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Payment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Payment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('payment_delete')) {
            return abort(401);
        }
        $payment = Payment::onlyTrashed()->findOrFail($id);
        $payment->restore();

        return redirect()->route('admin.payments.index');
    }

    /**
     * Permanently delete Payment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('payment_delete')) {
            return abort(401);
        }
        $payment = Payment::onlyTrashed()->findOrFail($id);
        $payment->forceDelete();

        return redirect()->route('admin.payments.index');
    }
}
