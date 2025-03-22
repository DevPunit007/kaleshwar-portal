<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\LanguageLine; // ✅ Use this if LanguageLine.php is in app/ directory
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;



class LanguageLineController extends Controller
{
    public function index()
    {
        
        $translations = LanguageLine::all();
        
        // Fetch distinct groups from language_lines table
        $groups = DB::table('language_lines')->distinct()->pluck('group');

        return view('pages.translation.list', compact('translations', 'groups'));
    }


    public function AddTranslation()
    {
        return view('pages.translation.add-translation')->with('translation', null);
    }
    
    public function storeTranslation(Request $request)
    {
        $request->validate([
            'group' => 'required',
            'key' => 'required',
        ]);

        LanguageLine::create([
            'group' => $request->group,
            'key' => $request->key,
            'text' => [
                'en' => $request->text_en,
                'de' => $request->text_de,
                'cz' => $request->text_cz,
                'fi' => $request->text_fi,
                'fr' => $request->text_fr,
                'jp' => $request->text_jp,
            ],
        ]);

        return redirect()->route('translation-list', app()->getLocale())
                 ->with('success', 'Translation updated successfully!');
    }
    public function edit($id, $language)
    {
        $translation = LanguageLine::findOrFail($language);
        return view('pages.translation.edit-translation', compact('translation'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'group' => 'required',
            'key' => 'required',
        ]);

        $languageLine = LanguageLine::findOrFail($request->id);
        $languageLine->update([
            'group' => $request->group,
            'key' => $request->key,
            'text' => [
                'en' => $request->text_en,
                'de' => $request->text_de,
                'cz' => $request->text_cz,
                'fi' => $request->text_fi,
                'fr' => $request->text_fr,
                'jp' => $request->text_jp,
            ],
        ]);

        return redirect()->route('translation-list', app()->getLocale())
                 ->with('success', 'Translation updated successfully!');
    }


    public function destroy($language, $id)
    {
        try {
            $translation = LanguageLine::findOrFail($id);
            $translation->delete();

            return response()->json([
                'success' => true,
                'message' => 'Translation deleted successfully!',
                'redirect_url' => route('translation-list', ['language' => $language]) // ✅ Send correct redirect URL
            ]);
        } catch (\Exception $e) {
            \Log::error("Delete Error: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to delete translation.'], 500);
        }
    }

    public function importData(Request $request)
    {
        // Validate the request
        $request->validate([
            'language' => 'required|in:en,de,cz,fi,fr,jp',
        ]);
        $language = $request->language;
        $languageFolder = base_path("resources/lang/{$language}");

        // Check if the language folder exists
        if (!File::exists($languageFolder) || !File::isDirectory($languageFolder)) {
            return back()->with('error', 'Language folder not found!');
        }

        // Get all PHP files in the language directory
        $files = File::files($languageFolder);

        if (empty($files)) {
            return back()->with('error', 'No language files found in this folder!');
        }

        // Process each language file
        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $group = basename($filePath, '.php'); // Extract file name as group

            // Load the language file
            $translations = include $filePath;

            // Ensure it's a valid array
            if (!is_array($translations)) {
                Log::error("Invalid language file format: $filePath");
                continue;
            }

            // Process each translation key
            foreach ($translations as $key => $text) {
                // ✅ Fix: Ensure $text is a string to prevent infinite loop
                if (!is_string($text)) {
                    Log::error("Translation key '{$key}' in '{$group}' is not a string. Skipping...");
                    continue;
                }

                // Find existing translation entry
                $existingLanguageLine = LanguageLine::where('group', $group)->where('key', $key)->first();

                if ($existingLanguageLine) {
                    // ✅ Fix: Ensure `text` is an array before updating
                    $existingText = $existingLanguageLine->text;
                    if (!is_array($existingText)) {
                        $existingText = [];
                    }

                    // ✅ Fix: Prevent recursive updates that cause infinite loops
                    if (!isset($existingText[$language]) || $existingText[$language] !== $text) {
                        $existingText[$language] = $text;
                        $existingLanguageLine->update(['text' => $existingText]);
                    }
                } else {
                    // ✅ Create a new translation entry
                    LanguageLine::create([
                        'group' => $group,
                        'key' => $key,
                        'text' => [$language => $text],
                    ]);
                }
            }
        }

        return redirect()->route('translation-list', app()->getLocale())->with('success', 'All language files imported successfully!');
    }


