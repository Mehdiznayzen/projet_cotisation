<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Depense;
use App\Models\Cotisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // ← Import manquant ajouté

class CotisationDepenseController extends Controller
{
    public function showInfo(){
        $cotisations = Cotisation::with('user')->latest()->get();
        $depenses = Depense::with('user')->latest()->get();

        return view('admin.showInfo', [
            'cotisations' => $cotisations,
            'depenses' => $depenses,
            'hideHeader' => true
        ]);
    }

    public function index()
    {
        $cotisations = Cotisation::with('user')->latest()->get();
        return view('cotisation.index', compact('cotisations'));
    }

    public function storeCotisation(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'montant' => 'required|numeric|min:0',
            'date' => 'required|date',
            'Motif' => 'nullable|string',
        ]);

        Cotisation::create($validated);

        return back()->with('success', 'Cotisation créée avec succès.');
    }

    public function storeDepense(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'montant' => 'required|numeric|min:0',
            'date' => 'required|date',
            'motif' => 'required|string|in:Frais de fonctionnement,Transport,Matériel,Bureau,Autre',
            'description' => 'nullable|string',
            'justificatif' => 'nullable|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx',
        ]);

        if ($request->hasFile('justificatif')) {
            $validated['justificatif'] = $request->file('justificatif')->store('justificatifs', 'public');
        }

        Depense::create($validated);

        return back()->with('success', 'Dépense enregistrée avec succès.');
    }

    public function downloadJustificatif($id)
    {
        $depense = Depense::findOrFail($id);

        if (!$depense->justificatif) {
            abort(404, 'Aucun justificatif trouvé pour cette dépense');
        }

        $filePath = storage_path('app/public/' . $depense->justificatif);

        if (!file_exists($filePath)) {
            abort(404, 'Fichier justificatif introuvable');
        }

        $originalName = basename($depense->justificatif);

        return response()->download($filePath, $originalName);
    }


    public function downloadJustificatifStorage($id)
    {
        $depense = Depense::findOrFail($id);
        
        if (!$depense->justificatif) {
            abort(404, 'Aucun justificatif trouvé pour cette dépense');
        }
        
        $filePath = 'justificatifs/' . $depense->justificatif;
        
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'Fichier justificatif introuvable');
        }
        
        return Storage::disk('public')->download($filePath, $depense->justificatif);
    }

    public function viewJustificatif($id)
    {
        $depense = Depense::findOrFail($id);
        
        if (!$depense->justificatif) {
            abort(404, 'Aucun justificatif trouvé pour cette dépense');
        }
        
        $filePath = storage_path('app/public/justificatifs/' . $depense->justificatif);
        
        if (!file_exists($filePath)) {
            abort(404, 'Fichier justificatif introuvable');
        }
        
        $mimeType = mime_content_type($filePath);
        
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
        ]);
    }
}