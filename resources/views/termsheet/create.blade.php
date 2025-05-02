@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Create Termsheet</h2>

    <form id="generatePdfForm" action="{{ route('termsheet.generate.pdf') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 col-6">
            <div class="mb-1">
                <label class="form-label" for="address">Merchant Name</label>
                <input type="text" class="form-control" name="merchant_name" id="merchant-name">
            </div>
            </div>
            <div class="col-md-6 col-6">
            <div class="mb-1">
                <label class="form-label" for="address">First Name:</label>
                <input type="text" class="form-control" name="first_name" id="first-name">
            </div>
            </div>
            <div class="col-md-6 col-6">
            <div class="mb-1">
                <label class="form-label" for="address">Last Name:</label>
                <input type="text" class="form-control" name="last_name" id="last-name">
            </div>
            </div>
            <div class="col-md-6 col-6">
            <div class="mb-1">
                <label class="form-label" for="address">Address:</label>
                <input type="text" class="form-control" name="address" id="address">
            </div>
            </div>
            <div class="col-md-6 col-6 lead-email">
            <div class="mb-1">
            <label class="form-label" for="to">Email</label>
            <input type="email" class="form-control" name="email" id="email">
            </div>
            </div>
            <div class="col-md-6 col-6">
            <div class="mb-1">
                <label class="form-label" for="loan-amount">Loan Amount:</label>
                <input type="text" class="form-control" name="loan_amount" id="loan-amount">
            </div>
            </div>
            <div class="col-md-6 col-6">
            <div class="mb-1">
                <label class="form-label" for="origination-fee">Origination Fee:</label>
                <input type="text" class="form-control" name="origination_fee" id="origination-fee-amount" value="1">
            </div>
            </div>
            <div class="col-md-6 col-6">
            <div class="mb-1">
                <label class="form-label" for="net-loan-amount">Net Loan Amount:</label>
                <input type="text" class="form-control" name="net_loan_amount" id="net-loan-amount">
            </div>
            </div>
            <div class="col-md-6 col-6">
            <div class="mb-1">
                <label class="form-label" for="monthly-payment">Monthly Payment:</label>
                <input type="text" class="form-control" name="monthly_payment" id="monthly-payment">
            </div>
            </div>
            <div class="col-md-6 col-6">
            <div class="mb-1">
                <label class="form-label" for="interest-rate">Interest Rate:</label>
                <input type="text" class="form-control" name="interest_rate" id="interest-rate" value="6">
            </div>
            </div>
            <div class="col-md-6 col-6">
            <div class="mb-1">
                <label class="form-label" for="loan-type-program-type">Loan Type and Program Type:</label>
                <select class="form-select" name="loan_type_program_type" id="loan-type-program">
                <option value="Traditional" selected>Traditional</option>
                <option value="Line of Credit Revolving">Line of Credit Revolving</option>
                </select>
            </div>
            </div>
            <div class="col-md-6 col-6">
            <div class="mb-1">
                <label class="form-label" for="loan-type-program">Loan Type and Program Year:</label>
                <input type="text" class="form-control" name="loan_type_program" id="loan-type-program" value="7" min="1" max="90">
            </div>
            </div>
            <div class="col-md-6 col-6">
            <div class="mb-1 mt-1">
                <label class="form-label" for="additional-financing-available">Additional Financing Available:</label>
                <input type="text" class="form-control" name="additional_financing_available" id="additional-financing-available">
            </div>
            </div>
            <div class="col-md-6 col-6">
            <div class="mb-1 mt-1">
                <label class="form-label" for="loan-type-program">Notes:</label>
                <input type="text" class="form-control" name="notes" id="notes" >
            </div>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary mt-3" onclick="setPreviewMode()">Submit</button>
        </div>
    </form>
    
    <div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="max-width:90%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PDF Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <iframe name="pdf-frame" id="pdf-frame" width="100%" height="600px" style="display: none; border: none;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary savePdf">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        function updateNetLoanAmount() {
            var loanAmount = parseFloat($('#loan-amount').val().replace(/,/g, '')) || 0;
            var originationFee = parseFloat($('#origination-fee-amount').val().replace(/,/g, '')) || 0;

            var netLoanAmount = loanAmount - (loanAmount * (originationFee / 100));

            $('#net-loan-amount').val(netLoanAmount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        }

        function calculateMonthlyPayment() {
            var loanAmount = parseFloat($('#loan-amount').val().replace(/,/g, '')) || 0;
            var annualInterestRate = parseFloat($('#interest-rate').val().replace(/,/g, '')) || 0;
            // Interest-only payment formula
            var monthlyPayment = (loanAmount * (annualInterestRate / 100)) / 12;
            $('#monthly-payment').val(monthlyPayment.toLocaleString('en-US', { 
                minimumFractionDigits: 2, 
                maximumFractionDigits: 2 
            }));
        }

        $('#loan-amount, #origination-fee-amount').on('input', function() {
            updateNetLoanAmount();
        });

        $('#loan-amount, #interest-rate, #loan-type-program').on('input', function() {
            calculateMonthlyPayment();
        });

            let previewMode = true;

            function setPreviewMode() {
                previewMode = true; // Always preview before submitting fully
            }

            document.getElementById('generatePdfForm').addEventListener('submit', function(e) {
                if (previewMode) {
                    $('#pdfPreviewModal').modal('show');
                    document.getElementById('pdf-frame').style.display = 'block';
                    this.target = 'pdf-frame'; // Target the iframe to show PDF
                    // Do not reset previewMode here, so clicking again shows updated preview
                } else {
                    this.target = ''; // Default form submission
                }
            });

            $(document).on('click', '.savePdf', function() {
                previewMode = false; // Set to false to allow normal submission
                const form = document.getElementById('generatePdfForm');
                const formData = new FormData(form);
                console.log('Iframe filename:', document.getElementById('pdf-frame').name);
                $.ajax({
                    url: "{{route('termsheet.store')}}",
                    method: form.method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert('Termsheet saved successfully!');
                        $('#pdfPreviewModal').modal('hide');
                        window.location.href = "{{ route('termsheet') }}";
                    },
                    error: function(xhr) {
                        alert('An error occurred while saving the PDF.');
                    }
                });
            });
    </script>
@endsection
