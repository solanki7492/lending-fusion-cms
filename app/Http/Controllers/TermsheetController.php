<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Termsheet;

class TermsheetController extends Controller
{
    public function index()
    {
        $termsheets = Termsheet::all();
        return view('termsheet.list', compact('termsheets'));
    }
    public function create()
    {
        return view('termsheet.create');
    }

    public function getGeneratePDF(Request $request)
    {
        $data = $request->all();
        $pdf = DomPDF::loadView('termsheet.generate-pdf', compact( 'data'));

        $fileName = Str::slug($request->merchant_name, '-').'-contract' . time() . '.pdf';

        return $pdf->stream($fileName);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $pdf = DomPDF::loadView('termsheet.generate-pdf', compact( 'data'));

        $pdfContent = $pdf->output();
        $fileName = Str::slug($request->merchant_name, '-').'-contract' . time() . '.pdf';

        $filePath = "termsheets/{$fileName}";
        $merchantName = Str::slug($request->merchant_name , '-');
        // Store PDF in storage folder
        Storage::disk('local')->put($filePath, $pdfContent);

        $termsheet = new Termsheet();
        $termsheet->merchant_name = $request->merchant_name;
        $termsheet->first_name = $request->first_name;
        $termsheet->last_name = $request->last_name;
        $termsheet->address = $request->address;
        $termsheet->sent_to = $request->email;
        $termsheet->termsheet = $filePath;
        $termsheet->loan_amount = $request->loan_amount;
        $termsheet->origination_fee = $request->origination_fee;
        $termsheet->net_loan_amount = $request->net_loan_amount;
        $termsheet->monthly_payment = $request->monthly_payment;
        $termsheet->interest_rate = $request->interest_rate;
        $termsheet->loan_type_and_program_type = $request->loan_type_and_program_type;
        $termsheet->loan_type_and_program = $request->loan_type_and_program;
        $termsheet->additional_financing_available = $request->additional_financing_available;
        $termsheet->status = 'pending';
        $termsheet->notes = $request->notes;
        $termsheet->email_sent_at = null;
        $termsheet->save();

        return response()->json([
            'success' => true,
            'message' => 'Termsheet created successfully',
            'termsheet' => $termsheet,
        ]);
    }
}