    public function downloadFile(Request $request, $lang)
    {
        // Define the correct file path (use base_path() for 'resources/lang/')
        $filePath = base_path("resources/lang/{$request->language}/{$request->group}.php");

        // Check if file exists before proceeding
        if (!file_exists($filePath)) {
            return back()->with('error', 'File not found!');
        }

        // Return file as a download response
        return response()->download($filePath, "{$request->group}.php", [
            'Content-Type' => 'application/octet-stream'
        ]);
    }


    public function uploadFile(Request $request)
    {
        // Validate the request

        $language = $request->language; // e.g., 'en', 'de', 'fr'
        $file = $request->file('file'); // Uploaded file

        // Extract the file name (e.g., "auth.php", "messages.php")
        $fileName = $file->getClientOriginalName();

        // Define the storage path
        $directory = resource_path("lang/{$language}");
        $filePath = "{$directory}/{$fileName}"; // Save as the same file name

        // Create directory if it does not exist
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        // If file exists, delete it before saving
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Move the uploaded file to the correct path
        $file->move($directory, $fileName);

        return redirect()->route('translation-list', app()->getLocale())->with('success', 'File uploaded successfully!');
    }


    public function uploadAndImport(Request $request)
    {
        // Validate the request
        $request->validate([
            'language' => 'required|in:en,de,cz,fi,fr,jp', // File is optional, but must be a PHP file if provided
        ]);

        $language = $request->language;
        $languageFolder = resource_path("lang/{$language}");

        // If a file is uploaded, handle the file upload process
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = "{$languageFolder}/{$fileName}";

            // Create directory if it does not exist
            if (!File::exists($languageFolder)) {
                File::makeDirectory($languageFolder, 0777, true, true);
            }

            // If file exists, delete it before saving
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // Move the uploaded file to the correct path
            $file->move($languageFolder, $fileName);
        }

        // Check if the language folder exists
        if (!File::exists($languageFolder) || !File::isDirectory($languageFolder)) {
            return back()->with('error', 'Language folder not found!');
        }

        // Get all PHP files in the language directory
        $files = File::files($languageFolder);

        if (empty($files)) {
            return back()->with('error', 'No language files found in this folder!');
        }

        // Process each language file
        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $group = basename($filePath, '.php'); // Extract file name as group

            // Load the language file
            $translations = include $filePath;

            // Ensure it's a valid array
            if (!is_array($translations)) {
                Log::error("Invalid language file format: $filePath");
                continue;
            }

            // Process each translation key
            foreach ($translations as $key => $text) {
                if (!is_string($text)) {
                    Log::error("Translation key '{$key}' in '{$group}' is not a string. Skipping...");
                    continue;
                }

                // Find existing translation entry
                $existingLanguageLine = LanguageLine::where('group', $group)->where('key', $key)->first();

                if ($existingLanguageLine) {
                    $existingText = $existingLanguageLine->text;
                    if (!is_array($existingText)) {
                        $existingText = [];
                    }

                    if (!isset($existingText[$language]) || $existingText[$language] !== $text) {
                        $existingText[$language] = $text;
                        $existingLanguageLine->update(['text' => $existingText]);
                    }
                } else {
                    LanguageLine::create([
                        'group' => $group,
                        'key' => $key,
                        'text' => [$language => $text],
                    ]);
                }
            }
        }

        return redirect()->route('translation-list', app()->getLocale())->with('success', 'File uploaded and translations imported successfully!');
    }

}

