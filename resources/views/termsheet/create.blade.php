@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Create Termsheet</h2>

    <form id="generatePdfForm" action="{{ route('termsheet.generate.pdf') }}"  method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="merchant-name">Merchant Name</label>
                    <select class="form-select" name="merchant_name" id="merchant-name">
                        <option value="" selected disabled>Select Merchant</option>
                        <option value="Merchant 1">Merchant 1</option>
                        <option value="Merchant 2">Merchant 2</option>
                    </select>
                    <span class="text-danger" id="merchant-name-error"></span>
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="address">First Name:</label>
                    <input type="text" class="form-control" name="first_name" id="first-name">
                    <span class="text-danger" id="first-name-error"></span>
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="address">Last Name:</label>
                    <input type="text" class="form-control" name="last_name" id="last-name">
                    <span class="text-danger" id="last-name-error"></span>
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
                    <select class="form-control" name="email[]" id="email" multiple></select>
                    <span class="text-danger" id="email-error"></span>
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="loan-amount">Loan Amount:</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control" name="loan_amount" id="loan-amount">
                    </div>
                    <span class="text-danger" id="loan-amount-error"></span>
                </div>
            </div>

            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="origination-fee">Origination Fee(%):</label>
                    <input type="text" class="form-control" name="origination_fee" id="origination-fee-amount" value="1">
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="net-loan-amount">Net Loan Amount:</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control" name="net_loan_amount" id="net-loan-amount">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="monthly-payment">Monthly Payment:</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control" name="monthly_payment" id="monthly-payment">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="interest-rate">Interest Rate(%):</label>
                    <input type="text" class="form-control" name="interest_rate" id="interest-rate" value="12">
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
            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="mca_payment">MCA Payment:</label>
                    <select class="form-select" name="mca_payment" id="mca_payment">
                        <option value="two" selected>Two</option>
                        <option value="three">Three</option>
                        <option value="four">Four</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12">
            <button  class="btn btn-primary mt-3" onclick="setPreviewMode()">Create</button>
        </div>
    </form>
    
    <!-- Modal HTML -->
    <div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="max-width:90%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PDF Preview</h5>
                    <button type="button" class="btn-close close-preview-pdf" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="editor"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-preview-pdf" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary savePdf" data="save">Save</button>
                    <button class="btn btn-primary savePdf" data="send">Save & SendMail</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    
    <script type="text/javascript">
        
    let quill;

    $(document).on('click', '.savePdf', function() {
        const actionType = $(this).attr('data');
        const form = document.getElementById('generatePdfForm');
        const formData = new FormData(form);
        

        // Get updated HTML from Quill editor
        const editorContent = quill ? quill.root.innerHTML : $('#editor').html();

        formData.append('editor_content', editorContent);
        formData.append('send_to_email', actionType === 'send');
        formData.append('_token', '{{ csrf_token() }}');

        // Debug: Log formData
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        $.ajax({
            url: "{{ route('termsheet.store') }}",
            method: 'post',
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
    

        var leads = [];
        $('#merchant-name').select2({
            placeholder: "Select Merchant",
            allowClear: true,
            ajax: {
                url: '{{ route("lead.search") }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.data.map(function(merchant) {
                            leads.push(merchant);
                            return {
                                id: merchant.merchant_name, // required
                                text: merchant.merchant_name, // required
                                'emails': merchant.emails,
                            };
                        })
                    };
                },
                cache: true
            }
        });
        
        $('#email').select2({
            placeholder: "Select Email",
            allowClear: true,
            tags: true, // Allow adding new email addresses
            tokenSeparators: [',', ' '], // Separate emails by comma or space
            createTag: function(params) { 
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailRegex.test(params.term)) {
                    return {
                        id: params.term,
                        text: params.term,
                        newTag: true,
                    };
                }
                return null;
            }
        });

        $('#loan-amount,#net-loan-amount,#monthly-payment').on('keyup', function () {
            let val = $(this).val().replace(/,/g, ''); // remove existing commas
            if (!isNaN(val) && val !== '') {
            $(this).val(Number(val).toLocaleString()); // add commas
            }
        });

        $('#merchant-name').on('select2:select', function(e) {
            const selected = e.params.data;
            const selectedLead = leads.find(lead => lead.merchant_name == selected.id);
            if (selectedLead) {
                $('#first-name').val(selectedLead.first_name || '');
                $('#last-name').val(selectedLead.last_name || '');
                $('#address').val(selectedLead.address || '');
                if (selectedLead.emails && selectedLead.emails.length > 0) {
                    $('#email').empty(); // clear existing

                    // Optional: Add default placeholder option
                    $('#email').append(new Option('Select Email', '', false, false));

                    selectedLead.emails.forEach(function(emailObj) {
                        if (emailObj.email !== 'tmuz@abcelectricalservices.com') { // Exclude this specific email
                            const option = new Option(emailObj.email, emailObj.email, true, true);
                            $('#email').append(option);
                        }
                    });

                    $('#email').trigger('change'); // refresh Select2 if used
                } else {
                    $('#email').empty().append(new Option('No emails found', '', false, false)).trigger('change');
                }
                $('#loan-amount').val(selectedLead.contract_amount || '');
                if (selectedLead.contract_amount) {
                    updateNetLoanAmount();
                    calculateMonthlyPayment();
                } 
            }
        });
        $('.close-preview-pdf').on('click', function() {
            $('#pdfPreviewModal').modal('hide');
        });
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
                e.preventDefault(); // Prevent default form submission
                $('#generatePdfForm').find('input.email-indexed').remove();

                const selectedEmails = $('#email').val(); // Array of selected emails
                if (selectedEmails && selectedEmails.length > 0) {
                    selectedEmails.forEach((email, index) => {
                        $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', `email[${index}]`)
                            .attr('value', email)
                            .addClass('email-indexed')
                            .appendTo('#generatePdfForm');
                    });
                }
                const form = this;
                const formData = new FormData(form);


                $.ajax({
                    url: form.getAttribute('action'), // Use the action attribute from the form
                    method: form.method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        
                        $('#pdfPreviewModal').modal('show');
                        $('#editor').html(''); // Clear previous content
                        $('#editor').html(response.html); // Load new HTML content

                        // Re-initialize Quill each time with new content
                        if (quill) {
                            quill.root.innerHTML = response.html;
                        } else {
                            quill = new Quill('#editor', {
                                theme: 'snow'
                            });
                        }
                    },
                    error: function(xhr) {
                        $('#merchant-name-error').text(xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors.merchant_name || '' : '');
                        $('#first-name-error').text(xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors.first_name || '' : '');
                        $('#last-name-error').text(xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors.last_name || '' : '');
                        $('#email-error').text(xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors.email || '' : '');
                        $('#loan-amount-error').text(xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors.loan_amount || '' : '');
                        
                    }
                });
            });

    </script>
@endsection
