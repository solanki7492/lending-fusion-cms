<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Termsheet;
use Illuminate\Support\Facades\Http;
use App\Models\TermsheetEmail;
class TermsheetController extends Controller
{
    public function index()
    {
        $termsheets = Termsheet::with('emails','user')->latest()->paginate(10);
        return view('termsheet.list', compact('termsheets'));
    }
    public function create()
    {
        return view('termsheet.create');
    }

    public function getGeneratePDF(Request $request)
    {
        $request->validate([
            'merchant_name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'email.*' => 'required|email',
            'loan_amount' => 'required|numeric',
        ]);
        
        $data = $request->all();
        $pdf = DomPDF::loadView('termsheet.generate-pdf', compact( 'data'));

        $fileName = Str::slug($request->merchant_name, '-').'-contract' . time() . '.pdf';
        $filePath = "termsheets/{$fileName}";
        Storage::disk('public')->put($filePath, $pdf->output());

        return response()->json(asset('storage/' . $filePath));
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
        Storage::disk('public')->put($filePath, $pdfContent);

        $termsheet = new Termsheet();
        $termsheet->user_id = auth()->user()->id;
        $termsheet->merchant_name = $request->merchant_name;
        $termsheet->first_name = $request->first_name;
        $termsheet->last_name = $request->last_name;
        $termsheet->address = $request->address;
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

        foreach ($request->email as $email) {
            TermsheetEmail::create([
                'termsheet_id' => $termsheet->id,
                'email' => $email,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Termsheet created successfully',
            'termsheet' => $termsheet,
        ]);
    }

    public function search(Request $request)
    {
        $response = Http::withHeaders([
            'X-API-TOKEN' => 'f47108b2-6a55-429e-a230-7f369f06bf21',
        ])->get('https://smsblastcrm.com/api/leads/search', [
            'term' => $request->term,
        ]);
        if ($response->successful()) {
            $leads = $response->json();
        } else {
            $leads = [];
        }
        return response()->json($leads);
    }
}