<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShareDocument;
use App\Models\Item;
use App\Services\FileService;



class DocumentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-documento|crear-documento|editar-documento|borrar-documento|compartir-documento|descargar-documento', ['only' => ['index']]);
        $this->middleware('permission:crear-documento', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-documento', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-documento', ['only' => ['destroy']]);
        $this->middleware('permission:compartir-documento', ['only' => ['share']]);
        $this->middleware('permission:descargar-documento', ['only' => ['download']]);
    }

    public function index()
{
    $ownDocuments = Document::where('user_id', auth()->user()->id)->paginate(5);
    $sharedDocuments = auth()->user()->documents()->paginate(5);

    return view('documents.index', compact('ownDocuments', 'sharedDocuments'));
}


    


    public function create()
    {
        return view('documents.crear');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'archivo' => 'required|file',
        ]);

        $archivo = $request->file('archivo');
        $nombre_archivo = $archivo->getClientOriginalName();
        $archivo->move(public_path() . '/documentos/', $nombre_archivo);

        $documento = new Document();
        $documento->nombre = $request->input('nombre');
        $documento->archivo = $nombre_archivo;
        $documento->user_id = auth()->user()->id;
        $documento->save();

        return redirect()->route('documents.index')->with('success', 'El documento ha sido creado correctamente');
    }

    public function edit(Document $document)
    {
        return view('documents.editar', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        $document->nombre = $request->input('nombre');

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombre_archivo = time() . '_' . $archivo->getClientOriginalName();
            $ruta_archivo = $archivo->storeAs('documentos', $nombre_archivo);
            $document->ubicacion = $ruta_archivo;
        }

        $document->save();

        return redirect()->route('documents.index')->with('success', 'El documento ha sido actualizado correctamente');
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'El documento ha sido eliminado correctamente');
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);
        $pathToFile = public_path('downloads/' . $document->file_path);
        return response()->download($pathToFile, $document->nom_documento . '.' . $document->extension);
    }

    
    public function share(Document $document)
    {
        $users = User::all();
        return view('documents.share', compact('document', 'users'));
    }
    
    public function doShare(Request $request, Document $document)
    {
        $this->validate($request, [
            'items' => 'required|array',
            'items.*' => 'exists:users,id',
        ]);
    
        $userIds = $request->input('items');
        $document->sharedWithUsers()->sync($userIds);
    
        return redirect()->route('documents.index')->with('success', 'El documento ha sido compartido correctamente');
    }
    
}
    

    

