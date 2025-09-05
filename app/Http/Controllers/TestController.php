<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TestController extends Controller
{


    /** ================== CRUD ================== */
    public function index()
    {
        $tests = "a"; // contoh dummy data
        return view('test.index', compact('tests'));
    }

    public function create()
    {
        return view('test.create');
    }

    public function store(Request $request)
    {
        // simpan data kalau ada model
        return redirect()->route('test.index')
            ->with('success', 'Data Test berhasil ditambahkan');
    }

    public function edit($id)
    {
        $test = "a"; // contoh dummy data
        return view('test.edit', compact('test'));
    }

    public function update(Request $request, $id)
    {
        // update data kalau ada model
        return redirect()->route('test.index')
            ->with('success', 'Data Test berhasil diupdate');
    }

    public function destroy($id)
    {
        // hapus data kalau ada model
        return redirect()->route('test.index')
            ->with('success', 'Data Test berhasil dihapus');
    }

    /** ================== APPROVAL ================== */
    public function approvalList()
    {
        return view('test.approval');
    }

    public function approve($id)
    {
        // logic approve di sini
        return back()->with('success', 'Test berhasil di-approve');
    }

    /** ================== REPORT ================== */
    public function report()
    {
        // data laporan kalau ada model
        return view('test.report');
    }
}
