<?php

namespace App\Http\Controllers;

use App\Models\FeeStructure;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    public function previewByTerm($term)
    {
        $fees = FeeStructure::where('term', $term)->get();

        if ($fees->isEmpty()) {
            return redirect()->back()->with('error', 'No fees found for the selected term.');
        }

        $pdf = Pdf::loadView('pdf.fee_structure', compact('fees', 'term'));

        return $pdf->stream("fee_structure_form_{$term}.pdf");
    }
}

