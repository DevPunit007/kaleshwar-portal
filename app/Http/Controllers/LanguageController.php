<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LanguageLine;

class LanguageLineController extends Controller
{
    /**
     * Display a listing of the translations.
     */
    public function index()
    {
        $translations = LanguageLine::all();
        return view('translations.index', compact('translations'));
    }

    /**
     * Show the form for creating a new translation.
     */
    public function create()
    {
        return view('translations.create');
    }

    /**
     * Store a newly created translation in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'group' => 'required|string',
            'key' => 'required|string|unique:language_lines,key',
            'text' => 'required|array',
        ]);

        LanguageLine::create([
            'group' => $request->group,
            'key' => $request->key,
            'text' => $request->text,
        ]);

        return redirect()->route('translations.index')->with('success', 'Translation added successfully.');
    }

    /**
     * Remove the specified translation from storage.
     */
    public function destroy($id)
    {
        $translation = LanguageLine::findOrFail($id);
        $translation->delete();

        return redirect()->route('translations.index')->with('success', 'Translation deleted successfully.');
    }
}
