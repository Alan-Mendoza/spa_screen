<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('document-index'), 403);

        return Inertia::render('Documents/Index', [
            'documents' => Document::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('document-create'), 403);

        return Inertia::render('Documents/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentRequest $request)
    {
        Document::create($request->only('name'));
        // $document = new Document;
        // $document->name = $request->name;
        // $document->save();

        return redirect()->route('documents.index')->with('success', 'Document create success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        abort_if(Gate::denies('document-show'), 403);

        return Inertia::render('Documents/Show', [
            'document' => $document
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        abort_if(Gate::denies('document-edit'), 403);

        return Inertia::render('Documents/Edit', [
            'document' => $document
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        // $document = Document::find($document->id);
        // $document->name = $request->name;
        // $document->save();

        $document->update($request->only('name'));

        return redirect()->route('documents.index')->with('success', 'Document update success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        abort_if(Gate::denies('document-destroy'), 403);

        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document delete success');
    }
}
