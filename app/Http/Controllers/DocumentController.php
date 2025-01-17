<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return response()->json($documents);
    }

    public function store(Request $request)
    {
        $document = Document::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return response()->json($document, 201);
    }

    public function show(Document $document)
    {
        return response()->json($document);
    }

    public function update(Request $request, Document $document)
    {
        $document->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return response()->json($document);
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return response()->json(null, 204);
    }
}
